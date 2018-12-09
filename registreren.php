<?php
include_once ('php/account.php');

//session_start();

// Variable for user input
$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
$prefferedname = filter_input(INPUT_POST, 'prefferedname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$phonenumber = filter_input(INPUT_POST, 'phonenumber', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$passwordcheck = filter_input(INPUT_POST, 'passwordcheck', FILTER_SANITIZE_STRING);

$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
$housenumber = filter_input(INPUT_POST, 'housenumber', FILTER_SANITIZE_STRING);
$postalcode = filter_input(INPUT_POST, 'postalcode', FILTER_SANITIZE_STRING);

$issueCreatingAccount = FALSE;

if (isset($_POST['email'])) {
// Hashed password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if(usernameNotUsed($email) && passwordEqual($password, $passwordcheck)) {
    // query data stores data in the database
    $sqlPeople = " INSERT INTO people (PersonID, Fullname, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, PhoneNumber, EmailAddress, LastEditedBy, ValidFrom, ValidTo)
    VALUES ((SELECT MAX(pe.PersonID) + 1 FROM people pe) , '$fullname', '$prefferedname', '" .  $prefferedname . " " .  $fullname . "', 1, '$email', '$hashedPassword', 1, '$phonenumber', '$email', 1, (SELECT CURDATE()), '9999-12-31 23:59:59')";


// query data stores data in the database
$sqlPeople = " INSERT INTO people (PersonID, Fullname, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, PhoneNumber, EmailAddress, LastEditedBy, ValidFrom, ValidTo, IsExternalLogonProvider, IsEmployee, IsSalesperson)
VALUES ((SELECT MAX(pe.PersonID) + 1 FROM people pe) , '$fullname', '$prefferedname', '" .  $prefferedname . " " .  $fullname . "', 1, '$email', '$hashedPassword', 1, '$phonenumber', '$email', 1, (SELECT CURDATE()), '9999-12-31 23:59:59', 0, 0, 0)";

$stmt = runQuery($sqlPeople);

//var_dump($stmt);

$sqlCustomer = " INSERT INTO customers (CustomerID, CustomerName, BillToCustomerID, CustomerCategoryID, PrimaryContactPersonID, DeliveryMethodID, DeliveryCityID, PostalCityID, CreditLimit, AccountOpenedDate, StandardDiscountPercentage, IsStatementSent, IsOnCreditHold, PaymentDays, PhoneNumber, DeliveryAddressLine1, DeliveryAddressLine2, DeliveryPostalCode, LastEditedBy, ValidFrom, ValidTo, FaxNumber, WebsiteURL, PostalAddressLine1, PostalAddressLine2, PostalPostalCode)
VALUES ((SELECT MAX(c.CustomerID) + 1 FROM customers c) , '$fullname', (SELECT MAX(cu.CustomerID) + 1 FROM customers cu), 9, (SELECT MAX(PersonID) FROM people), 1, 1, 1, 0, (SELECT CURDATE()), 0, 0, 0, 7, '$phonenumber', '$housenumber', '$street', '$postalcode', 1, (SELECT CURDATE()), '9999-12-31 23:59:59', '', '', '$housenumber', '$street', '$postalcode')";


$stmt = runQuery($sqlCustomer);

//var_dump($sqlCustomer);
//var_dump($stmt);

$sqlAccount = " INSERT INTO accounts (PersonID, CustomerID)
VALUES ((SELECT MAX(PersonID) FROM people),
        (SELECT MAX(CustomerID) FROM customers))";

$stmt = runQuery($sqlAccount);

//var_dump($stmt);
  header('location: login.php');
} else {
  $issueCreatingAccount = TRUE;
}
}
?>


<!------------->
<!--- HTML ---->
<!------------->


<!-- include the header of the page -->
<?php
    $title = "Register";
    $stylesheet = FALSE;
    $sidebar = FALSE;
    include("includes/page-head.php");
?>
				<div class="row px-5 py-4">
					<div class="card col-12 col-md-6 offset-md-3 p-3 shadow-sm">
						<div class="row px-5 py-3">
							<?php
								if ($issueCreatingAccount) {
									print("
									<div class='col-12 alert alert-danger'>
										<p>
											There was an issue creating your account, please check if the password matched. otherwise the e-mail is already in use.
										</p>
									 </div>
									");
								}
							?>

							<form method="post" action="registreren.php" class="mx-auto">
								<h1 class="mb-4">Register now:</h1>

								<div class="form-group">
									<label for="fullname">Full name</label>
									<input type="text" class="form-control" name="fullname" placeholder="First and last name" required>
								</div>

								<div class="form-group">
									<label for="preffname">Preffered name</label>
									<input type="text" class="form-control" name="preffname" placeholder="Your preffered name" required>
								</div>

								<div class="form-row">
									<div class="form-group col-md-9">
										<label for="street">Street</label>
										<input type="text" class="form-control" name="street" placeholder="Enter your address" required>
									</div>

									<div class="form-group col-md-3">
										<label for="housenumber">Number</label>
										<input type="number" class="form-control" name="housenumber" required>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="postalcode">Postal code</label>
										<input type="text" class="form-control" name="postalcode" placeholder="Postal code" required>
									</div>

									<div class="form-group col-md-8">
										<label for="city">City</label>
										<input type="text" class="form-control" name="city" placeholder="Enter your city name" required>
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-mail address</label>
									<input type="text" class="form-control" name="email" placeholder="yourname@mail.com" required>
									<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
								</div>

								<div class="form-group">
									<label for="phonenumber">Phonenumber</label>
									<input type="tel" class="form-control" name="phonenumber" placeholder="+31612345678" required>
								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Enter your password" required>
										<small id="passwordHelp" class="form-text text-muted">Be smart. Choose a strong password.</small>
									</div>

									<div class="form-group col-md-6">
										<label for="passwordcheck">Repeat password</label>
										<input type="password" class="form-control" name="passwordcheck" placeholder="Confirm your password" required>
									</div>
								</div>

								<div class="col-4 offset-4 mt-3">
									<button type="submit" class="btn btn-success btn-lg"><i class="far fa-save"></i> Register</button>
								</div>
							</form>
						</div>
					</div>
				</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
