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

  <script type="text/javascript">
    // Clears prepopulated form following Update Asset submit button click. 
    function clearForm() {
	  document.getElementById("id").value="";
	  document.getElementById("Name").value="";
	  document.getElementById("Description").value="";
	  document.getElementById("Radius").value="";
	  document.getElementById("Mass").value="";
	  document.getElementById("ApMag").value="";
	  document.getElementById("cDate").value="";
	  document.getElementById("Owned_By").value="";
    }
  </script>

</head>

<body>
<h1>MonBuyers InterGalactic</h1>
<h2>Edit An Asset</h2>
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Current Confidential Asset Details</legend>
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
                    <td class="bold">Owned_By</td>
				</tr>

<?php // Get Customer records.
if(isset($_POST['EditAsset'])){
	if(!($stmt = $mysqli->prepare("SELECT id, Name, Description, Radius, Mass, ApMag, Create_Date, Owned_By
								   FROM Asset WHERE id=?"))) {
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

if(!($stmt->bind_param("i", $_POST['EditAsset']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($id, $Name, $Description, $Radius, $Mass, $ApMag, $Create_Date, $Owned_By)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $Name . "\n</td>\n<td>\n" . $Description . "\n</td>\n<td>\n" . $Radius . "\n</td>\n<td>\n" . $Mass . "\n</td>\n<td>\n" . $ApMag . "\n</td>\n<td>\n" . $Create_Date . "\n</td>\n<td>\n" . $Owned_By . "\n</td>\n</tr>";
}

$stmt->close();
}
?>
			</table>
		</fieldset>
	</fieldset>
</div>
<br><br>
<div>
	<fieldset class="fieldset-auto-width">
	<legend>Make Corrections</legend>
		<fieldset class="fieldset-left">
			<form method="post">
            	<table class="ANC">
				<tr>
				<td>Asset ID:</td>
				<td><input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="text" name="id" id="id" size="8" value="<?php echo $id; ?>" disabled="disabled" /></td>
				</tr>
				<tr>
                <td>Name:</td>
                <td><input name="Name" type="text" id="Name" maxlength="30" size="30" required value="<?php echo $Name; ?>"></td>
				</tr>
				<tr>
				<td width="148">Description:</td>
                <td width="209"><input name="Description" type="text" id="Description" maxlength="255" size="40" required value="<?php echo $Description; ?>"></td>
				</tr>
                <tr>
                <td>Radius:</td>
                <td><input name="Radius" type="text" id="Radius" maxlength="30" size="30" required value="<?php echo $Radius; ?>"></td>
                </tr>
                <tr>
				<td>Mass:</td>
                <td><input name="Mass" type="text" id="Mass" maxlength="30" size="30" required value="<?php echo $Mass; ?>"></td>
				</tr>
                <tr>
				<td>Apparent Magnitude:</td>
                <td><input name="ApMag" type="text" id="ApMag" maxlength="25" size="25" required value="<?php echo $ApMag; ?>"></td>
				</tr>
				<tr>
                <td>Create Date:</td>
                <td><input name="cDate" type="date" id="cDate" required value="<?php echo $Create_Date; ?>"></td>
				</tr>
                <tr>
				<td>Owned by:</td>
                <td><input type="hidden" name="Owned_By" value="<?php echo $Owned_By; ?>"/>
                <input type="text" name="Owned_By" id="Owned_By" size="8" value="<?php echo $Owned_By; ?>" disabled="disabled" /></td>
                </tr>
				<tr><td></td><td align="right"><input type="submit" value="Update Asset" name="submit" id="submit"></td></tr>
                </table>
			</form>
		</fieldset>
	</fieldset>
	<br><br>
	<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
	<br><br>
</div>
<?php 
/* Form handler - Executes on 'Update Asset' submit button clicked. */
if(isset($_POST['submit'])){
	/* Prepare statement for UPDATE Asset's details. */
	if(!($stmt = $mysqli->prepare("UPDATE Asset SET Name=?, Description=?, Radius=?, Mass=?, ApMag=?, Create_Date=?
								   WHERE id=?"))) {
		echo "<p class=\"error\">Prepare for Asset UPDATE query failed: "  . $stmt->errno . " " . $stmt->error . "</p>" ; 
	}

	/* Bind Parameters for UPDATE Asset's details. */
	if(!($stmt->bind_param("ssiiisi", $_POST['Name'], $_POST['Description'], $_POST['Radius'], $_POST['Mass'], $_POST['ApMag'], $_POST['cDate'], $_POST['id']))){
	echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
	}

	/* Execute UPDATE Asset's details. */
	if(!$stmt->execute()){
		echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
	} else {
		echo "<p class=\"success\">Updated " . $stmt->affected_rows . " rows in table \"Asset\".</p>";
		echo "<p class=\"success\">Form has been cleared.</p>";
	}
	// Clear the form!
	echo "<script type=\"text/javascript\">clearForm();</script>";
}
?>

</body>
</html>
