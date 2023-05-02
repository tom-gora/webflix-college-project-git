<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Webflix - Subscribtions</title>
	<link rel="icon" type="image/x-icon" href="resources/favicon.png">
	<meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, shrink-to-fit=no"
		charset="utf-8">

	<!-- JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"
		integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
		integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
		crossorigin="anonymous"></script>
	<!-- src https://www.npmjs.com/package/country-to-currency -->
	<script crossorigin src="https://unpkg.com/country-to-currency@1.0.8/index.umd.js"></script>


	<script type="text/javascript" src="js/subscriptions.js"></script>


	<!--CSS -->
	<link href="css/StyleSheet.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" <link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

	<!-- additional external font libraries -->

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">

</head>


<body>

	<?php include 'includes/top_bar.php' ?>

	<?php include 'includes/bottom_bar.html' ?>

	<?php include 'includes/common_modals.php' ?>

	<header class="py-3">

		<div class="container d-flex justify-content-center">
			<h1 id="header-line1" class="font-weight-bold"></h1>
		</div>
		<div class="container d-flex justify-content-center">
			<p id="header-line2"></p>
		</div>
		<!-- src https://codepen.io/vidhi_agrawal_2000/pen/mdGqMJV -->
		<div class="d-flex justify-content-center">
			<h3 id="toggle-monthly" style="color: #ff5800; opacity: 0;">Monthly</h3>
			<div class="switchWrapper">
				<label class="switch">
					<input type="checkbox" checked>
					<span class="toggle round">
				</label>
			</div>
			<h3 id="toggle-yearly" style="color: #00a2e2" ;>Yearly</h3>
		</div>

	</header>

	<div class="container mt-5">

		<div class="row subscription-cards-wrapper">
			<div class="col-md-4" id="card-1-col">
				<div class="card movie-card mb-4">
					<div class="card-header">
						<h3 class="plan-name">Bingemaster!</h3>
					</div>
					<div class="card-body">
						<h4 class="card-title yearly-price tv-price">69.99 GBP</span> / year</h4>
						<p class="local-price-descriptor"
							style="margin-bottom: 0.3rem; font-size: clamp(0.8rem, 1vw, 100%);">which in your local
							currency is at the moment:
						</p>
						<h6 class="local-price"></h6><br>
						<p class="card-text" style="font-size: clamp(0.75rem, 1vw, 100%);"></p>
						<div class=" row justify-content-center subscribe-row">
							<a href="#" class="btn movieCardButton overlay-play-btn choice-btn" id="choice-btn1">Choose
								Plan</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4" id="card-2-col">
				<div class="card mb-4">
					<div class="card-header">
						<h3 class="plan-name">Film buff!</h3>
					</div>
					<div class="card-body">
						<h4 class="card-title yearly-price movie-price">69.99 GBP / year</h4>
						<p class="local-price-descriptor"
							style="margin-bottom: 0.3rem; font-size: clamp(0.8rem, 1vw, 100%);">which in your local
							currency is at the moment:
						</p>
						<h6 class="local-price"></h6><br>
						<p class="card-text" style="font-size: clamp(0.75rem, 1vw, 100%);"></p>
						<div class="row justify-content-center subscribe-row">
							<a href="#" class="btn movieCardButton overlay-play-btn choice-btn" id="choice-btn2">Choose
								Plan</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4" id="card-3-col">
				<div class="card mb-4">
					<div class="card-header">
						<h3 class="plan-name">Omnivore!</h3>
					</div>
					<div class="card-body">
						<h4 class="card-title yearly-price all-price">129.99 GBP / year</h4>
						<p class="local-price-descriptor"
							style="margin-bottom: 0.3rem; font-size: clamp(0.8rem, 1vw, 100%);">which in your local
							currency is at the moment:
						</p>
						<h6 class="local-price"></h6><br>
						<p class="card-text" style="font-size: clamp(0.75rem, 1vw, 100%);"></p>
						<div class="row justify-content-center subscribe-row">
							<a href="#" class="btn movieCardButton overlay-play-btn choice-btn" id="choice-btn3">Choose
								Plan</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="video-container">
		<video id="background-video"
			src="https://media.istockphoto.com/id/1149033136/video/abstract-colorful-network-loopable-background.mp4?s=mp4-640x640-is&k=20&c=adFa5i19xpaq9pQYbJsY8Y1xHrjRAsMHUoXTHZE-qAs="
			autoplay loop muted></video>
	</div>

	<!-- Subscription confirmed modal -->
	<div class="modal" id="subConfirmModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="col">
						<div class="row justify-content-center">
							<h2 class="text-center">You have selected</h2>
						</div>
						<div class="row justify-content-center">
							<h2 class="modal-title plan-name" class="mr-auto"></h2>
						</div>
					</div>
				</div>
				<div class="modal-body dirtyBootstrapOverrideFuckingHateIt2">
					<div class="row justify-content-center">
						<p id="sub-summary-line1"></p>
					</div>
					<div class="row justify-content-center">
						<h4 id="sub-summary-line2"></h4>
					</div>
					<div class="row justify-content-center  mt-4">
						<p>You will be redirected to</p>
					</div>
					<div class="row justify-content-center">
						<img alt="PayPal"
							src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png?20150315064712"
							style="height:80px;">
					</div>
					<div class="row justify-content-center">
						<p>to finish your transaction.</p>
					</div>
					<div class="row justify-content-center">
						<br>
						<p id="sub-warning"
							style="padding-left: 10px; padding-right: 10px; font-size: 0.7rem;  color: #FF6464;">
							Clicking
							the buy button will cancel your existing subscription.<br>You will not have a plan until a
							new
							one is paid for.</p>
					</div>
					<div class="row justify-content-center">
						<p style="padding-left: 10px; padding-right: 10px; font-size: 0.7rem;">By setting up a
							subscription
							you agree to our <a href="#">Terms & Privacy</a>
						</p>
					</div>
					<div class="row justify-content-center">
						<form id="paypal_form" action="" method="post"> <!-- PAYPAL_URL var needed as action attr -->
							<input type="hidden" name="business" id="business" value="">
							<!-- PAYPAL_ID var needed as value attr -->
							<input type="hidden" name="image_url"
								value="https://webflix-demo.site/resources/wf_paypal.png">
							<input type="hidden" name="no_shipping" value="1">

							<input type="hidden" name="cmd" value="_xclick-subscriptions">
							<!-- Specify details about the subscription that buyers will purchase -->
							<input type="hidden" name="item_name" id="item_name" value="">
							<!-- plan name var needed as value attr -->
							<input type="hidden" name="item_number" id="item_number" value="">
							<!-- plan_id var needed as value attr -->
							<input type="hidden" name="currency_code" id="currency_code" value="">
							<!-- CURRENCY var needed as value attr -->
							<input type="hidden" name="a3" id="item_price" value="">
							<!-- price var needed as value attr -->
							<input type="hidden" name="p3" id="interval_count" value="">
							<!-- interval_count var needed as value attr -->
							<input type="hidden" name="t3" id="interval" value="">
							<!--interval var needed as value attr -->
							<input type="hidden" name="src" value="1"> <!-- recurring plan = true -->
							<input type="hidden" name="srt" id="plan_duration" value="">
							<!-- max amount of recurring payments allowed by paypal -->

							<input type="hidden" name="custom" id="user_id_for_paypal" value="">
							<!--user_id from session var needed as value attr (handle by the second ajax call?)-->

							<input type="hidden" name="cancel_return" id="cancel_url" value="">
							<!-- PAYPAL_CANCEL_URL var needed as value attr -->
							<input type="hidden" name="return" id="return_url" value="">
							<!-- PAYPAL_RETURN_URL var needed as value attr -->

							<button id="accept-btn" class="btn movieCardButton overlay-play-btn" type="submit">Buy
								Subscription</button>
						</form>
					</div>
					<div class="row justify-content-center">
						<button type="button" class="btn movieCardButton overlay-play-btn modal-submit" class="close"
							data-dismiss="modal" aria-label="Close">Close</button>
					</div>

				</div>
			</div>
		</div>
	</div>



	<?php include 'includes/footer.html' ?>
</body>

</html>