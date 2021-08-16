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
	<h3>Confidential</h3>
	<h2>Transacted Asset Details By Asset ID <span class="colorRed">*</span></h2>

	<?php // Memoize Asset_ID lest it be lost in 2nd table.
		if (isset($_POST['Asset_ID'])) {
			$assetID = $_POST['Asset_ID'];
		}
	?>

	<div class="container">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
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
					/*** TRANSACTED ASSETS ***/
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

					if (!($stmt->bind_param("i", $assetID))) {
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

	</div>

	<br><br>
	<h2>Asset Owned By Account Number <span class="colorRed">*</span></h2>
	<div class=container>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="text-center bold">Asset ID</th>
					<th class="text-center bold">Name</th>
					<th class="text-center bold">Create<span class="span-hide">_</span>Date</th>
					<th class="text-center bold">Owned By</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if (!($stmt = $mysqli->prepare("SELECT id, Name, Create_Date, Owned_By
																					FROM Asset
																					WHERE id = ?"))) {
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}

					if (!($stmt->bind_param("i", $assetID))) {
						echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if (!$stmt->execute()) {
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!$stmt->bind_result($id, $Name, $Create_Date, $Owned_By)) {
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					while ($stmt->fetch()) {
						echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Name . "\n</td>\n<td>\n" . $Create_Date . "\n</td>\n<td>\n" . $Owned_By .
								 "\n</td>\n</tr>";
					}

					$stmt->close();
				?>
			</tbody>
		</table>
		<br>
    <button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
    <br><br>

    <div class="row">
			<div class="col-md-3"></div>
      <div class="col-md-6">
      	<p class="success"><span class="error">*</span> Assets that appear in the lower "Asset Owned By Account Number" table, but not in the top "Transacted Asset Details By Asset ID" table, indicate the asset was newly added to this account on the Create Date indicated, but has not yet had a commission generating Buy/Sell transaction recorded.</p>
      </div>
      <div class="col-md-3"></div>
    </div>

	</div>

</body>
</html>
