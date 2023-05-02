<?php
echo '<div class="container home-slider">
    <h4 style="text-align: center; color: #ff5800; margin-bottom: 2rem;">POPULAR MOVIES</h4>
    <div class="card-slider">';
for ($i = 0; $i < 8; $i++) {
    echo '<div class="col-md-3">
      <div class="card movie-card" style="width: 16rem;" card-index="';
    echo $i;
    echo '"><a class="card-link" href="">
          <img src="" class="card-img-top"></a>
          <button class="btn btn-dark watch-btn-card" onClick="">WATCH NOW <i class="fa fa-play-circle" aria-hidden="true"></i></button>
          <div class="card-body">
          <a class="card-link" href="">
          <h4 class="card-title-movie" style="margin-top: 35px;"></h4></a><p class="card-text"></p>
          </div> 
      </div> 
    </div>';
}
echo '</div></div>';

echo '
    <div class="container home-slider">
    <h4 style="text-align: center; color: #ff5800; margin-bottom: 2rem;">POPULAR SHOWS</h4>
    <div class="card-slider">';
for ($i = 0; $i < 8; $i++) {
    echo '<div class="col-md-3">
      <div class="card show-card" style="width: 16rem;" card-index="';
    echo $i;
    echo '"><a class="card-link" href="">
          <img src="" class="card-img-top"></a>
          <button class="btn btn-dark watch-btn-card" onClick="">WATCH NOW <i class="fa fa-play-circle" aria-hidden="true"></i></button>
          <div class="card-body">
          <a class="card-link" href="">
          <h4 class="card-title-movie" style="margin-top: 35px;"></h4></a><p class="card-text"></p>
          </div> 
      </div> 
    </div>';
}
echo '</div></div>';
?>