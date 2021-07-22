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
<h2>Show Transactions and Commissions Paid By Date Range</h2>
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Confidential</legend>
		<fieldset class="fieldset-left">
			<table class="table_display">
				<tr>
					<td class="bold">Contracted</td>
					<td class="bold">Total Commissions</td>
				</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT SUM(Trans_at) AS 'Contracted', SUM(Com_pd) AS 'Total_Commissions' FROM Contract
							   WHERE Eff_Date >= ? AND Eff_Date <= ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("ss", $_POST['begDate'], $_POST['endDate']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($Contracted, $Total_Commissions)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo "<tr>\n<td align=\"center\">\n" . "$" . $Contracted . "\n</td>\n<td align=\"center\">\n" . "$" . $Total_Commissions . "\n</td>\n</tr>";
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
