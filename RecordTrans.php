<?php
	// Login Credentials required.
	require('../includes/ProtectMB.php');
	// Destroy session at time limit.
	require('../includes/SessionExpire.php');
	// Turn on error reporting.
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	// Import dBase Credentials.
	require('../../project/g3f2Kcd57nE4s25.php');
	// Connect to the database.
	$mysqli = new mysqli($servername, $username, $password, $database);
	/* Date details for 1,000 years in the future per "mktime($hour,$minute,$second,$month,$day,$year)" */
	$dateTime = new DateTime("NOW");
	$day = $dateTime->format('d');
	$month = $dateTime->format('m');
	$year = $dateTime->format('Y') + 1000;
?>

<!DOCTYPE HTML>
<html>

<head>
	<?php
		include('../includes/HeadMB.php');
		require('../includes/Sanitizer.php');
	?>
</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Record A Transaction</h2>
	<div class="container">
		<h3>Data Entry</h3>
		<form method="post">
			<div class="form-group container">
				<h4>Select Asset ID</h4>
				<select name="Asset_ID">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id FROM Asset ORDER BY id ASC"))) {
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						if (!$stmt->execute()) {
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if (!$stmt->bind_result($id)) {
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()) {
							echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
						}
						$stmt->close();
					?>
				</select>
				<br><br>
				<h4>Select Buyer's Account Number</h4>
				<select name="B_Acct_ID">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id FROM Account ORDER BY id ASC"))) {
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						if (!$stmt->execute()) {
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if (!$stmt->bind_result($id)) {
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while ($stmt->fetch()) {
							echo '<option value=" '. $id . ' "> ' . $id . '</option>\n';
						}
						$stmt->close();
					?>
				</select>
				<br><br>
				<h4>Select Transaction Date</h4>
				<h5>Management approval required for any date other than: <?php echo date("m-d-Y", mktime(0,0,0,$month,$day,$year)); ?></h5>
				<input name="Eff_Date" type="date" id="Eff_Date" value="<?php echo date("Y-m-d", mktime(0,0,0,$month,$day,$year)); ?>" required>
				<br><br>
				<input class="form-control" type="number" min="0" step="0.01" name="Trans_at" id="Trans_at" maxlength="12" placeholder="Transacted At" required>
				<input class="form-control" type="number" min="0" step="0.01" name="Com_pd" id="Com_pd" maxlength="12" placeholder="Commission" required>
				<br>
				<input type="submit" value="Record Transaction" name="submit" id="submit">
			</div>
		</form>
		<br>
		<button type="button" class="button" onclick="location.href='IndexMB.php';">Return to Main Page</button>
		<br><br>
	</div>

	<?php
		// FORM HANDLER - Executes on 'Record Transaction' submit button click.
		if (isset($_POST['submit'])) {

			/*** 1. Determine Seller's Account ID from Asset ID being sold. ***/
			if (!($stmt = $mysqli->prepare("SELECT Owned_By FROM Asset WHERE id = ?"))) {
				echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
			}
			if (!($stmt->bind_param("i", $_POST['Asset_ID']))) {
				echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
			}
			if (!$stmt->execute()){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if (!$stmt->bind_result($Owned_By)) {
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			// Our Seller's Account ID.
	 		while ($stmt->fetch()) {
				$S_Acct_ID = $Owned_By;
			}
			echo "<p class=\"success\">Seller's Account: " . $S_Acct_ID . " | Buyer's Account: " . $_POST['B_Acct_ID'] . "</p>";
			$stmt->close();

			/*** 2. Check for Buyer's Account NOT EQUAL to Seller's Account and process tranasaction. ***/
			if ($_POST['B_Acct_ID'] != $S_Acct_ID) {

				// Lock tables for writing - protect integrity of new Ledger ID retrieval.
				if (!$mysqli->query("LOCK TABLES Ledger WRITE, Contract WRITE, Contract_Asset WRITE,
														Contract_Customers WRITE, Asset WRITE, Account WRITE")) {
					echo "<p class=\"error\">ERROR! Tables did not lock for writing: (" . $mysqli->errno . ")" . $mysqli->error . "</p>";
				}

				/*** 3. Make Ledger entry and retrieve ID. ***/
				
				// Prepare statement for INSERT new Ledger record.
				if (!($stmt = $mysqli->prepare("INSERT INTO Ledger (date_time) VALUES(?)"))) {
					echo "<p class=\"error\">Ledger INSERT timestamp query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
				}

				// Bind Parameters for INSERT new Ledger record.
				if (!($stmt->bind_param("s", $_POST['Eff_Date']))) {
					echo "<p class=\"error\">Bind 3 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}

				// Execute INSERT new Ledger details.
				if (!$stmt->execute()){
					echo "<p class=\"error\">Execute 3 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
				}
				
				// Retrieve last insert ID which = new Ledger ID.
				$temp = $mysqli->insert_id;
				echo "<p class=\"success\">New Ledger ID = " . $temp . "</p>";

				/*** 4. Record Contract details and retrieve new Contract record ID. ***/
				
				// Prepare statement for new Contract record.
				if (!($stmt = $mysqli->prepare("INSERT INTO Contract (Asset_ID, B_Acct_ID, S_Acct_ID, Eff_Date, Trans_at, Com_pd, L_ID)
									   VALUES(?,?,?,?,?,?,?)"))) {
					echo "<p classs=\"error\">Prepare for Contract INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}

				// Sanitize via Sanitizer.php->Cleaner() class.
				$cleaner = new Cleaner();
				$trans_at = $cleaner->CleanDecimal($_POST['Trans_at']);
				$com_pd = $cleaner->CleanDecimal($_POST['Com_pd']);

				// Bind Parameters for INSERT new Contract details.
				if (!($stmt->bind_param("iiisddi", $_POST['Asset_ID'], $_POST['B_Acct_ID'], $S_Acct_ID, $_POST['Eff_Date'], $trans_at, $com_pd, $temp))){
					echo "<p class=\"error\">Bind 4 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute INSERT new Contract details.
				if (!$stmt->execute()){
					echo "<p class=\"error\">Execute 4 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
				}
				// Retrieve last insert ID which = new Contract ID.
				$temp = $mysqli->insert_id;
				echo "<p class=\"success\">Last Contract insert_id, a.k.a. New Contract ID = " . $temp . "</p>";

				/*** 5. Add Contract_Asset junction table record. ***/

				// Prepare statement for new Contract_Asset record.
				if (!($stmt = $mysqli->prepare("INSERT INTO Contract_Asset (Contract_ID, Asset_ID) VALUES(?,?)"))) {
					echo "<p classs=\"error\">Prepare for Contract_Asset INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Bind Parameters for INSERT new Contract_Asset details.
				if (!($stmt->bind_param("ii", $temp, $_POST['Asset_ID']))) {
					echo "<p class=\"error\">Bind 5 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute INSERT new Contract_Asset details.
				if (!$stmt->execute()) {
					echo "<p class=\"error\">Execute 5 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
				}
				else {
					echo "<p class=\"success\">Contract_Asset junction table updated successfully.</p>"; 
				}

				/*** 6. Add Buyer's Contract_Customer junction table record. ***/
				
				// Prepare statement for Contract_Customers Buyer's record.
				if (!($stmt = $mysqli->prepare("INSERT INTO Contract_Customers (Contract_ID, Customer_ID)
												VALUES(?,(SELECT C_ID FROM Account WHERE id = ?))"))) {
					echo "<p classs=\"error\">Prepare for Contract_Asset INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Bind Parameters for INSERT new Contract_Customer Buyer's record.
				if (!($stmt->bind_param("ii", $temp, $_POST['B_Acct_ID']))) {
					echo "<p class=\"error\">Bind 6 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute INSERT new Contract_Customer Record A.
				if (!$stmt->execute()){
					echo "<p class=\"error\">Execute 6 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
				}

				/*** 7. Add Seller's Contract_Customer junction table record. ***/

				// Prepare statement for Contract_Customers Seller's record.
				if (!($stmt = $mysqli->prepare("INSERT INTO Contract_Customers (Contract_ID, Customer_ID)
												VALUES(?,(SELECT C_ID FROM Account WHERE id = ?))"))) {
					echo "<p classs=\"error\">Prepare for Contract_Asset INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Bind Parameters for INSERT new Contract_Customer Seller's record.
				if (!($stmt->bind_param("ii", $temp, $S_Acct_ID))) {
					echo "<p class=\"error\">Bind 7 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute INSERT new Contract_Customer Seller's Record.
				if (!$stmt->execute()) {
					echo "<p class=\"error\">Execute 7 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error . "</p>";
				}
				else {
					echo "<p class=\"success\">Contract_Customer junction table updated successfully.</p>";
				}

				/*** 8. Update Asset Ownership account. ***/

				// Prepare statement for UPDATE Asset's details.
				if (!($stmt = $mysqli->prepare("UPDATE Asset SET Owned_By=? WHERE id=?"))) {
					echo "<p class=\"error\">Prepare for Asset UPDATE query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
				}
				// Bind Parameters for UPDATE Asset's details.
				if (!($stmt->bind_param("ii", $_POST['B_Acct_ID'], $_POST['Asset_ID']))) {
					echo "<p class=\"error\">Bind 8 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute UPDATE Asset's ownership record.
				if (!$stmt->execute()) {
					echo "<p class=\"error\">Execute 8 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				else {
					echo "<p class=\"success\">Updated " . $stmt->affected_rows . " row in Asset table.</p>";
				}

				/*** 9. Retrieve current Buyer's account Balance and update it with tranasction details. ***/

				// Prepare statement for Buyer's account balance query.
				if (!($stmt = $mysqli->prepare("SELECT Balance FROM Account WHERE id=?"))) {
					echo "Prepare 9 failed: "  . $stmt->errno . " " . $stmt->error;
				}
				// Bind Parameters for INSERT new Contract_Customer record B.
				if (!($stmt->bind_param("i", $_POST['B_Acct_ID']))) {
					echo "<p class=\"error\">Bind_param 9 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				if (!$stmt->execute()) {
					echo "Execute 9 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if (!$stmt->bind_result($Balance)) {
					echo "Bind_result 9 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				// Our Buyer's current account balance.
				while ($stmt->fetch()) {
					$B_Balance = $Balance;
				}
				$stmt->close();

				// Calculate new Buyer's Account balance less transaction cost and 1/2 of the commission.
				$B_Balance = $B_Balance - ($trans_at + ($com_pd / 2) );

				// Prepare statement for UPDATE Buyer's Account Balance.
				if (!($stmt = $mysqli->prepare("UPDATE Account SET Balance=? WHERE id=?"))) {
					echo "<p class=\"error\">Prepare for Account Balance UPDATE query failed: " . $stmt->errno . " " . $stmt->error . "</p>"; 
				}
				// Bind Parameters for UPDATE buyer's account balance.
				if (!($stmt->bind_param("di", $B_Balance, $_POST['B_Acct_ID']))) {
					echo "<p class=\"error\">Bind for Update Buyer's account (9) failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute UPDATE Buyer's account balance.
				if (!$stmt->execute()) {
					echo "<p class=\"error\">Execute for Update Buyer's account (9) failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				else {
					echo "<p class=\"success\">Updated " . $stmt->affected_rows . " row (Balance) in Buyer's Account.</p>";
				}

				/*** 10. Retrieve current Seller's account Balance and update it with tranasction details. ***/

				// Prepare statement for Seller's account balance query.
				if (!($stmt = $mysqli->prepare("SELECT Balance FROM Account WHERE id=?"))) {
					echo "Prepare 10 failed: "  . $stmt->errno . " " . $stmt->error;
				}
				// Bind Parameters for Seller's Contract_Customer record query.
				if (!($stmt->bind_param("i", $S_Acct_ID))) {
					echo "<p class=\"error\">Bind_param 10 failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
		  		if (!$stmt->execute()) {
					echo "Execute 10 failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if (!$stmt->bind_result($Balance)) {
					echo "Bind-result 10 failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				// Our Seller's curretn account balance.
				while ($stmt->fetch()) {
					$S_Balance = $Balance;
				}
				$stmt->close();

				// Calculate new Seller's Account balance less transaction cost and 1/2 of the commission.
				$S_Balance = $S_Balance + ($trans_at + ($com_pd / 2) );

				// Prepare statement for UPDATE Seller's Account Balance.
				if (!($stmt = $mysqli->prepare("UPDATE Account SET Balance=? WHERE id=?"))) {
					echo "<p class=\"error\">Prepare for Account Balance UPDATE query failed: " . $stmt->errno . " " . $stmt->error . "</p>"; 
				}
				// Bind Parameters for UPDATE Seller's account balance.
				if (!($stmt->bind_param("di", $S_Balance, $S_Acct_ID))) {
					echo "<p class=\"error\">Bind for update Seller's account failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				// Execute UPDATE Seller's account balance.
				if (!$stmt->execute()) {
					echo "<p class=\"error\">Execute Update Seller's account failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}
				else {
					echo "<p class=\"success\">Updated " . $stmt->affected_rows . " row (Balance) in Seller's Account.</p>";
				}

			// UNLOCK tables.
			if (!$mysqli->query("UNLOCK TABLES")) {
				echo "<p class=\"error\">ERROR! Tables did not unlock following write: (" . $mysqli->errno . ")" . $mysqli->error . "</p>";
			}
			$stmt->close();

		}
		else {
			echo "<p class=\"error\">Buyer's Account ID and Seller's Account ID cannot be the same!</p>";}
		}
	?>
		<!-- Decimal Places Control. -->
	<script
		src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
	</script>

	<script>
		$("#Trans_at, #Com_pd").blur(function() {
			this.value = Math.abs(parseFloat(this.value).toFixed(2));
		});
	</script>


</body>
</html>
