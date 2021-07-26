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
		require('../includes/Sanitizer.php');
	?>

	<script type="text/javascript">
		// Clears prepopulated form following Update Asset submit button click. 
		function clearForm() {
			document.getElementById("id").value="";
			document.getElementById("Name").value="";
			document.getElementById("Description").value="";
			document.getElementById("Radius").value="";
			document.getElementById("Mass").value="";
			document.getElementById("ApMag").value="";
			document.getElementById("cDate").value="";
			document.getElementById("Owned_By").value="";
		}
	</script>

</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Edit An Asset</h2>
	<div class="container">
		<h3>Orginal Asset Details</h3>
		<table class="table table-hover table-bordered">
			<thead>
				<tr class="success">
					<th class="text-center bold">Asset ID</th>
					<th class="text-center bold">Name</th>
          			<th class="text-center bold">Description</th>
          			<th class="text-center bold">Radius</th>
          			<th class="text-center bold">Mass</th>
          			<th class="text-center bold">Apparent Magnitude</th>
          			<th class="text-center bold">Create<span class="span-hide">_</span>Date</th>
          			<th class="text-center bold">Owned By</th>
				</tr>
			</thead>
			<tbody>
				<?php // Get Customer records.
					if (isset($_POST['EditAsset'])) {

						if (!($stmt = $mysqli->prepare("SELECT id, Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By
												  		FROM Asset WHERE id=?"))) {
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!($stmt->bind_param("i", $_POST['EditAsset']))) {
							echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!$stmt->execute()) {
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if (!$stmt->bind_result($id, $Name, $Description, $Radius, $Mass, $ApMag, $Create_Date, $Owned_By)) {
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()) {
							echo "<tr id=\"table-borders-override\">\n<td>\n" . $id . "\n</td>\n<td>\n" . $Name . "\n</td>\n<td>\n" . $Description . "\n</td>\n<td>\n" . $Radius . "\n</td>\n<td>\n" . $Mass . "\n</td>\n<td>\n" . $ApMag . "\n</td>\n<td>\n" . $Create_Date . "\n</td>\n<td>\n" . $Owned_By . "\n</td>\n</tr>";
						}

						$stmt->close();
					}
				?>
			</tbody>
		</table>
	</div>

	<br><br>

	<div>
		<h3>Data Entry</h3>
		<form method="post">
			<div class="form-group container">
				<?php //assetID_ css display: none - this field needed as reference to $_POST['EditAsset'] passed from IndexMB.php is lost on submit. ?>
				<input class="form-control" type="text" name="assetID_" id="assetID_" value="<?php echo $id ?>" readonly>
				<input class="form-control" type="text" name="Name" id="Name" placeholder="Name (Corrected)" value="<?php echo $Name ?>" required>
				<input class="form-control" type="text" name="Descr" id="Descr" placeholder="Description of New Asset (Corrected)" value="<?php echo $Description ?>" required>
				<input class="form-control" type="number" name="Radius" id="Radius" min="0" step="0.01" placeholder="Radius in Kilometers (Corrected)" value="<?php echo $Radius ?>" required>
				<input class="form-control" type="number" name="Mass" id="Mass" min="0" step="0.01" placeholder="Mass in Kilograms (Corrected)" value="<?php echo $Mass ?>" required>
				<input class="form-control" type="number" name="ApMag" id="ApMag" min="-30" max="30" step="0.001" placeholder="Apparent Magnitude (Corrected)" value="<?php echo $ApMag ?>" required>
				<br><br>
				<input type="submit" value="Submit Asset Changes" name="submit" id="submit">
			</div>
		</form>
		<br>
		<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
		<br><br>
	</div>

	<?php
		/* Form handler - Executes on 'Update Asset' submit button clicked. */
		if (isset($_POST['submit'])) {

			/* Prepare statement for UPDATE Asset's details. */
			if (!($stmt = $mysqli->prepare("UPDATE Asset SET Name=?, Description=?, Radius=?, Mass=?, ApMag=?
											WHERE id=?"))) {
				echo "<p class=\"error\">Prepare for Asset UPDATE query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
			}

			// Sanitize user input.
			$cleaner = new Cleaner();
			$_name = $cleaner->CleanString($_POST['Name']);
			$_descr = $cleaner->CleanString($_POST['Descr']);
			$_radius = $cleaner->CleanDecimal($_POST['Radius']);
			$_mass = $cleaner->CleanDecimal($_POST['Mass']);
			$_apMag = $cleaner->CleanDecimal($_POST['ApMag']);

			/* Bind Parameters for UPDATE Asset's details. */
			if (!($stmt->bind_param("ssdddi", $_name, $_descr, $_radius, $_mass, $_apMag, $_POST['assetID_']))) {
			echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			/* Execute UPDATE Asset's details. */
			if (!$stmt->execute()) {
				echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}
			else {
				echo "<p class=\"success\">Updated " . $stmt->affected_rows . " rows in table \"Asset\".</p>";
				echo "<p class=\"success\">Form has been cleared.</p>";
			}

			$stmt->close();

			// Clear the form!
			echo "<script type=\"text/javascript\">clearForm();</script>";
		}
	?>

	<!-- Decimal Places Control. -->
	<script
		src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
	</script>

	<script>
		$("#Radius, #Mass").blur(function() {
			this.value = Math.abs(parseFloat(this.value).toFixed(2));
		});
		$("#ApMag").blur(function() {
			this.value = parseFloat(this.value).toFixed(3);
		});
	</script>

</body>
</html>
