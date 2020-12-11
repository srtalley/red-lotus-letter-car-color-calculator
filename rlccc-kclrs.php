<?php

// where this and all the other kua calculator-related files exist
$rlccc_basepath = dirname(__FILE__) . '/';

// file name and location of the lunar new year list file
$rlccc_lnyfile = $rlccc_basepath . "lnydates.txt";

$rlccc_helper_file = $rlccc_basepath . "rlccc-helper.php";

// start and end years for the calculator...
// make sure you update the lunar new year list file if 
// you change these values!
$rlccc_start_year = 1901;
$rlccc_end_year = 2040;
$rlccc_start_year_kua_male = 9;
$rlccc_start_year_kua_female = 6;


// 1. Check params
// 2. Find kua number given birthdate.
// 3. Get car colors for that kua number.
// 4. Output for Ajax.

function rlccc_date_valid($date)
 {
     // $date should be a string in yyyy-mm-dd format

     $converted_date = new DateTime($date);

     return ($date == $converted_date->format('Y-m-d'));
 }

function check_params()
{

return
(
					isset($_GET["rlccc_year"]) &&
					isset($_GET["rlccc_month"]) &&
					isset($_GET["rlccc_day"]) &&
					isset($_GET["rlccc_gender"])

) && rlccc_date_valid( 
  $_GET["rlccc_year"] . '-' . $_GET["rlccc_month"] . '-' . $_GET["rlccc_day"]
);
}

function rlccc_calculate_kua($dt_birthdate, $gender)
{

	// $dt_birthdate should be a DateTime object

	global 
		$rlccc_start_year, 
		$rlccc_start_year_kua_male, 
		$rlccc_start_year_kua_female,
		$rlccc_lnyfile;

	$kua = false;

	$dt_lnydate = rlccc_find_lny($rlccc_lnyfile, $dt_birthdate->format("Y"));

	// get the year difference
	$yeardiff = $dt_birthdate->format("Y") - $rlccc_start_year;

	// if the month and day of the birthdate is earlier than the 
	// lunar new year month and day, then that birthday counts for the
	// prior lunar year, so correct for that.
	if ($dt_birthdate < $dt_lnydate)
	{
		$yeardiff--;
	}

	// male = 1, female = 0
	if ($gender)
	{
		$kua = (($rlccc_start_year_kua_male - ($yeardiff % 9)) % 9);
		if ($kua == 0) $kua = 9;
	}
	else
	{
		$kua = (($rlccc_start_year_kua_female + ($yeardiff % 9)) % 9);
		if ($kua == 0) $kua = 9;
	}
	return $kua;

}

function rlccc_find_lny($filename, $year)
{

	// $year should be a string in yyyy format

	$handle = fopen($filename, "r");
	if ($handle)
	{
		while (!feof($handle)) 
		{
			fscanf ($handle, "%s", $lnydate);

			if ($year == substr($lnydate, 0, 4))
			{
				fclose($handle);
				return new DateTime($lnydate);
			}
		}

	}
	fclose($handle);
	return false;
}

function generate_content()
{
	global $rlccc_helper_file;
	global $colors, $kua_car_colors, $aspiration_car_colors;


	require_once($rlccc_helper_file);

	$birthdate = new DateTime( $_GET["rlccc_year"] . '-' . $_GET["rlccc_month"] . '-' . $_GET["rlccc_day"] );
	$gender = $_GET["rlccc_gender"];
	$kua = rlccc_calculate_kua($birthdate, $gender);

$output = 
'
<script type="text/javascript" language="javascript">
function s() { alert("blahblah"); }
</script>
<form name="rlkc_fwd" method="post" action="/resources/kua-calculator/#rlkc-result">
<input type="hidden" name="rlkc_year" value="' . $_GET["rlccc_year"] . '" />
<input type="hidden" name="rlkc_month" value="' . $_GET["rlccc_month"] . '" />
<input type="hidden" name="rlkc_day" value="' . $_GET["rlccc_day"] . '" />
<input type="hidden" name="rlkc_gender" value="' . $_GET["rlccc_gender"] .'" />
</form>
<p style="text-align: left; color: #7481b8;">
Birthdate: ' . $birthdate->format("F j, Y") . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '
Gender: ' . ($gender ? "Male" : "Female") . '<br />' . '
Kua: ' . $kua . ' <a href="javascript:document.rlkc_fwd.submit();">(Find out more about kua number ' . $kua . '!)</a></p>'
; 
	
	$output .= rlccc_generate_color_matrix(0, $kua);

return $output;

}


if (check_params())
{

	echo generate_content();

}

?>
