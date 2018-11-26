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


// Hashed password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if(usernameNotUsed($email) && passwordEqual($password, $passwordcheck)) {
    // query data stores data in the database
        $sqlPeople = " INSERT INTO people (PersonID, Fullname, PreferredName, SearchName, IsPermittedToLogon, LogonName, HashedPassword, IsSystemUser, PhoneNumber, EmailAddress, LastEditedBy, ValidFrom, ValidTo)
        VALUES ((SELECT MAX(pe.PersonID) + 1 FROM people pe) , '$fullname', '$prefferedname', '" .  $prefferedname . " " .  $fullname . "', 1, '$email', '$hashedPassword', 1, '$phonenumber', '$email', 1, (SELECT CURDATE()), '9999-12-31 23:59:59')";


        $sqlCustomer = " INSERT INTO customers (CustomerID, CustomerName, BillToCustomerID, CustomerCategoryID, PrimaryContactPersonID, DeliveryMethodID, DeliveryCityID, PostalCityID, CreditLimit, AccountOpenedDate, StandardDiscountPercentage, IsStatementSent, IsOnCreditHold, PaymentDays, PhoneNumber, DeliveryAddressLine1, DeliveryAddressLine2, DeliveryPostalCode, LastEditedBy, ValidFrom, ValidTo)
        VALUES ((SELECT MAX(c.CustomerID) + 1 FROM customers c) , '$fullname', (SELECT MAX(cu.CustomerID) + 1 FROM customers cu), 9, (SELECT MAX(PersonID) FROM people), 1, 1, '$postalcode', 0, (SELECT CURDATE()), 0, 0, 0, 7, '$phonenumber', '$housenumber', '$street', '$postalcode', 1, (SELECT CURDATE()), '9999-12-31 23:59:59')";

        $sqlAccount = " INSERT INTO accounts (PersonID, CustomerID)
        VALUES ((SELECT MAX(PersonID) FROM people),
        (SELECT MAX(CustomerID) FROM customers))";

        $stmt = runQuery($sqlPeople);
        $stmt = runQuery($sqlCustomer);
        $stmt = runQuery($sqlAccount);

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
							<div class="card col shadow-sm">
								<div class="row p-3">
									<div class="col form">
        <h1>Register now!</h1><br>
            <form method="post" action="registreren.php">
                Fullname<br>
                <input type="text" name="fullname" size="30" required><br><br>

                Preffered name<br>
                <input type="text" name="prefferedname" size="30" required><br><br>

                Street + Housenumber<br>
                <input type="text" name="street" size="30" required>
                <input type="text" name="housenumber" size="4" required><br><br>


                Postalcode + City<br>
                <input type="text" name="postalcode" size="10" required>
                <input type="text" name="city" size="25" required><br><br>

                E-mail<br>
                <input type="text" name="email" size="30" required><br><br>

                Phonenumber<br>
                <input type="text" name="phonenumber" size="30" required><br><br><br>

                Password<br>
                <input type="password" name="password" size="30" required><br><br>

                Repeat password<br>
                <input type="password" name="passwordcheck" size="30" required><br>
                <br>
                <input type="submit" value="Register">

            </form>
        </div>
								</div>
							</div>
						</div>
<!-- include the footer of the page -->
<?php include("includes/page-foot.php") ?>
