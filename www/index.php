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

$results = $db->query("SELECT * FROM company LEFT JOIN stocks ON company.id = stocks.company_id WHERE date = '29-12-2015'");

echo "<table border=1>";

echo "<tr>";
echo "<td>" . 'name' . "</td>";
echo "<td>" . "</td>";
echo "<td>" . 'price' . "</td>";
echo "<td>" . 'high_52' . "</td>";
echo "<td>" . 'low_52' . "</td>";
echo "<td>" . 'pe' . "</td>";
echo "<td>" . 'pb' . "</td>";
echo "<td>" . 'enterprise_value' . "</td>";
echo "<td>" . 'market_cap' . "</td>";
echo "<td>" . 'altman_z_score' . "</td>";
echo "<td>" . 'piotroski_f_score' . "</td>";
echo "<td>" . 'modified_c_score' . "</td>";
echo "<td>" . 'current_pe' . "</td>";
echo "<td>" . 'median_pe' . "</td>";
echo "<td>" . 'current_pb' . "</td>";
echo "<td>" . 'median_pb' . "</td>";
echo "<td>" . 'earning_yield' . "</td>";
echo "<td>" . 'peg' . "</td>";
echo "<td>" . 'return_1_day' . "</td>";
echo "<td>" . 'return_1_week' . "</td>";
echo "<td>" . 'return_1_month' . "</td>";
echo "<td>" . 'return_3_months' . "</td>";
echo "<td>" . 'return_1_year' . "</td>";
echo "<td>" . 'return_10_years' . "</td>";
echo "<td>" . 'roe' . "</td>";
echo "<td>" . 'operating_margin' . "</td>";
echo "<td>" . 'free_cash_flow' . "</td>";
echo "<td>" . 'debt_equity_ratio' . "</td>";
echo "<td>" . 'long_term_debt' . "</td>";
echo "<td>" . 'networth' . "</td>";
echo "<td>" . 'revenue_growth_1y' . "</td>";
echo "<td>" . 'eps_growth_1y' . "</td>";
echo "<td>" . 'book_value_growth_1y' . "</td>";
echo "<td>" . 'revenue_growth_3y' . "</td>";
echo "<td>" . 'eps_growth_3y' . "</td>";
echo "<td>" . 'book_value_growth_3y' . "</td>";
echo "<td>" . 'revenue_growth_5y' . "</td>";
echo "<td>" . 'eps_growth_5y' . "</td>";
echo "<td>" . 'book_value_growth_5y' . "</td>";
echo "<td>" . 'ev_to_ebidta' . "</td>";
echo "<td>" . 'price_to_sales' . "</td>";
echo "<td>" . 'price_to_cash_flow' . "</td>";
echo "</tr>";

while($row = $results->fetchArray()) {
	echo "<tr>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . "<a href='editcompany.php?id=" . $row['id'] . "'>edit</a>" . "</td>";
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

require_once("footer.php");

?>
