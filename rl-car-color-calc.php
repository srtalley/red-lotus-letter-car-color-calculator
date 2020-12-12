<?php
/*
Plugin Name: Red Lotus Car Color Calculator
Plugin URI: http://redlotusletter.com
Description: The Car Color Calculator
Author: Red Lotus Letter
Version: 1.1.3
Author URI: http://redlotusletter.com
*/


/***************************************
 * Constants for the car color calculator
 ***************************************/

// insertion pattern = "{ RL-Car-Color-Calc }"
$rlccc_pattern = '/\{\s*[Rr][Ll]\-[Cc][Aa][Rr]\-[Cc][Oo][Ll][Oo][Rr]\-[Cc][Aa][Ll][Cc]\s*\}/';

// where this and all the other kua calculator-related files exist
$rlccc_basepath = dirname(__FILE__) . '/';

// base URL for this plugin, used for image loading and other
// file references.
// NOTE: the directory name of this plugin should be the same
// as the filename of this script.
$rlccc_baseurl = "//" . $_SERVER['SERVER_NAME'] . "/wp-content/plugins/" . basename(__FILE__, ".php") . '/';


// start and end years for the calculator...
// make sure you update the lunar new year list file if 
// you change these values!
$rlccc_start_year = 1901;
$rlccc_end_year = 2040;
$rlccc_start_year_kua_male = 9;
$rlccc_start_year_kua_female = 6;

$rlccc_form = $rlccc_basepath . "rlccc-form.php";
$rlccc_data_file = $rlccc_basepath . "rlccc-data.php";

require_once($rlccc_data_file);

/***************************************
 * Procedures for the car color calculator
 ***************************************/
function rlccc_detect_keyword($content)
{

	global $rlccc_pattern;

	if (preg_match($rlccc_pattern, $content))
	{
		return true;
	}
	
	return false;
}

function generate_form()
{
	global $rlccc_form; 

	$form_contents = file_get_contents($rlccc_form);
	// capture eval output
	ob_start();
	eval(' ?> ' . $form_contents . ' <? ');
	$the_form = ob_get_contents();
	ob_end_clean();


return $the_form;

}

function rlccc_generate_content()
{

	return generate_form();
}

// This is the main entry function for the Red Lotus Car Color Calculator
function rlccc_main($content)
{
	
	// If the keyword doesn't exist, don't do anything
	// and get out immediately.
	if (!rlccc_detect_keyword($content))
	{
		return $content;
	}

	global $rlccc_pattern, $rlccc_lnyfile;

	// build kua content
	

		$content = preg_replace(
			$rlccc_pattern, 
			rlccc_generate_content(),
			$content);

	return $content;

}



// allow wordpress to hook into here
if (function_exists('add_filter'))
{
	add_filter ('the_content', 'rlccc_main');
}
else
{
	echo ('Direct access is not allowed.');
}

?>
