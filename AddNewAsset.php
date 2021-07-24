<?php
	//Turn on error reporting
	ini_set('display_errors', 'On');
	// Import dBase Credentials.
	require('../../project/g3f2Kcd57nE4s25.php');
	// Connect to the database.
	$mysqli = new mysqli($servername, $username, $password, $database);
	// Date details for 1,000 years in the future.
	$dateTime = new DateTime("NOW");
	$day = $dateTime->format('d');
	$month = $dateTime->format('m');
	$year = $dateTime->format('Y') + 1000;
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
		<h2>Add New Asset</h2>
		<?php // Get 'to be Owned_By' Account ID.
			if(isset($_POST['AddNewAsset'])){
				$idFromPostData = $_POST['AddNewAsset'];
			}
		?>

		<div>
			<h3>Data Entry</h3>
			<form method="post">
				<div class="form-group container">
					<input class="form-control" type="text" name="Name" id="Name" placeholder="Name" required>
					<input class="form-control" type="text" name="Descr" id="Descr" placeholder="Description of New Asset" required>
					<input class="form-control" type="number" name="Radius" id="Radius" min="0" step="0.01" placeholder="Radius in Kilometers" required>
					<input class="form-control" type="number" name="Mass" id="Mass" min="0" step="0.01" placeholder="Mass in Kilograms" required>
					<input class="form-control" type="number" name="ApMag" id="ApMag" min="-30" max="30" step="0.001" placeholder="Apparent Magnitude" required>
					<br>
					<h5>Have You Confirmed the T.P.S. Report for Correct Ownership Information?</h5>
					<select name="Owned_By">
						<?php
							if(!($stmt = $mysqli->prepare("SELECT id FROM Account"))) {
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}
							if (!$stmt->execute()) {
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($id)) {
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()) {
								if ($id == $idFromPostData) {
									echo '<option selected value=" '. $id . ' "> ' . $id . '</option>\n';
								}
								else {
									echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
								}
							}
							$stmt->close();
						?>
					</select>
					<br>
					<h5>Management Approval Required for Any Date Other Than <?php echo date("m-d-Y", mktime(0,0,0,$month,$day,$year)); ?></h5>
					<input name="cDate" type="date" id="endDate" value="<?php echo date("Y-m-d", mktime(0,0,0,$month,$day,$year)); ?>" required>
					<br><br>
					<input type="submit" type="reset" value="Add Asset" name="submit" id="submit">
				</div>

			</form>
			<br>
			<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
			<br><br>
		</div>

		<?php
			/* Form handler - Executes on 'Add Asset' submit button clicked. */
			if(isset($_POST['submit'])){
				/* Prepare statement for INSERT new customer's details. */
				if(!($stmt = $mysqli->prepare("INSERT INTO Asset (Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By)
											   VALUES(?,?,?,?,?,?,?)"))) {
						echo "<p class=\"error\">Prepare for Asset INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
				}

				/* Bind Parameters for INSERT new Asset's details. */
				if(!($stmt->bind_param("ssdddsi", $_POST['Name'], $_POST['Descr'], $_POST['Radius'], $_POST['Mass'], $_POST['ApMag'], $_POST['cDate'], $_POST['Owned_By']))) {
					echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}

				/* Execute INSERT new Asset's details. */
				if(!$stmt->execute()){
					echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				} else {
					echo "<p class=\"success\">Added " . $stmt->affected_rows . " new Asset to Asset table.</p>";
				}

				$stmt->close();
			}

		?>

		<!-- Decimal Places Control. -->
		<script
			src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
		</script>

		<script>
			$("#Radius, #Mass").blur(function() {
				this.value = parseFloat(this.value).toFixed(2);
			});
			$("#ApMag").blur(function() {
				this.value = parseFloat(this.value).toFixed(3);
			});
		</script>

	</body>
</html>
