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
  ?>
</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Show Transactions and Commissions Paid By Date Range</h2>
	<div class="container">
		<h3>Confidential</h3>
		<!-- Note inline stle override - force table width and centering! Noop from style.css -->
		<table class="table table-hover table-bordered" style="width: 35%; margin-left: auto; margin-right: auto;">
			<thead>
				<tr>
					<th class="text-center bold">Contracted</th>
					<th class="text-center bold">Total Commissions</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (!($stmt = $mysqli->prepare("SELECT SUM(Trans_at) AS 'Contracted', SUM(Com_pd) AS 'Total_Commissions'
																					FROM Contract
																					WHERE Eff_Date >= ? AND Eff_Date <= ?"))) {
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!($stmt->bind_param("ss", $_POST['begDate'], $_POST['endDate']))) {
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($Contracted, $Total_Commissions)) {
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td align=\"center\">\n" . "$" . $Contracted . "\n</td>\n<td align=\"center\">\n" . "$" . $Total_Commissions . "\n</td>\n</tr>";
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
