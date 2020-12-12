<?php
global $rlccc_baseurl;
global $aspirationstring;
?>

<script type="text/javascript" language="javascript">
	function getCheckedValue(e){if(!e)return"";var c=e.length;if(null==c)return e.checked?e.value:"";for(var t=0;t<c;t++)if(e[t].checked)return e[t].value;return""}function getKuaColors(){var e;(e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP")).onreadystatechange=function(){4==e.readyState&&200==e.status&&(document.getElementById("rl-car-clr-calc-kua-results").innerHTML=e.responseText)};var c=getCheckedValue(document.getElementsByName("rlccc_gender")),t=document.getElementById("rlccc_year").value,r=document.getElementById("rlccc_day").value,n=document.getElementById("rlccc_month").value;e.open("GET","<?php echo $rlccc_baseurl ?>rlccc-kclrs.php?rlccc_gender="+c+"&rlccc_year="+t+"&rlccc_month="+n+"&rlccc_day="+r,!0),e.send()}function getAsprColors(){var e;(e=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP")).onreadystatechange=function(){4==e.readyState&&200==e.status&&(document.getElementById("rl-car-clr-calc-aspr-results").innerHTML=e.responseText)};var c=document.getElementById("rlccc_aspr").value;e.open("GET","<?php echo $rlccc_baseurl ?>rlccc-aclrs.php?rlccc_aspr="+c,!0),e.send()}
</script>

<?php
global $rlccc_start_year, $rlccc_end_year; 

	$default_date = "";
	$dt_default_date = new DateTime($default_date);

	$default_year = $dt_default_date->format("Y");
	$default_month = $dt_default_date->format("m");
	$default_day = $dt_default_date->format("d");

	$monthstring = array (
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December"
	);
?>
<style type="text/css">
<!--


#rl-car-clr-calc-main
{
	border: 2px solid #c0c0c0;
}

#rl-car-clr-calc-form
{
	padding: 5px;
}
#rl-car-clr-calc-main, #rl-car-clr-calc-form
{
	background-color: #d8d8d8;
}

#rl-car-clr-calc-title
{
 background-color: #7e7f7f;
 margin: 0;
 padding-bottom: 10px;
	font-family: Tahoma, Arial, sans-serif;
	font-size: 16pt;
	font-weight: bold;
color: #ffffff;
}

#rl-car-clr-calc-title p
{
text-align: left;
padding-left: 5px;
margin: 0;
}

#rl-car-clr-calc-kua-clr-header p, #rl-car-clr-calc-aspr-clr-header p 
{
 margin: 0;
 padding-bottom: 10px;
	font-family: Tahoma, Arial, sans-serif;
	font-size: 13pt;
	font-weight: bold;
text-align: left;

}

#rl-car-clr-calc-asp-desc p
{
	text-align: left;

}

#rl-car-clr-calc-kua-submit
{
 text-align: left;

}

#rl-car-clr-calc-kua-submit a,
#rl-car-clr-calc-gender a,
#rl-car-clr-calc-aspr a
{

	border: 2px solid #595959;
	text-decoration: none;
	background-color: #595959;
	color: white;
	font-family: Arial;
	font-size: 10pt;
	font-weight: bold;
	padding: 5px;
	margin: 2px;
}




-->
</style>



	<center>


<div id="rl-car-clr-calc-main">
			<div id="rl-car-clr-calc-title">
				<p>Feng Shui Car Color Calculator</p>
			</div>
	
		<div id="rl-car-clr-calc-form" style="width: 96%;" >


		
<div id="rl-car-clr-calc-kua-clr-header">
	<p>Calculate My Personal Lucky Colors</p>	
</div>
<br />
<div id="rl-car-clr-calc-bday-set"><div id="rl-car-clr-calc-bday" style="text-align: left;">

		Birthday: &nbsp;
		
		<select name="rlccc_month" id="rlccc_month" style="width: 9em;">
<?php
	for ($i = 1; $i < 13; $i++)
	{	
		echo ' 
		<option value="' . sprintf("%02d",$i) . '"' . 
				(($i == $default_month) ? ' selected="1">' : '>') .
				$monthstring[$i] . '</option>'
		;
	}
?>
		</select>
		
		<select name="rlccc_day" id="rlccc_day" style="width: 5em;">
<?php
	for ($i = 1; $i < 32; $i++)
	{
		echo '<option value="' . sprintf("%02d",$i) . '"' .
				(($i == $default_day) ? ' selected="1">' : '>') . 
				$i . '</option>'
		;
	}
?>

		</select>
		
		<select name="rlccc_year" id="rlccc_year" style="width: 6em;">
<?php	
for ($i = $rlccc_start_year; $i < $rlccc_end_year + 1; $i++)
	{
		echo 
			'<option value="' . $i . '"' .
				(($i == $default_year) ? ' selected="1">' : '>') . 
				$i . '</option>'
		;
	}
?>
		</select>
		</div>
		<div id="rl-car-clr-calc-gender" style="text-align: left; width: 100%; padding-top: 10px;">
<div style="float: left; width: auto;">
<div style="float: left; padding-right: 5px;">	
<p>	
	Gender: 
</p>
</div>

<div style="float: left; padding: 0 10px;">
<p>
		<input type="radio" name="rlccc_gender" value="1" checked="checked" id="rlccc_gender_male" style="width: auto; margin-right: 5px;" /><label for="rlccc_gender_male">Male</label>
</p>
</div>
<div style="float: left; padding: 0 10px;">
<p>
		<input type="radio" name="rlccc_gender" value="0" id="rlccc_gender_female" style="width: auto; margin-right: 5px;" /><label for="rlccc_gender_female">Female</label>
</p>
</div>
</div>
<div style="float: left; display: block; width: 100%; margin-bottom: 10px;">
<a href="#" onclick="getKuaColors(); return false;">SUBMIT</a> 
</div>
</div>
<br /><br />
<div id="rl-car-clr-calc-kua-submit">
	</div>


</div>

<!-- kua color results go in this div -->
<div id="rl-car-clr-calc-kua-results" style="margin-top: 10px; padding: 5px;">
</div>
<div style="clear: left;"></div>
		<div id="rl-car-clr-calc-asp-desc" style="padding-top: 20px;">
			<p>
				<span style="font-weight: bold;">Don't like these colors? You can select a car color to match your personal aspirations.</span>
			</p>
		</div>

		<div id="rl-car-clr-calc-aspr" style="text-align: left;">
<div id="rl-car-clr-calc-aspr-clr-header">
	<p>Pick my color based on</p>	
</div>
		
		<select name="rlccc_aspr" id="rlccc_aspr" style="width: 13em;">
<?php
	for ($i = 0; $i < count($aspirationstring); ++$i)
	{	
		echo '<option value="' . $i . '"' . ($i == 0 ? ' selected="1">' : '>') . $aspirationstring[$i] . '</option>';
	}
?>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="getAsprColors(); return false;">SUBMIT</a> 
		</div>
		
<!-- aspiration color results go in this div -->
<div id="rl-car-clr-calc-aspr-results" style="margin-top: 10px; padding: 5px;">
</div>


		</div>
</div>
		</center>

