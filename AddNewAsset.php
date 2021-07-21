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
		<h1>Diamond Buyers Inc.</h1>
		<h2>Add New Asset</h2>
		<?php // Get 'to be Owned_By' Account ID.
			if(isset($_POST['AddNewAsset'])){
				$id = $_POST['AddNewAsset'];
			}
		?>

<div>
	<fieldset class="fieldset-auto-width">
	<legend>Data Entry</legend>
		<fieldset class="fieldset-left">
			<form method="post">
            	<table class="ANC">
				<tr>
				<td width="100">Name:</td>
                <td width="200"><input name="Name" type="text" id="Name" maxlength="25" size="30" autocomplete="off" required></td>
				</tr>
				<tr>
                <td>Description:</td>
                <td><input name="Descr" type="text" id="Descr" maxlength="255" size="30" autocomplete="off" required></td>
				</tr>
                <tr>
                <td>Radius:</td>
                <td><input name="Radius" type="text" id="Radius" maxlength="11" size="13" autocomplete="off" required></td>
                </tr>
                <tr>
				<td>Mass:</td>
                <td><input name="Mass" type="text" id="Mass" maxlength="11" size="13" autocomplete="off" required></td>
				</tr>
                <tr>
                <td>Apparent Magnitude:</td>
                <td><input name="ApMag" type="text" id="ApMag" maxlength="7" size="10" autocomplete="off" required></td>
				</tr>
				<tr>
                <td>Create Date:</td>
                <td><input name="cDate" type="date" id="cDate" maxlength="12" size="12" autocomplete="off" required></td>
				</tr>
                <tr>
				<td>Owned By:</td>
                <td><input type="hidden" name="Owned_By" value="<?php echo $id; ?>"/>
                <input type="text" name="Owned_By" id="Owned_By" size="8" value="<?php echo $id; ?>" disabled="disabled" /></td></td>
                </tr>
				<tr><td></td><td align="right"><input type="submit" value="Add Asset" name="submit" id="submit"></td></tr>
                </table>
			</form>
            <script type="text/javascript">document.getElementById('cDate').value = getTDate();</script>
		</fieldset>
	</fieldset>
	<br><br>
	<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
	<br><br>
</div>

		<?php
			/* Form handler - Executes on 'Add Asset' submit button clicked. */
			if(isset($_POST['submit'])){
				/* Prepare statement for INSERT new customer's details. */
				if(!($stmt = $mysqli->prepare("INSERT INTO Asset (Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By)
											   VALUES(?,?,?,?,?,?,?)"))) {
						echo "<p class=\"error\">Prepare for Asset INSERT query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
				}

				/* Bind Parameters for INSERT new Asset's details. */
				if(!($stmt->bind_param("sdssssi", $_POST['Name'], $_POST['Descr'], $_POST['Radius'], $_POST['Mass'], $_POST['ApMag'], $_POST['cDate'], $_POST['Owned_By']))) {
					echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				}

				/* Execute INSERT new Asset's details. */
				if(!$stmt->execute()){
					echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
				} else {
					echo "<p class=\"success\">Added " . $stmt->affected_rows . " new Asset to Asset table.</p>";
				}

				$stmt->close();
			}
		?>

	</body>
</html>
