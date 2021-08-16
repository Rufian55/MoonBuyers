<?php
	// Login Credentials required.
	require('../includes/ProtectMB.php');
	// Destroy session at time limit.
	require('../includes/SessionExpire.php');
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
		require('../includes/Sanitizer.php');
	?>
</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Add New Customer</h2>
	<div>
		<div>
			<h3>Data Entry</h3>
			<form method="post">
				<div class="form-group container">
					<input class="form-control" type="text" maxlength="30" name="Lname" id="Lname" placeholder="Customer Organized As: LLC, Ltd. etc." required>
					<input class="form-control" type="text" maxlength="30" name="Fname" id="Fname" placeholder="Business Name" required>
					<input class="form-control" type="text" maxlength="30" name="Addr_1" id="Addr_1" placeholder="Address 1" required>
					<input class="form-control" type="text" maxlength="30" name="Addr_2" id="Addr_2" placeholder="Address 2" required>
					<input class="form-control" type="text" maxlength="25" name="City" id="City" placeholder="City" required>
					<input class="form-control" type="text" maxlength="2" name="State" id="State" placeholder="State" required>
					<input class="form-control" type="text" maxlength="25" name="Planet" id="Planet" placeholder="Planet" required>
					<input class="form-control" type="number" maxlength="20" min="0" name="Zip" id="Zip" placeholder="Zip" required>
					<input class="form-control" type="number" maxlength="20" min="0" name="Phone" id="Phone" placeholder="Phone" required>
					<input class="form-control" type="number" min="0" step="0.01" name="Open" id="Open" placeholder="Opening Balance" required>
					<br><br>
					<input type="submit" type="reset" value="Add Customer" name="submit" id="submit">
				</div>
			</form>
		</div>
		<br>
		<button type="button" class="button" onclick="location.href='IndexMB.php';">Return to Main Page</button>
		<br><br>
	</div>

	<?php
		/* Form handler - Executes on 'Add Customer' submit button clicked. */
		if(isset($_POST['submit'])){
			/* Lock tables for writing - protect integrity of new custoemr's ID retrieval. */
			if(!$mysqli->query("LOCK TABLES Customers WRITE, Account WRITE")) {
				echo "<p class=\"error\">ERROR! Tables did not lock for writing: (" . $mysqli->errno . ")" . $mysqli->error . "</p>";
			}

			/* Prepare statement for INSERT new customer's details. */
			if(!($stmt = $mysqli->prepare("INSERT INTO Customers (Lname, Fname, Addr_1, Addr_2, City, State, Planet, Zip, Phone)
										   VALUES(?,?,?,?,?,?,?,?,?)"))) {
					echo "<p class=\"error\">Prepare for Customers INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
			}

			// Sanitize user input.
			$cleaner = new Cleaner();
			$_Fname = $cleaner->CleanString($_POST['Fname']);
			$_Lname = $cleaner->CleanString($_POST['Lname']);
			$_Addr_1 = $cleaner->CleanString($_POST['Addr_1']);
			$_Addr_2 = $cleaner->CleanString($_POST['Addr_2']);
			$_City = $cleaner->CleanString($_POST['City']);
			$_State = $cleaner->CleanStateString($_POST['State']);
			$_Planet = $cleaner->CleanString($_POST['Planet']);
			$_Zip = $cleaner->CleanInt($_POST['Zip']);
			$_Phone = $cleaner->CleanInt($_POST['Phone']);
			$_Open = $cleaner->CleanDecimal($_POST['Open']);

			/* Bind Parameters for INSERT new customer's details. */
			if (!($stmt->bind_param("sssssssii", $_Fname, $_Lname, $_Addr_1, $_Addr_2, $_City, $_State, $_Planet, $_Zip, $_Phone))) {
				echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			/* Execute INSERT new customer's details. */
			if (!$stmt->execute()) {
				echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			} else {
				echo "<p class=\"success\">Added " . $stmt->affected_rows . " new Customer to table \"Customers\".</p>";
			}

			/* Retrieve last insert ID which = new Customer ID. */
			if ($temp = $mysqli->insert_id) {
				echo "<p class=\"success\">New Customer ID = " . $temp . "</p>";
			}
			else {
		    	echo "<p class=\"error\">There was an error retrieving the new Customer ID. Error: " . $mysqli->error . "</p>";
			}

			/* Prepare statement for new customer's new account. */
			if (!($stmt = $mysqli->prepare("INSERT INTO Account (C_ID, Balance) VALUES(?,?)"))) {
				echo "<p classs=\"error\">Prepare for Account INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			/* Bind Parameters for INSERT new customer's Account details. */
			if (!($stmt->bind_param("ii", $temp, $_Open))) {
				echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			/* Execute INSERT new customer's Account details. */
			if (!$stmt->execute()) {
				echo "<p class=\"error\">Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
			}

			/* UNLOCK tables. */
			if (!$mysqli->query("UNLOCK TABLES")) {
				echo "<p class=\"error\">ERROR! Tables did not unlock following write: (" . $mysqli->errno . ")" . $mysqli->error . "</p>";
			}

			$stmt->close();
		}
	?>
	
	<!-- Decimal Places Control! -->
	<script
	 src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
	</script>

	<script>
		$("#Open").blur(function() {
			this.value = parseFloat(this.value).toFixed(2);
		});
		$("#Zip, #Phone").blur(function() {
			this.value = Math.abs(parseFloat(this.value).toFixed(0));
		});
	</script>

</body>
</html>
