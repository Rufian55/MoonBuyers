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
<h2>Show General Ledger</h2>
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Confidential</legend>
		<fieldset class="fieldset-left">
			<table class="table_display">
				<tr>
					<td class="bold">Ledger ID</td>
					<td class="bold">Date &amp; Time</td>
					<td class="bold">Contract ID</td>
					<td class="bold">Asset ID</td>
					<td class="bold">Amount</td>
					<td class="bold">Commission</td>
					<td class="bold">Description</td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT L.id, L.date_time, CO.id as ID, CO.Asset_ID, CO.Trans_at, CO.Com_pd,
									  AST.Description, AST.Owned_By
							   FROM Ledger L
							   INNER JOIN Contract CO ON CO.L_ID = L.id
							   INNER JOIN Contract_Asset CA ON CA.Contract_ID = CO.id
							   INNER JOIN Asset AST ON AST.id = CA.Asset_ID
							   ORDER BY L.id ASC"))){
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($id, $date_time, $ID, $Asset_ID, $Trans_at, $Com_pd, $Description, $Owned_By)){
	echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $date_time . "\n</td>\n<td>\n" . $ID . "\n</td>\n<td>\n" . $Asset_ID . "\n</td>\n<td>\n" . $Trans_at . "\n</td>\n<td>\n" . $Com_pd . "\n</td>\n<td>\n" . $Description . "\n</td>\n</tr>";
}

$stmt->close();
?>
			</table>
		</fieldset>
	</fieldset>
    <br><br>
    <button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
</div>
</body>

</html>
