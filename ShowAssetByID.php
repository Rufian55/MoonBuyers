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
	<h2>Show Asset By Asset ID</h2>
	<div class="container">
		<h3>Confidential</h3>
		<table class="table table-hover table-bordered">
			<thead>
				<tr class="success">
					<th class="text-center bold">Asset ID</th>
					<th class="text-center bold">Contract ID</th>
					<th class="text-center bold">Value</th>
					<th class="text-center bold">Account ID</th>
					<th class="text-center bold">Effective Date</th>
					<th class="text-center bold">Form</th>
					<th class="text-center bold">Company Name</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (!($stmt = $mysqli->prepare("SELECT AST.id, CA.Contract_ID, CO.Trans_at AS 'Value',
																						CO.B_Acct_ID, CO.Eff_Date, CU.Lname, CU.Fname
																					FROM Asset AST
																					INNER JOIN Contract_Asset CA ON CA.Asset_ID = AST.id
																					INNER JOIN Contract CO ON CO.id = CA.Contract_ID
																					INNER JOIN Contract_Customers CC ON CC.Contract_ID = CO.id
																					INNER JOIN Customers CU ON CU.id = CC.Customer_ID
																					WHERE AST.id = ?
																					ORDER BY CO.Eff_Date DESC LIMIT 1"))) {
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					if (!($stmt->bind_param("i", $_POST['Asset_ID']))) {
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($id, $Contract_ID, $Value, $B_Acct_ID, $Eff_Date, $Lname, $Fname)) {
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Contract_ID . "\n</td>\n<td>\n" . "$" . $Value .
								 "\n</td>\n<td>\n" . $B_Acct_ID . "\n</td>\n<td>\n" . $Eff_Date . "\n</td>\n<td>\n" . $Lname .
								 "\n</td>\n<td>\n" . $Fname . "\n</td>\n</tr>";
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
