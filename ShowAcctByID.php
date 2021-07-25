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
	<h2>Show Account By Account ID</h2>
	<div class="container">
		<h3>Confidential</h3>
		<table class="table table-hover table-bordered">
			<thead>
				<tr class="success">
					<th class="text-center bold">Account</th>
					<th class="text-center bold">Balance</th>
					<th class="text-center bold">Customer ID</th>
					<th class="text-center bold">Form</th>
					<th class="text-center bold">Company Name</th>
					<th class="text-center bold">Address<span class="span-hide">_</span>1</th>
					<th class="text-center bold">Address<span class="span-hide">_</span>2</th>
					<th class="text-center bold">City</th>
					<th class="text-center bold">State</th>
					<th class="text-center bold">Planet</th>
					<th class="text-center bold">Zip</th>
					<th class="text-center bold">Phone</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (!($stmt = $mysqli->prepare("SELECT A.id AS 'Account', A.Balance, Cu.id AS 'Cust_ID', Cu.Lname, Cu.Fname, Cu.Addr_1,
																						Cu.Addr_2, Cu.City, Cu.State, Cu.Planet, Cu.Zip, Cu.Phone
																					FROM Customers Cu
																					INNER JOIN Account A ON Cu.id = A.C_ID
																					WHERE A.id = ?"))) {
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!($stmt->bind_param("i", $_POST['Account_ID']))) {
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($Account, $Balance, $Cust_ID, $Lname, $Fname, $Addr_1, $Addr_2, $City, $State, $Planet, $Zip, $Phone)) {
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td>\n" . $Account . "\n</td>\n<td>\n" . $Balance . "\n</td>\n<td>\n" . $Cust_ID . "\n</td>\n<td>\n" . $Lname .
								 "\n</td>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Addr_1 . "\n</td>\n<td>\n" . $Addr_2 . "\n</td>\n<td>\n" . $City .
								 "\n</td>\n<td>\n" . $State . "\n</td>\n<td>\n" . $Planet . "\n</td>\n<td>\n" . $Zip . "\n</td>\n<td>\n" . $Phone .
								 "\n</td>\n</tr>";
					}

					$stmt->close();
				?>
			</tbody>
		</table>
		<br>
    <button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
	</div>

</body>
</html>
