<?php

// where this and all the other kua calculator-related files exist
$rlccc_basepath = dirname(__FILE__) . '/';

$rlccc_data_file = $rlccc_basepath . "rlccc-data.php";
$rlccc_helper_file = $rlccc_basepath . "rlccc-helper.php";

require_once($rlccc_helper_file);
require_once($rlccc_data_file);

// 1. Check params
// 2. Get car colors for aspiration.
// 3. Output for ajax.


function check_params()
{

	return (isset($_GET["rlccc_aspr"]));
}



function generate_content()
{
	//global $rlccc_helper_file;
	global $aspirationstring;
	global $colors, $kua_car_colors, $aspiration_car_colors;


	$aspiration = $_GET["rlccc_aspr"];

	$output = '<p style="text-align: left; color: #7481b8; text-transform: uppercase;"><strong>' . $aspirationstring[$aspiration] . ' Colors</strong></p>';

	$output .=  rlccc_generate_color_matrix(1, $aspiration);

	return $output;
}

if (check_params()) {
		echo generate_content();
	}
