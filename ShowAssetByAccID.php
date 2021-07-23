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
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Confidential</legend>
		<fieldset class="fieldset-left">
			<table class="table_display">
				<tr>
					<td class="bold">Asset ID</td>
					<td class="bold">Name</td>
					<td class="bold">Description</td>
					<td class="bold">Radius</td>
					<td class="bold">Mass</td>
					<td class="bold">Apparent Magnitude</td>
					<td class="bold">Create Date</td>
					<td class="bold">Owned By</td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT id, Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By
							   FROM Asset
							   WHERE Owned_By = ?
							   ORDER BY Asset.id ASC"))){
	echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['Asset_BY_ACC_ID']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($id, $Name, $Description, $Radius, $Mass, $ApMag, $Create_Date, $Owned_By)){
	echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Name . "\n</td>\n<td>\n" . $Description . "\n</td>\n<td>\n" . $Radius . "\n</td>\n<td>\n" . $Mass . "\n</td>\n<td>\n" . $ApMag . "\n</td>\n<td>\n" . $Create_Date . "\n</td>\n<td>\n" . $Owned_By . "\n</td>\n</tr>";
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
