<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Prashant Shah <pshah.mumbai@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once("header.php");

?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stock Selector</title>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<script>
$(document).ready(function() {
	$('#scripts').DataTable({
		"paging":   false,
	});
});
</script>

<?php

$results = $db->query("SELECT * FROM company LEFT JOIN stocks ON company.id = stocks.company_id WHERE date = '29-12-2015'");

echo "<table id='scripts' class='table table-striped table-bordered' width='100%' cellspacing='0'>";

echo "<thead>";
echo "<tr>";
echo "<th>" . 'name' . "</th>";
echo "<th>" . 'price' . "</th>";
echo "<th>" . 'high<br>52' . "</th>";
echo "<th>" . 'low<br>52' . "</th>";
echo "<th>" . 'pe' . "</th>";
echo "<th>" . 'pb' . "</th>";
echo "<th>" . 'enterprise<br>value' . "</th>";
echo "<th>" . 'market<br>cap' . "</th>";
echo "<th>" . 'altman<br>z<br>score' . "</th>";
echo "<th>" . 'piot<br>roski<br>f<br>score' . "</th>";
echo "<th>" . 'modi<br>fied<br>c<br>score' . "</th>";
echo "<th>" . 'curr<br>ent<br>pe' . "</th>";
echo "<th>" . 'median<br>pe' . "</th>";
echo "<th>" . 'current<br>pb' . "</th>";
echo "<th>" . 'median<br>pb' . "</th>";
echo "<th>" . 'earning<br>yield' . "</th>";
echo "<th>" . 'peg' . "</th>";
echo "<th>" . 'return<br>1<br>day' . "</th>";
echo "<th>" . 'return<br>1<br>week' . "</th>";
echo "<th>" . 'return<br>1<br>month' . "</th>";
echo "<th>" . 'return<br>3<br>months' . "</th>";
echo "<th>" . 'return<br>1<br>year' . "</th>";
echo "<th>" . 'return<br>10<br>years' . "</th>";
echo "<th>" . 'roe' . "</th>";
echo "<th>" . 'operating<br>margin' . "</th>";
echo "<th>" . 'free<br>cash<br>flow' . "</th>";
echo "<th>" . 'debt<br>equity<br>ratio' . "</th>";
echo "<th>" . 'long<br>term<br>debt' . "</th>";
echo "<th>" . 'networth' . "</th>";
echo "<th>" . 'revenue<br>growth<br>1y' . "</th>";
echo "<th>" . 'eps<br>growth<br>1y' . "</th>";
echo "<th>" . 'book<br>value<br>growth<br>1y' . "</th>";
echo "<th>" . 'revenue<br>growth<br>3y' . "</th>";
echo "<th>" . 'eps<br>growth<br>3y' . "</th>";
echo "<th>" . 'book<br>value<br>growth<br>3y' . "</th>";
echo "<th>" . 'revenue<br>growth<br>5y' . "</th>";
echo "<th>" . 'eps<br>growth<br>5y' . "</th>";
echo "<th>" . 'book<br>value<br>growth<br>5y' . "</th>";
echo "<th>" . 'ev<br>to<br>ebidta' . "</th>";
echo "<th>" . 'price<br>to<br>sales' . "</th>";
echo "<th>" . 'price<br>to<br>cash<br>flow' . "</th>";
echo "</tr>";
echo "</thead>";

while($row = $results->fetchArray()) {
	echo "<tr>";
	echo "<td>" . "<a href='editcompany.php?id=" . $row['id'] . "'>" . $row['name'] . "</a>" . "</td>";
	echo "<td>" . $row['price'] . "</td>";
	echo "<td>" . $row['high_52'] . "</td>";
	echo "<td>" . $row['low_52'] . "</td>";
	echo "<td>" . $row['pe'] . "</td>";
	echo "<td>" . $row['pb'] . "</td>";
	echo "<td>" . $row['enterprise_value'] . "</td>";
	echo "<td>" . $row['market_cap'] . "</td>";
	echo "<td>" . $row['altman_z_score'] . "</td>";
	echo "<td>" . $row['piotroski_f_score'] . "</td>";
	echo "<td>" . $row['modified_c_score'] . "</td>";
	echo "<td>" . $row['current_pe'] . "</td>";
	echo "<td>" . $row['median_pe'] . "</td>";
	echo "<td>" . $row['current_pb'] . "</td>";
	echo "<td>" . $row['median_pb'] . "</td>";
	echo "<td>" . $row['earning_yield'] . "</td>";
	echo "<td>" . $row['peg'] . "</td>";
	echo "<td>" . $row['return_1_day'] . "</td>";
	echo "<td>" . $row['return_1_week'] . "</td>";
	echo "<td>" . $row['return_1_month'] . "</td>";
	echo "<td>" . $row['return_3_months'] . "</td>";
	echo "<td>" . $row['return_1_year'] . "</td>";
	echo "<td>" . $row['return_10_years'] . "</td>";
	echo "<td>" . $row['roe'] . "</td>";
	echo "<td>" . $row['operating_margin'] . "</td>";
	echo "<td>" . $row['free_cash_flow'] . "</td>";
	echo "<td>" . $row['debt_equity_ratio'] . "</td>";
	echo "<td>" . $row['long_term_debt'] . "</td>";
	echo "<td>" . $row['networth'] . "</td>";
	echo "<td>" . $row['revenue_growth_1y'] . "</td>";
	echo "<td>" . $row['eps_growth_1y'] . "</td>";
	echo "<td>" . $row['book_value_growth_1y'] . "</td>";
	echo "<td>" . $row['revenue_growth_3y'] . "</td>";
	echo "<td>" . $row['eps_growth_3y'] . "</td>";
	echo "<td>" . $row['book_value_growth_3y'] . "</td>";
	echo "<td>" . $row['revenue_growth_5y'] . "</td>";
	echo "<td>" . $row['eps_growth_5y'] . "</td>";
	echo "<td>" . $row['book_value_growth_5y'] . "</td>";
	echo "<td>" . $row['ev_to_ebidta'] . "</td>";
	echo "<td>" . $row['price_to_sales'] . "</td>";
	echo "<td>" . $row['price_to_cash_flow'] . "</td>";
	echo "</tr>";
}

echo "</table>";
?>

<?php require_once("footer.php"); ?>

</body>
</html>
