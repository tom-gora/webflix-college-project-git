<?php session_start();
if (!isset($_SESSION['user_id'])) {
	// back to homepage if no session. page only accessible after login
	header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Webflix - Your Account</title>
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
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script crossorigin src="https://unpkg.com/country-to-currency@1.0.8/index.umd.js"></script>


	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


	<!--CSS -->
	<link href="css/StyleSheet.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


	<!-- additional external font libraries -->

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik+Mono+One&display=swap" rel="stylesheet">


	<!-- user icon generation api from https://ui-avatars.com -->
	<script type="text/javascript" src="js/account_page.js"></script>


</head>

<body>


	<?php include 'includes/top_bar.php' ?>

	<?php include 'includes/bottom_bar.html' ?>

	<?php include 'includes/account_modals.php' ?>


	<div class="container">
		<div class="row justify-content-center mt-3">
			<img id="profile-icon" style="display: inline-block; margin-right: 30px;"
				src="resources/placeholder_icon.png">
			<h1 id="greeting" style="display: inline-block; transform: translateY(20%);"></h1>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="rounded-container container">
					<div class="card">
						<div class="card-header">
							<h2 class="pictogram-description text-center">User Details</h2>
						</div>
						<div class="card-body">
							<div class="col">
								<table class="table">
									<tbody>
										<tr>
											<td class="font-weight-bold">First Name:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="first_name"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button id="edit-fname"
															class="btn btn-sm btn-edit">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Last Name:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="last_name"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button id="edit-lname"
															class="btn btn-sm btn-edit">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Email:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="email"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button id="edit-email"
															class="btn btn-sm btn-edit">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Phone number:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="phone"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button id="edit-phone"
															class="btn btn-sm btn-edit">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Date of birth:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="dob"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button class="btn btn-sm"
															style="visibility:hidden; pointer-events: none;">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Country:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="country"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button id="edit-country"
															class="btn btn-sm btn-edit">Edit</button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Registration date:</td>
											<td class="text-right">
												<div class="row justify-content-end">
													<div class="col justify-content-end">
														<p id="reg_date"></p>
													</div>
													<div class="col justify-content-end"
														style="max-width:50px !important;"><button class="btn btn-sm"
															style="visibility:hidden; pointer-events: none;">Edit</button>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row justify-content-center" style="height: 200px !important;">
								<button id="change-details-btn" class="btn movieCardButton overlay-play-btn"
									style="position: absolute; bottom: 130px">Change
									Details</button>
								<button id="change-pass-btn" class="btn movieCardButton overlay-play-btn"
									style="position: absolute; bottom: 70px">Change
									Password</button>
								<button id="delete-account" class="btn red-button"
									style="width:200px; position: absolute; bottom: 20px">Delete
									Account</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			include('includes/connect_db.php');
			$user_id = $_SESSION['user_id'];
			$q = "SELECT paypal_subscr_id, subscr_interval, valid_from, valid_to, paid_amount, currency_code, payment_status 
			FROM user_subscriptions WHERE user_id = '$user_id'";
			$stmt = $link->prepare($q);
			$stmt->execute();
			$res = $stmt->get_result();

			if (mysqli_num_rows($res) > 0) {
				$row = mysqli_fetch_array($res);
				$paypal_subscr_id = $row['paypal_subscr_id'];
				$subscr_interval = $row['subscr_interval'];
				$period = '/ Year';
				if ($subscr_interval == 'M') {
					$period = '/ Month';
				}
				$valid_from = $row['valid_from'];
				$dateObj = new DateTime($valid_from);
				$formattedValidFrom = $dateObj->format('d F Y H:i');

				$valid_to = $row['valid_to'];
				$dateObj = new DateTime($valid_to);
				$formattedValidTo = $dateObj->format('d F Y H:i');

				$paid_amount = $row['paid_amount'];
				$currency_code = $row['currency_code'];
				$payment_status = $row['payment_status'];
			} else {
				//keep divs empty if no subscriptions
				$paypal_subscr_id = '';
				$subscr_interval = '';
				$period = '';
				$valid_from = '';
				$valid_to = '';
				$paid_amount = '';
				$currency_code = '';
				$payment_status = '';
			}
			mysqli_close($link);
			?>
			<div class="col-md-4" style="min-width: 350px !important;">
				<div class="rounded-container container">
					<div class="card mt-3 sub-card">
						<div class="card-header">
							<h2 class="pictogram-description text-center">Subscription</h2>
						</div>
						<div class="card-body">
							<div id="nosub-wrapper" class="justify-content-center">
								<div class="text-center">
									<p class="submsg"></p>
								</div>
								<div class="row justify-content-center">
									<button class="btn movieCardButton overlay-play-btn sub-btn"
										onclick="window.location.href='subscribe.php'">Subscribe</button>
								</div>
							</div>
							<div id="sub-wrapper" class="justify-content-center" style="display: none;">
								<div class="text-center">
									<p class="plan-name" style="font-size: 1.5rem;"></p>
									<h4 class="font-weight-bold text-center" id='costmsg'>
										<?php echo $paid_amount . ' ' . $currency_code . ' ' . $period ?>
									</h4>
								</div>
								<div class="text-center">
									<p id="converted-price-info-helper">which in your local currency is at the moment:
									</p>
								</div>
								<div class="text-center">
									<p class='text-center' id="converted-price"></p>
								</div>
								<table class="table">
									<tbody>
										<tr>
											<td class="font-weight-bold">Valid from:</td>
											<td>
												<?php echo $formattedValidFrom ?>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Valid to:</td>
											<td>
												<?php echo $formattedValidTo ?>
											</td>
										</tr>
										<tr>
											<td class="font-weight-bold">Plan ID:</td>
											<td>
												<?php echo $paypal_subscr_id ?>
											</td>
										</tr>
									</tbody>
								</table>

								<div class="text-center">
									<p class='submsg text-center'></p>
								</div>
								<div class="row justify-content-center">
									<button class="btn movieCardButton overlay-play-btn sub-btn"
										onclick="window.location.href='subscribe.php'">Change
										subscription</button>
								</div>
								<div class="row justify-content-center">
									<button class="btn red-button" id="cancel-modal-trigger" style="width:200px;"
										onclick="$('#cancelModal').modal('show');">Cancel
										subscription</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'includes/footer.html' ?>

</body>

</html>