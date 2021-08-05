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
    require('../includes/Sanitizer.php');
  ?>

<script type="text/javascript">
  // Clears prepopulated form following Update Customer submit button click. 
  function clearForm() {
    document.getElementById("Balance_").value="";
    document.getElementById("id_").value="";
  }
</script>
</head>

<body>
	<h1>MoonBuyers InterGalactic</h1>
	<h2>Update Customer Balance</h2>
	<div class=container>
		<h3>Current Confidential Customer Balance</h3>
			<!-- Note inline style override - force table width and centering! Noop from style.css -->
			<table class="table table-hover table-bordered" style="width: 35%; margin-left: auto; margin-right: auto;">
				<thead>
				<tr>
					<td class="bold">Account ID</td>
					<td class="bold">Customer ID</td>
					<td class="bold">Balance</td>
				</tr>
			</thead>
			<tbody>
				<?php // Get Customer records.
					if (isset($_POST['updateBalance'])) {

						if (!($stmt = $mysqli->prepare("SELECT id, C_ID, Balance
																						FROM Account
																						WHERE id=?"))) {
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!($stmt->bind_param("i", $_POST['updateBalance']))) {
							echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
						}

						if (!$stmt->execute()) {
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if (!$stmt->bind_result($id, $C_ID, $Balance)) {
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						while ($stmt->fetch()) {
							echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $C_ID . "\n</td>\n<td>\n" . $Balance . "\n</td>\n</tr>";
						}

						$stmt->close();
					}
				?>
			</tbody>
		</table>

		<br>

		<h2>Make Corrections</h2>
		<form method="post">
     	<div class="form-group container">
     		<?php // Note hidden id field needed as $_POST['id'] is lost on 2nd post. ?>
				<input class="form-control hidden" type="text" name="id_" id="id_" size="20" value="<?php echo $id; ?>">
				<input class="form-control" type="number" name="Balance_" id="Balance_" size="18" step="0.01" maxlength="14" value="<?php echo $Balance; ?>" placeholder="Enter New Balance" required>
        <br>
        <input type="submit" value="Update Balance" name="submit" id="submit">
      </div>
		</form>
		<br>
		<button type="button" class="button" onclick="location.href = 'IndexMB.php';">Return to Main Page</button>
		<br>
	</div>

	<?php 
		/* Form handler - Executes on 'Update Balance' submit button clicked. */
		if (isset($_POST['submit'])) {

			// Prepare statement for UPDATE customer's details.
			if (!($stmt = $mysqli->prepare("UPDATE Account SET Balance=? WHERE id=?"))) {
				echo "<p class=\"error\">Prepare for Account Balance UPDATE query failed: " . $stmt->errno . " " . $stmt->error . "</p>"; 
			}

			$cleaner = new Cleaner();
			$_Balance = $cleaner->CleanDecimal($_POST['Balance_']);

			// Bind Parameters for UPDATE customer's Balance.
			if (!($stmt->bind_param("di", $_Balance, $_POST['id_']))) {
				echo "<p class=\"error\">Bind failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}

			// Execute UPDATE customer's Balance.
			if (!$stmt->execute()) {
				echo "<p class=\"error\">Execute failed: "  . $stmt->errno . " " . $stmt->error . "</p>";
			}
			else {
				echo "<p class=\"success\">Updated " . $stmt->affected_rows . " row (Balance) in customer's \"Account\".</p>";
				echo "<p class=\"success\">Form has been cleared.</p>";
			}
			// Clear the form!
			echo "<script type=\"text/javascript\">clearForm();</script>";
		}
	?>

	<!-- Decimal Places Control! -->
	<script
	 src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
	</script>

	<script>
		$("#Balance_").blur(function() {
			this.value = parseFloat(this.value).toFixed(2);
		});
	</script>

</body>
</html>
