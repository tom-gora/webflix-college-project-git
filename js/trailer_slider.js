$(document).ready(function () {
  var slideWrapper = $(".main-slider"),
    iframes = slideWrapper.find(".embed-player");

  function onYouTubeIframeAPIReady() {
    var slideWrapper = $(".main-slider"),
      iframes = slideWrapper.find(".embed-player");

    iframes.each(function () {
      player = new YT.Player($(this).attr("id"), {
        events: {
          onStateChange: onPlayerStateChange,
        },
      });
    });
  }

  function onPlayerStateChange(event) {
    // Check if the video has ended
    if (event.data == YT.PlayerState.ENDED) {
      // Switch to the next slide in the slick slider
      slideWrapper.slick("slickNext");
    }
  }

  // POST commands to YouTube or Vimeo API
  function postMessageToPlayer(player, command) {
    if (player == null || command == null) return;
    player.contentWindow.postMessage(JSON.stringify(command), "*");
  }

  // When the slide is changing
  function playPauseVideo(slick, control) {
    var currentSlide, player;

    currentSlide = slick.find(".slick-current");
    player = currentSlide.find("iframe").get(0);
    startTime = currentSlide.data("video-start");

    switch (control) {
      case "play":
        postMessageToPlayer(player, {
          event: "command",
          func: "playVideo",
        });
        break;
      case "pause":
        postMessageToPlayer(player, {
          event: "command",
          func: "pauseVideo",
        });
        break;
      case "unmute":
        postMessageToPlayer(player, {
          event: "command",
          func: "unMute",
        });
        break;
      case "mute":
        postMessageToPlayer(player, {
          event: "command",
          func: "mute",
        });
        break;
    }
  }

  // Resize player
  function resizePlayer(iframes, ratio) {
    if (!iframes[0]) return;
    var win = $(".main-slider"),
      width = win.width(),
      playerWidth,
      height = win.height(),
      playerHeight,
      ratio = ratio || 16 / 9;

    iframes.each(function () {
      var current = $(this);
      if (width / ratio < height) {
        playerWidth = Math.ceil(height * ratio);
        current
          .width(playerWidth)
          .height(height)
          .css({
            left: (width - playerWidth) / 2,
            top: 0,
          });
      } else {
        playerHeight = Math.ceil(width / ratio);
        current
          .width(width)
          .height(playerHeight)
          .css({
            left: 0,
            top: (height - playerHeight) / 2,
          });
      }
    });
  }

  // DOM Ready
  $(function () {
    // Initialize
    slideWrapper.on("init", function (slick) {
      slick = $(slick.currentTarget);
      firstPlayer = slick.find("iframe").get(0);
      setTimeout(function () {
        playPauseVideo(slick, "play");
      }, 5000);
      resizePlayer(iframes, 16 / 9);
    });
    slideWrapper.on("click", function (slick) {
      slick = $(slick.currentTarget);
      playPauseVideo(slick, "unmute");
    });
    slideWrapper.on("beforeChange", function (event, slick) {
      slick = $(slick.$slider);
      playPauseVideo(slick, "pause");
    });
    slideWrapper.on("afterChange", function (event, slick) {
      slick = $(slick.$slider);
      playPauseVideo(slick, "play");
    });

    //init the slider
    slideWrapper.slick({
      fade: true,
      arrows: false,
      dots: true,
      cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)",
      responsive: [
        {
          breakpoint: 700,
          settings: {
            dots: false,
            arrows: true,
          },
        },
      ],
    });
  });

  // Resize event
  $(window).on("resize.slickVideoPlayer", function () {
    resizePlayer(iframes, 16 / 9);
  });
});
