<?php
  //Turn on error reporting
  ini_set('display_errors', 'On');
  // Import dBase Credentials.
  require('../../project/g3f2Kcd57nE4s25.php');
  // Connect to the database.
  $mysqli = new mysqli($servername, $username, $password, $database);
?>

<!DOCTYPE HTML>
<html>

<head>
<?php
    include('../includes/HeadMB.php');
  ?>
</head>

<body>
<h1>MoonBuyers InterGalactic</h1>
<h2>Show All Accounts</h2>
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Confidential</legend>
		<fieldset class="fieldset-left">
			<table class="table_display">
				<tr>
					<td class="bold">Account</td>
					<td class="bold">Balance</td>
					<td class="bold">Customer ID</td>
            		<td class="bold">Last Name</td>
            		<td class="bold">First Name</td>
            		<td class="bold">Address_1</td>
            		<td class="bold">Address_2</td>
            		<td class="bold">City</td>
                    <td class="bold">State</td>
                    <td class="bold">Planet</td>
            		<td class="bold">Zip</td>
            		<td class="bold">Phone</td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT A.id AS Account, A.Balance, Cu.id AS 'Cust_ID', Cu.Lname, Cu.Fname, Cu.Addr_1,
									  Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone
							   FROM Customers Cu
							   INNER JOIN Account A ON Cu.id = A.C_ID"))) {
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($Account, $Balance, $Cust_ID, $Lname, $Fname, $Addr_1, $Addr_2, $City, $State, $Planet, $Zip, $Phone)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo "<tr>\n<td>\n" . $Account . "\n</td>\n<td>\n" . $Balance . "\n</td>\n<td>\n" . $Cust_ID . "\n</td>\n<td>\n" . $Lname . "\n</td>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Addr_1 . "\n</td>\n<td>\n" . $Addr_2 . "\n</td>\n<td>\n" . $City . "\n</td>\n<td>\n" . $State . "\n</td>\n<td>\n" . $Planet . "\n</td>\n<td>\n" . $Zip . "\n</td>\n<td>\n" . $Phone . "\n</td>\n</tr>";
}

$stmt->close();
?>
			</table>
		</fieldset>
	</fieldset>
    <br><br>
    <button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
</div>
</body>

</html>