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

$id = SQLite3::escapeString($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$bse_code = SQLite3::escapeString($_POST['bse_code']);
	$nse_code = SQLite3::escapeString($_POST['nse_code']);
	$moneycontrol_url = SQLite3::escapeString($_POST['moneycontrol_url']);
	$valueresearch_url = SQLite3::escapeString($_POST['valueresearch_url']);
	$morningstar_url = SQLite3::escapeString($_POST['morningstar_url']);
	$economictimes_url = SQLite3::escapeString($_POST['economictimes_url']);
	$ratings = SQLite3::escapeString($_POST['ratings']);

	$db->query("UPDATE company SET bse_code = '$bse_code', nse_code = '$nse_code', moneycontrol_url = '$moneycontrol_url',
		valueresearch_url = '$valueresearch_url', morningstar_url = '$morningstar_url', economictimes_url = '$economictimes_url',
		ratings = $ratings
		WHERE id = $id");
	echo "Updated !<br />";
}

$results = $db->query("SELECT * FROM company WHERE id = $id");

$data = $results->fetchArray();

echo "<h3>" . $data['name'] . "</h3><br />";

?>

<form method = "POST">

BSE CODE <input type="text" name="bse_code" value="<?php echo $data['bse_code']; ?>" /><br /><br />
NSE CODE <input type="text" name="nse_code" value="<?php echo $data['nse_code']; ?>" /><br /><br />

Moneycontrol Link <input type="text" name="moneycontrol_url" size="100" value="<?php echo $data['moneycontrol_url']; ?>" /><br /><br />
ValueRearch Link <input type="text" name="valueresearch_url" size="100" value="<?php echo $data['valueresearch_url']; ?>" /><br /><br />
Morningstar Link <input type="text" name="morningstar_url" size="100" value="<?php echo $data['morningstar_url']; ?>" /><br /><br />
EconomicsTimes Link <input type="text" name="economictimes_url" size="100" value="<?php echo $data['economictimes_url']; ?>" /><br /><br />

Rating <select name="ratings">
<?php
for ($c = -5; $c <= 5; $c++) {
	echo "<option value='" . $c . "' ";
	if ($c == $data['ratings']) echo "selected";
	echo ">" . $c . "</option>";
}
?>
</select>
<br /><br />

<input type="submit">

</form>

<?php

echo "<a href='index.php'>Back</a>";

require_once("footer.php");

?>
