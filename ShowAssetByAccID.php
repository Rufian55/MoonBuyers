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
	<h2>Show Assets Owned By Account Number</h2>
	<div class=container>
		<h3>Confidential</h3>
		<table class="table table-striped table-hover table-bordered">
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
				<?php
					if (!($stmt = $mysqli->prepare("SELECT id, Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By
																					FROM Asset
																					WHERE Owned_By = ?
																					ORDER BY Asset.id ASC"))) {
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					if (!($stmt->bind_param("i", $_POST['Asset_BY_ACC_ID']))) {
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($id, $Name, $Description, $Radius, $Mass, $ApMag, $Create_Date, $Owned_By)) {
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Name . "\n</td>\n<td>\n" . $Description . "\n</td>\n<td>\n" . $Radius .
								 "\n</td>\n<td>\n" . $Mass . "\n</td>\n<td>\n" . $ApMag . "\n</td>\n<td>\n" . $Create_Date . "\n</td>\n<td>\n" . $Owned_By .
								 "\n</td>\n</tr>";
					}

					$stmt->close();
				?>
			</tbody>
		</table>
		<br>
    <button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
    <br><br>
	</div>

</body>
</html>
