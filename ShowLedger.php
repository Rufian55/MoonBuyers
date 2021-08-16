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
	<h2>Show General Ledger</h2>
	<div class="container">
		<h3>Confidential</h3>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<td class="bold">Ledger ID</td>
						<td class="bold"><span class="span-hide">__</span>Date<span class="span-hide">__</span></td>
						<td class="bold">Contract ID</td>
						<td class="bold">Asset ID</td>
						<td class="bold">Amount</td>
						<td class="bold">Commission</td>
						<td class="bold">Asset Name</td>
				</tr>
			</thead>
			<tbody>
				<?php
					if (!($stmt = $mysqli->prepare("SELECT L.id, L.date_time, CO.id as ID, CO.Asset_ID, CO.Trans_at, CO.Com_pd,
																						AST.Name, AST.Owned_By
																					FROM Ledger L
																					INNER JOIN Contract CO ON CO.L_ID = L.id
																					INNER JOIN Contract_Asset CA ON CA.Contract_ID = CO.id
																					INNER JOIN Asset AST ON AST.id = CA.Asset_ID
																					ORDER BY L.id ASC"))) {
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($id, $date_time, $ID, $Asset_ID, $Trans_at, $Com_pd, $Name, $Owned_By)) {
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $date_time . "\n</td>\n<td>\n" . $ID .
								 "\n</td>\n<td>\n" . $Asset_ID . "\n</td>\n<td>\n" . $Trans_at . "\n</td>\n<td>\n" . $Com_pd .
								 "\n</td>\n<td>\n" . $Name . "\n</td>\n</tr>";
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
