<!DOCTYPE html>
<html>
<head>
        <title>Birthday Formatter</title>
</head>
<body>
<?php

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
	$data = new DateTime($birthday_time);
	return $date->format('F j, Y h:i A');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" {
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
	echo "<p><a href='?birthday=$pretty_birthday'>Show date in ISO format</a></p>";
} elseif (isset($_GET["birthday"])) {
	//URL Parameter
	$user_birthday = sanitizeInput($_GET["birthday"]);

	//Display
	echo "<p>$user_birthday</p>";
} else {
	//Display Form
	echo "<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
		<table>
			<tr>
				<td>Month</td>
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
			</tr>
			<tr>
				<td>Day</td>
				<td>
					<input type='number' name='day' min='1' max='31' required>
				</td>
			</tr>
                        <tr>
                                <td>Year</td>
                                <td>
                                        <input type='number' name='year' min='1900' max='".date("Y")"' required>
                                </td>
                        </tr>
                        <tr>
                                <td>Hour</td>
                                <td>
                                        <input type='number' name='hour' min='1' max='12' required>
                                </td>
			</tr>
                        <tr>
                                <td>Minute</td>
                                <td>
                                        <input type='number' name='minute' min='0' max='59' required>
                                </td>
			</tr>
                        <tr>
                                <td>AM/PM</td>
                                <td>
					<select name='ampm' required>
						<option value='AM'>AM</option>
						<option value='PM'>PM</option>
					</select>
                                </td>
                        </tr>
		</table>
		<input type='submit' value='Format Date'>
	</form>";
}


?>
</body>
</html>

