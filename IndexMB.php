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
<h2>Main Page</h2>
<div>
	<fieldset class="fieldset-width_1">
	<legend>Select Task</legend>
		<fieldset class="fieldset-inner">
        	<div class="overflow">
			<p><a href="ShowAccount.php">Show All Accounts</a></p>
			<fieldset>
            <p>Show Account By Account Number</p> 
			<form method="post" action="ShowAcctByID.php">
				<select name="Account_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Account"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Account By This Account Number" id="button"/>
			</form>
            </fieldset>
			<br>
			<fieldset>
			<p>Show Account By Customer ID</p> 
			<form method="post" action="ShowAcctByCID.php">
				<select name="Customer_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Customers"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Account By This Cutomer ID" id="button"/>
			</form>
            </fieldset>
			<br>
            <fieldset>
			<p>Show Account By Customer Phone</p>
			<form method="post" action="ShowAcctByPhone.php">
				<select name="Phone">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT Phone FROM Customers ORDER BY Phone ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($Phone)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $Phone . ' "> ' . $Phone . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Account By This Customer Phone" id="button"/>
			</form>
			</fieldset>
			<br>
			<p><a href="RecordTrans.php">Record A Transaction</a></p>

			<p><a href="ShowAllAssets.php">Show All Assets</a></p>
			<br>
			<fieldset>
			<p>Show Asset Ownership By Asset ID</p>
			<form method="post" action="ShowAssetByID.php">
				<select name="Asset_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Asset ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Asset Owner By This Asset ID" id="button"/>
			</form>
			</fieldset>
			<br>
			<fieldset>
			<p>Show Assets Owned By Account Number</p>
			<form method="post" action="ShowAssetByAccID.php">
				<select name="Asset_BY_ACC_ID">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Account ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Asset Owned By This Account Number" id="button"/>
			</form>
			</fieldset>
			<br>
			<fieldset>
			<p>Edit An Asset</p>
			<form method="post" action="EditAsset.php">
				<select name="EditAsset">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Asset ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Edit This Asset" id="button"/>
			</form>
			</fieldset>
			<br>
			<fieldset>
			<p>Add New Asset to Selected Account Number</p>
			<form method="post" action="AddNewAsset.php">
				<select name="AddNewAsset">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Account ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Add Asset to this Account Number" id="button"/>
			</form>
			</fieldset>
			<br>
			<fieldset>
			<p>Show Transactions and Commisions Paid by Date Range</p>
			<form method="post" action="showTCPaid.php">
			<input name="begDate" type="date" id="begDate" value="<?php echo date("Y-m-d", mktime(0,0,0,01,01,2011)); ?>" required>
			<input name="endDate" type="date" id="endDate" value="<?php echo date("Y-m-d"); ?>" required>
			<input type="submit" value="Show This Date Range" id="button"/>
			</form>
            </fieldset>
			<br>
			<p><a href="AddNewCustomer.php">Add New Customer and Account</a></p>
			<br>
			<fieldset>
			<p>Update Customer Details (Not Balance!)</p>
			<form method="post" action="UpdateCustomer.php">
				<select name="updateCustomer">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Customers ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Update This Customer" id="button"/>
			</form>
			</fieldset>
			<br>
			<fieldset>
			<p>Update Customer Balance</p>
			<form method="post" action="UpdateAccBalance.php">
				<select name="updateBalance">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Account ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Update This Account Balance" id="button"/>
			</form>
			</fieldset>
			<br>
			<p><a href="ShowLedger.php">Show General Ledger</a></p>
			<br>
			<fieldset>
			<p>Show Blockchain By Asset ID</p>
			<form method="post" action="ShowLedgerByID.php">
				<select name="LedgerByAsset">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id FROM Asset ORDER BY id ASC"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
				<input type="submit" value="Show Blockchain for This Asset" id="button"/>
			</form>
			</fieldset>
		</div>
        </fieldset>
	</fieldset>
</div>
</body>

</html>
