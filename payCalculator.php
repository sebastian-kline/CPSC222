<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//hard coded variables
$employeeName = "Sebastian Kline"; //employee name
$hoursWorked = 40.0; //hours worked in a week
$payRate = 54.50; //hourly pay rate
$federalTaxRate = 0.245; //federal tax withholding rate
$stateTaxRate = 0.055; //state tax withholding rate

//calculations
$grossPay = $hoursWorked * $payRate;
$federalWithholding = $grossPay * $federalTaxRate;
$stateWithholding = $grossPay * $stateTaxRate;
$totalDeductions = $federalWithholding + $stateWithholding;
$netPay = $grossPay - $totalDeductions;

//federal tax bracket
$federalTaxBracket = "";
if ($grossPay <= 11600) {
	$federalTaxBracket = "10%";	
}
elseif($grossPay >= 11601 && $grossPay <= 47150) {
	$federalTaxBracket = "12%";
}
elseif($grossPay >= 47151 && $grossPay <= 100525) {
	$federalTaxBracket = "22%";
}
elseif($grossPay >= 100526 && $grossPay <= 191950) {
	$federalTaxBracket = "24%";
}
elseif($grossPay >= 191951 && $grossPay <= 243725) {	
	$federalTaxBracket = "32%";
}
elseif($grossPay >== 243726 && $grossPay <= 609350) {
	$federalTaxBracket = "35%";
}
else {
	$federalTaxBracket = "37%";
}

//output
echo "<table>";
echo "<tr><th>Employee Name</th><td>$employeeName</td></tr>";
echo "<tr><th>Hours Worked</th><td>$hoursWorked</td></tr>;";
echo "<tr><th>Pay Rate</th><td>\$$payRate</td></tr>";
echo "<tr><th>Gross Pay</th><td>\$$grossPay</td></tr>";
echo "<tr><th>Federal Withholding(24.5%)</th><td>\$$federalWithholding</td></tr>";
echo "<tr>State Withholding (5.5%)<th></th><td>\$$stateWithholding</td></tr>";
echo "<tr><th>Total Deductions</th><td>\$$totalDeductions</td></tr>";
echo "<tr><th>Net Pay</th><td>\$$netPay</td></tr>";
echo "<tr><th>Federal Tax Bracket</th><td>$federalTaxBracket</td></tr>";
echo "</table>";
?>
