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
  <script type="text/javascript">
		// Clears prepopulated form following Update Customer submit button click. 
		function clearForm() {
			document.getElementById("Lname").value="";
			document.getElementById("Fname").value="";
			document.getElementById("Addr_1").value="";
			document.getElementById("Addr_2").value="";
			document.getElementById("City").value="";
			document.getElementById("State").value="";
			document.getElementById("Planet").value="";
			document.getElementById("Zip").value="";
			document.getElementById("Phone").value="";
			document.getElementById("id").value="";
		}
	</script>

</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Update Customer Details</h2>
	<div class="container">
		<h3>Current Confidential Customer Details</h3>
		<table class="table table-hover table-bordered">
			<thead>
				<tr class="success">
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
				<?php // Get Customer records.
					if (isset($_POST['updateCustomer'])) {
						
						if (!($stmt = $mysqli->prepare("SELECT id, Lname, Fname, Addr_1, Addr_2, City, State, Planet, Zip, Phone
																						FROM Customers WHERE id=?"))) {
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!($stmt->bind_param("i", $_POST['updateCustomer']))) {
							echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!$stmt->execute()) {
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if (!$stmt->bind_result($id, $Lname, $Fname, $Addr_1, $Addr_2, $City, $State, $Planet, $Zip, $Phone)) {
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()) {
							echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Lname . "\n</td>\n<td>\n" . $Fname . "\n</td>\n<td>\n" . $Addr_1 .
									 "\n</td>\n<td>\n" . $Addr_2 . "\n</td>\n<td>\n" . $City . "\n</td>\n<td>\n" . $State . "\n</td>\n<td>\n" . $Planet .
									 "\n</td>\n<td>\n" .$Zip . "\n</td>\n<td>\n" . $Phone . "\n</td>\n</tr>";
						}

						$stmt->close();
					}
				?>
			</tbody>
		</table>
		
		<h3>Make Corrections</h3>
			<form method="post">
				<div class="form-group container">
					<?php // Note hidden id field needed as $_POST['id'] is lost on 2nd post. ?>
					<input class="form-control hidden" type="text" name="id_" id="id_" size="20" value="<?php echo $id; ?>">
					<input class="form-control" type="text" maxlength="30" name="Lname" id="Lname" placeholder="Customer Organized As: LLC, Ltd. etc." >
					<input class="form-control" type="text" maxlength="30" name="Fname" id="Fname" placeholder="Business Name">
					<input class="form-control" type="text" maxlength="30" name="Addr_1" id="Addr_1" placeholder="Address 1">
					<input class="form-control" type="text" maxlength="30" name="Addr_2" id="Addr_2" placeholder="Address 2">
					<input class="form-control" type="text" maxlength="25" name="City" id="City" placeholder="City">
					<input class="form-control" type="text" maxlength="2" name="State" id="State" placeholder="State">
					<input class="form-control" type="text" maxlength="25" name="Planet" id="Planet" placeholder="Planet">
					<input class="form-control" type="number" maxlength="20" min="0" name="Zip" id="Zip" placeholder="Zip">
					<input class="form-control" type="number" maxlength="20" min="0" name="Phone" id="Phone" placeholder="Phone">
					<br><br>
					<input type="submit" type="reset" value="Update Customer Details" name="submit" id="submit">
				</div>
		</form>
		<br>
		<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
		<br><br>
	</div>
	<?php 
		/* Form handler - Executes on 'Update Customer' submit button clicked. */
		if (isset($_POST['submit'])){
			
			/* Prepare statement for UPDATE customer's details. */
			if (!($stmt = $mysqli->prepare("UPDATE Customers SET Lname=?, Fname=?, Addr_1=?, Addr_2=?, City=?, State=?, Planet=?, Zip=?, Phone=?
										   WHERE id=?"))) {
				echo "<p class=\"error\">Prepare for Customers UPDATE query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
			}

			/* Bind Parameters for INSERT new customer's details. */
			if (!($stmt->bind_param("sssssssiii", $_POST['Fname'], $_POST['Lname'], $_POST['Addr_1'], $_POST['Addr_2'], $_POST['City'],
																					 $_POST['State'], $_POST['Planet'], $_POST['Zip'], $_POST['Phone'], $_POST['id_']))) {
					echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			/* Execute INSERT new customer's details. */
			if (!$stmt->execute()) {
				echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}
			else {
				echo "<p class=\"success\">Updated " . $stmt->affected_rows . " rows in Customer table \"Customers\".</p>";
				echo "<p class=\"success\">Form has been cleared.</p>";
			}
		// Clear the form!
		echo "<script type=\"text/javascript\">clearForm();</script>";
		}
	?>

	<!-- Decimal Places Control. -->
	<script
		src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
	</script>

	<script>
		$("#Zip, #Phone").blur(function() {
			this.value = Math.abs(parseFloat(this.value).toFixed(0));
		});
	</script>

</body>
</html>
