<?php

// where this and all the other kua calculator-related files exist
$rlccc_basepath = dirname(__FILE__) . '/';

$rlccc_data_file = $rlccc_basepath . "rlccc-data.php";


require_once($rlccc_data_file);

function rlccc_draw_color_box($colorvalue)
{
	$output = '<div style="height: 20px; width: 35px; margin: 5px; float: left; border: solid 1px #707070; background-color: ' . $colorvalue . ';">&nbsp;</div>';

	return $output;
}

function rlccc_create_color_div($color, $side)
{
	// $side is either left (0) or right (1)
	// used for generating colors in 2 column format

	$output =
			// '<div style="width: 30%; margin: 0 auto;">
		'<div style="float: ' . ($side == 0 ? 'right' : 'left') . ';">

'
		.
		rlccc_draw_color_box($color['value'])
		.
		'<div style="margin: 5px; vertical-align: middle; text-align: left; float: left; height: 20px; "><strong>' . $color['name'] . '</strong></div>'
		.
		'</div><div style="clear: ' . ($side == 0 ?'right' : 'left') . ';"></div>';

	return $output;
}


function rlccc_generate_color_matrix($func, $attr)
{
	// $func is kua (0) or aspiration (1)
	// $attr is kua number (1-9) or aspiration (0-7)
	global $colors, $kua_car_colors, $aspiration_car_colors;

	$output = '';

	if ($func == 0) {
			$ms_count = count($kua_car_colors[$attr]['moneysuccess']);

			if ($ms_count == 0) {
				return "<p>Error: Invalid input.</p>";
			}

			$output .=
				// begin money/success section
				'<div style="vertical-align: middle; float: left; line-height: 20px; width: 48%; padding-bottom: 10px;">
				<p style="text-align: left; color: #7481b8;"><strong>WEALTH/SUCCESS COLORS</strong></p>
				<div style="width: 98%; margin: 0 auto;">
				';

			for ($i = 0; $i < $ms_count; ++$i) {
					$output .= rlccc_create_color_div($colors[$kua_car_colors[$attr]['moneysuccess'][$i]], 1);
				}

			$output .= '</div></div>'; // end money/success div

			$re_count = count($kua_car_colors[$attr]['relationship']);

			$output .=
				// begin relationship section
				'<div style="vertical-align: middle; float: left; line-height: 20px; width: 48%; 
				padding-bottom: 10px;">
				<p style="text-align: left; color: #7481b8;"><strong>RELATIONSHIP COLORS</strong></p>
				<div style="width: 98%; margin: 0 auto;">
				';

			for ($i = 0; $i < $re_count; ++$i) {
					$output .= rlccc_create_color_div($colors[$kua_car_colors[$attr]['relationship'][$i]], 1);
				}

			$output .= '</div></div>'
				.
				'<div style="clear: both;"></div>'
				// end money/success div
			;
		} else if ($func == 1) {

			$asp_count = count($aspiration_car_colors[$attr]);
			if ($asp_count == 0) {
				return "<p>Error: Invalid input.</p>";
			}

			$output .=
				'<div style="vertical-align: middle; float: left; line-height: 20px; width: 60%; padding-bottom: 10px;">
				<!--<p style="text-align: center; color: #7481b8;"><strong>WEALTH ASPIRATION COLORS</strong></p>-->
				<div style="width: 98%; margin: 0 auto;">
				';

			for ($i = 0; $i < $asp_count; ++$i) {
					$output .= rlccc_create_color_div($colors[$aspiration_car_colors[$attr][$i]], 1);
				}


			$output .= '</div></div>'  // end aspiration colors 
				. '<div style="clear: both;"></div>';
		}
	return $output;
}
