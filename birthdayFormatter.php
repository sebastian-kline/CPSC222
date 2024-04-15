<!DOCTYPE html>
<html>
<head>
        <title>Birthday Formatter</title>
</head>
<body>
<h1>Birthday Formatter</h1>
<?php

$show_form = true;

//Input Sanitzer
function sanitizeInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Formater
function formatBirthday($month, $day, $year, $hour, $minute, $ampm) {
	$time_format = "H:i";
	if ($ampm == "PM" && $hour == 12) {
		$hour += 12;
	} elseif ($ampm == "AM" && $hour == 12) {
		$hour = 0;
	}
	$birthday_time = sprintf("%04d-%02d-%02d %02d:%02d", $year, $month, $day, $hour, $minute);
	$date = new DateTime($birthday_time);
	return $date->format('F j, Y h:i A');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$show_form = false;

	//Saniter
	$user_month = sanitizeInput($_POST["month"]);
	$user_day = sanitizeInput($_POST["day"]);
	$user_year = sanitizeInput($_POST["year"]);
	$user_hour = sanitizeInput($_POST["hour"]);
	$user_minute = sanitizeInput($_POST["minute"]);
	$user_ampm = sanitizeInput($_POST["ampm"]);

	//Format Birthday
	$pretty_birthday = formatBirthday($user_month, $user_day, $user_year, $user_hour, $user_minute, $user_ampm);

	//Display
	echo "<p>$pretty_birthday</p>";

	//ISO Link
	echo "<p><a href='?birthday=".urlencode($pretty_birthday)."'>Show date in ISO format</a></p>";
}
if (isset($_GET["birthday"])) {
	//URL Parameter
	$user_birthday = sanitizeInput($_GET["birthday"]);

	//Display
	echo "<p>$user_birthday</p>";
}

if($showform) {
?>
	<form method='post' action="<?php echo $_SERVER['PHP_SELF'];  ?>">
		<table border="1">
			<tr>
				<th>Month</th>
				<th>Date</th>
				<th>Year</th>
				<th>Hour</th>
				<th>Minute</th>
				<th>AM/PM</th>
			</tr>
			<tr>
				<td>
					<select name='month' required>
						<option value ='1'>January</option>
                                                <option value ='2'>February</option>
                                                <option value ='3'>March</option>
                                                <option value ='4'>April</option>
                                                <option value ='5'>May</option>
                                                <option value ='6'>June</option>
                                                <option value ='7'>July</option>
                                                <option value ='8'>August</option>
                                                <option value ='9'>September</option>
                                                <option value ='10'>October</option>
                                                <option value ='11'>November</option>
                                                <option value ='12'>December</option>
					</select>
				</td>
				<td>
					<select name='day' required>
						<?php
						for($i = 1; $i <= 31; $i++) {
							echo "<option value='$i'>$i</option>";
						}
						?>
					</select>
				</td>
                                <td>
					<select name='year' required>
						<?php 
						$currentYear = date("Y");
						for($i = $currentYear; $i >= 1900; $i--) {
							echo "<option value='$i'>$i</option>";
						}
						?>
					</select>
                                </td>
                                <td>
                                        <select name='hour' required>
                                                <?php
                                                for($i = 1; $i <= 12; $i++) {
                                                        echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                        </select>
                                </td>
                                <td>
                                        <select name='minute' required>
                                                <?php
						for($i = 0; $i <= 59; $i++) {
							$minute = ($i < 10) ? "0$i" : $i;
                                                        echo "<option value='$minute'>$minute</option>";
                                                }
                                                ?>
                                        </select>
                                </td>
                                <td>
					<select name='ampm' required>
						<option value='AM'>AM</option>
						<option value='PM'>PM</option>
					</select>
                                </td>
			</tr>
			<tr>
				<td colspan="6" style="text-align: center;">
					<input type="submit" value="Format Date">
				</td>
			</tr>
		</table>
	</form>
<?php } ?>

</body>
</html>

