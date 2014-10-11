<?php
function ft_return_styles() { 
	
} //return styles ends here.

function ft_calculator_accordion() {

	global $post;
	
	
	
	$content .= '<div class="ft_calculator_wrap">
	<input id="electric_rate_kwh" value="'.get_option('active_electric_rate_kwh').'" type="hidden">
	<div id="ft_tabs" class="ft_tabs">
		<ul>
			<li><a href="#tabs-0">Instructions</a></li>
			<li><a href="#tabs-1">Lights</a></li>
			<li><a href="#tabs-2">Kitchen</a></li>
			<li><a href="#tabs-3">Refrigerator</a></li>
			<li><a href="#tabs-4">Household</a></li>
			<li><a href="#tabs-6">Bathroom</a></li>
			<li><a href="#tabs-8">Medical</a></li>
			<li><a href="#tabs-10">HVAC</a></li>
			<li><a href="#tabs-11">Garage</a></li>
			<li><a href="#tabs-12">Outdoors</a></li>
			<li class="results_cl"><a href="#result">Results</a></li>
			<li class="review"><a href="#review">Review</a></li>
			<li class="terms"><a href="#terms">Terms</a></li>
		</ul>
<div id="tabs-0">
'.stripslashes(get_option('active_ft_instructions')).'
</div><!--instrunctions tab ends here.-->

<div id="tabs-1">';
$content .= '<h2>Lights</h2>
<table class="table table-hover mb30">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>
<tbody>
	<tr>
		<td>
			<span>T5 Bulbs</span>
		</td>
		<td class="col-sm-1">
			<input style="text-align: center;" placeholder="0" class="form-control" id="quantity_tv_1" onchange="appliance_calculator(\'tv\', 1)" value="'.$val = get_post_meta($post->ID, 'ecpt_quantity_tv_1', true).'" size="1">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_1" onchange="appliance_calculator(\'tv\', 1)" value="48" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_1" onchange="appliance_calculator(\'tv\', 1)" value="18" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<span id="kwh_annual_tv_1">0</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			$<span id="annual_cost_tv_1">0</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			$<span id="monthly_avg_tv_1">0</span>
		</td>
	</tr>';

$content .= '
	<tr>
		<td>
			<span>T12 Bulbs</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_2" onchange="appliance_calculator(\'tv\', 2)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_2" onchange="appliance_calculator(\'tv\', 2)" value="130" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_2" onchange="appliance_calculator(\'tv\', 2)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_2">0</span>
		</td>
	</tr>

	<tr>
		<td width="170">
			<span>400 Watt Bulb</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_3" onChange="appliance_calculator(\'tv\', 3)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_3" onChange="appliance_calculator(\'tv\', 3)" value="110" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_3" onChange="appliance_calculator(\'tv\', 3)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_3">0</span>
		</td>
	</tr>
</tboady>
<tbody>
    <tr>
		<td width="170">
			<span>Plasma 50" +</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_4" onChange="appliance_calculator(\'tv\', 4)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_4" onChange="appliance_calculator(\'tv\', 4)" value="475" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_4" onChange="appliance_calculator(\'tv\', 4)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_4">0</span>
		</td>
	</tr>

    <tr>
		<td width="170">
			<span>Plasma 40" - 49"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_5" onChange="appliance_calculator(\'tv\', 5)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_5" onChange="appliance_calculator(\'tv\', 5)" value="400" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_5" onChange="appliance_calculator(\'tv\', 5)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_5">0</span>
		</td>
	</tr>
</tbody>
<tbody>
    <tr>
		<td width="170">
			<span>LCD 50" +</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_6" onChange="appliance_calculator(\'tv\', 6)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_6" onChange="appliance_calculator(\'tv\', 6)" value="215" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_6" onChange="appliance_calculator(\'tv\', 6)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_6">0</span>
		</td>
	</tr>

    <tr>
		<td width="170">
			<span>LCD 40" - 49"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_7" onChange="appliance_calculator(\'tv\', 7)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_7" onChange="appliance_calculator(\'tv\', 7)" value="150" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_7" onChange="appliance_calculator(\'tv\', 7)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_7">0</span>
		</td>
	</tr>
</tbody>
<tbody>
    <tr>
		<td width="170">
			<span>DLP 50" +</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_8" onChange="appliance_calculator(\'tv\', 8)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_8" onChange="appliance_calculator(\'tv\', 8)" value="235" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_8" onChange="appliance_calculator(\'tv\', 8)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_8">0</span>
		</td>
	</tr>

    <tr>
		<td width="170">
			<span>DLP 40" - 49"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_9" onChange="appliance_calculator(\'tv\', 9)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_9" onChange="appliance_calculator(\'tv\', 9)" value="200" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_9" onChange="appliance_calculator(\'tv\', 9)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_9">0</span>
		</td>
	</tr>
</tbody>
<tbody>
    <tr>
		<td width="170">
			<span>Tube 30" - 36"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_10" onChange="appliance_calculator(\'tv\', 10)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_10" onChange="appliance_calculator(\'tv\', 10)" value="115" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_10" onChange="appliance_calculator(\'tv\', 10)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_10">0</span>
		</td>
	</tr>

    <tr>
		<td width="170">
			<span>Tube 25" - 27"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_11" onChange="appliance_calculator(\'tv\', 11)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_11" onChange="appliance_calculator(\'tv\', 11)" value="90" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_11" onChange="appliance_calculator(\'tv\', 11)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_11">0</span>
		</td>
	</tr>

    <tr>
		<td width="170">
			<span>Tube 19" - 20"</span>
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="quantity_tv_12" onChange="appliance_calculator(\'tv\', 12)" value="0" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="watts_tv_12" onChange="appliance_calculator(\'tv\', 12)" value="70" size="1" type="text">
		</td>
		<td class="col-sm-1" style="text-align: center;">
			<input style="text-align: center;"placeholder="0" class="form-control" id="hours_per_day_tv_12" onChange="appliance_calculator(\'tv\', 12)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_tv_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_tv_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_tv_12">0</span>
		</td>
	</tr>

</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="tv_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="tv_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="tv_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>';

$content .= '
	<div id="tabs-2">
	<h2>Kitchen</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	<tr>
		<td>
			<span>Range w/ Oven</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_1" onchange="appliance_calculator(\'kitchen\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_1" onchange="appliance_calculator(\'kitchen\', 1)" value="3000" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_1" onchange="appliance_calculator(\'kitchen\', 1)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_1">0</span>
		</td>
	</tr>

		<tr>
		<td>
			<span>Microwave</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_2" onchange="appliance_calculator(\'kitchen\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_2" onchange="appliance_calculator(\'kitchen\', 2)" value="1450" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_2" onchange="appliance_calculator(\'kitchen\', 2)" value="0.3" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Dishwasher</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_3" onchange="appliance_calculator(\'kitchen\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_3" onchange="appliance_calculator(\'kitchen\', 3)" value="1200" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_3" onchange="appliance_calculator(\'kitchen\', 3)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_3">0</span>
		</td>
	</tr>

	<tr>
		<td>
			<span>Toaster</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_4" onchange="appliance_calculator(\'kitchen\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_4" onchange="appliance_calculator(\'kitchen\', 4)" value="900" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_4" onchange="appliance_calculator(\'kitchen\', 4)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_4">0</span>
		</td>
	</tr>
    
	<tr>
		<td>
			<span>Toaster Oven</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_41" onchange="appliance_calculator(\'kitchen\', 41)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_41" onchange="appliance_calculator(\'kitchen\', 41)" value="1150" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_41" onchange="appliance_calculator(\'kitchen\', 41)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_41">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_41">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_41">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Crock Pot</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_5" onchange="appliance_calculator(\'kitchen\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_5" onchange="appliance_calculator(\'kitchen\', 5)" value="300" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_5" onchange="appliance_calculator(\'kitchen\', 5)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_5">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Deep Fat Fryer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_kitchen_6" onchange="appliance_calculator(\'kitchen\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_kitchen_6" onchange="appliance_calculator(\'kitchen\', 6)" value="1500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_kitchen_6" onchange="appliance_calculator(\'kitchen\', 6)" value="1" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_kitchen_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_kitchen_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_kitchen_6">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="kitchen_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="kitchen_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="kitchen_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>';

$content .= '
<div id="tabs-3">
<h2>Refrigerator</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>
<tbody>
	<tr>
		<td>
			<span>Personal 1.7 cu. ft.</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_1" onchange="appliance_calculator(\'refrigerator\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_1" onchange="appliance_calculator(\'refrigerator\', 1)" value="126" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_1" onchange="appliance_calculator(\'refrigerator\', 1)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_1">0</span>
		</td>
	</tr>
</tbody>
<tbody class="sub_television">
    <tr>
		<td>
			<span>Before 1993 14 cu. ft.</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_2" onchange="appliance_calculator(\'refrigerator\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_2" onchange="appliance_calculator(\'refrigerator\', 2)" value="226" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_2" onchange="appliance_calculator(\'refrigerator\', 2)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 14 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_3" onchange="appliance_calculator(\'refrigerator\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_3" onchange="appliance_calculator(\'refrigerator\', 3)" value="383" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_3" onchange="appliance_calculator(\'refrigerator\', 3)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_3">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 17 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_4" onchange="appliance_calculator(\'refrigerator\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_4" onchange="appliance_calculator(\'refrigerator\', 4)" value="463" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_4" onchange="appliance_calculator(\'refrigerator\', 4)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_4">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 19 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_5" onchange="appliance_calculator(\'refrigerator\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_5" onchange="appliance_calculator(\'refrigerator\', 5)" value="509" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_5" onchange="appliance_calculator(\'refrigerator\', 5)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_5">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 21 cu. ft. - SS</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_6" onchange="appliance_calculator(\'refrigerator\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_6" onchange="appliance_calculator(\'refrigerator\', 6)" value="783" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_6" onchange="appliance_calculator(\'refrigerator\', 6)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_6">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 24 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_7" onchange="appliance_calculator(\'refrigerator\', 7)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_7" onchange="appliance_calculator(\'refrigerator\', 7)" value="653" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_7" onchange="appliance_calculator(\'refrigerator\', 7)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_7">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Before 1993 25 cu. ft. - SS</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_8" onchange="appliance_calculator(\'refrigerator\', 8)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_8" onchange="appliance_calculator(\'refrigerator\', 8)" value="841" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_8" onchange="appliance_calculator(\'refrigerator\', 8)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_8">0</span>
		</td>
	</tr>
</tbody>
<tbody>
    <tr>
		<td>
			<span>After 1993 14 cu. ft.</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_9" onchange="appliance_calculator(\'refrigerator\', 9)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_9" onchange="appliance_calculator(\'refrigerator\', 9)" value="147" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_9" onchange="appliance_calculator(\'refrigerator\', 9)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_9">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 14 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_10" onchange="appliance_calculator(\'refrigerator\', 10)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_10" onchange="appliance_calculator(\'refrigerator\', 10)" value="236" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_10" onchange="appliance_calculator(\'refrigerator\', 10)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_10">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 17 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_11" onchange="appliance_calculator(\'refrigerator\', 11)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_11" onchange="appliance_calculator(\'refrigerator\', 11)" value="301" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_11" onchange="appliance_calculator(\'refrigerator\', 11)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_11">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 19 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_12" onchange="appliance_calculator(\'refrigerator\', 12)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_12" onchange="appliance_calculator(\'refrigerator\', 12)" value="331" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_12" onchange="appliance_calculator(\'refrigerator\', 12)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_12">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 21 cu. ft. - SS</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_13" onchange="appliance_calculator(\'refrigerator\', 13)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_13" onchange="appliance_calculator(\'refrigerator\', 13)" value="509" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_13" onchange="appliance_calculator(\'refrigerator\', 13)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_13">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_13">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_13">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 24 cu. ft. - FF</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_14" onchange="appliance_calculator(\'refrigerator\', 14)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_14" onchange="appliance_calculator(\'refrigerator\', 14)" value="424" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_14" onchange="appliance_calculator(\'refrigerator\', 14)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_14">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_14">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_14">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>After 1993 25 cu. ft. - SS</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_refrigerator_15" onchange="appliance_calculator(\'refrigerator\', 15)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_refrigerator_15" onchange="appliance_calculator(\'refrigerator\', 15)" value="547" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_refrigerator_15" onchange="appliance_calculator(\'refrigerator\', 15)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_refrigerator_15">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_refrigerator_15">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_refrigerator_15">0</span>
		</td>
	</tr>


	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="refrigerator_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="refrigerator_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="refrigerator_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-4">
<h2>Household</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	<tr>
		<td>
			<span>Clothes Dryer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_1" onchange="appliance_calculator(\'utilityroom\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_1" onchange="appliance_calculator(\'utilityroom\', 1)" value="5000" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_1" onchange="appliance_calculator(\'utilityroom\', 1)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_1">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Clothes Washer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_2" onchange="appliance_calculator(\'utilityroom\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_2" onchange="appliance_calculator(\'utilityroom\', 2)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_2" onchange="appliance_calculator(\'utilityroom\', 2)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Electric Water Heater</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_3" onchange="appliance_calculator(\'utilityroom\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_3" onchange="appliance_calculator(\'utilityroom\', 3)" value="4500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_3" onchange="appliance_calculator(\'utilityroom\', 3)" value="2.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_3">0</span>
		</td>
	</tr>

   <tr>
		<td>
			<span>Sump Pump</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_7" onchange="appliance_calculator(\'utilityroom\', 7)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_7" onchange="appliance_calculator(\'utilityroom\', 7)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_7" onchange="appliance_calculator(\'utilityroom\', 7)" value="0.67" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_7">0</span>
		</td>
	</tr>
	
    <tr>
		<td>
			<span>Vaccum - Centeral</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_4" onchange="appliance_calculator(\'utilityroom\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_4" onchange="appliance_calculator(\'utilityroom\', 4)" value="800" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_4" onchange="appliance_calculator(\'utilityroom\', 4)" value="12" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_4">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Vacuum - Regular</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_5" onchange="appliance_calculator(\'utilityroom\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_5" onchange="appliance_calculator(\'utilityroom\', 5)" value="1440" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_5" onchange="appliance_calculator(\'utilityroom\', 5)" value="0.15" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_5">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Stereo</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_8" onchange="appliance_calculator(\'utilityroom\', 8)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_8" onchange="appliance_calculator(\'utilityroom\', 8)" value="50" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_8" onchange="appliance_calculator(\'utilityroom\', 8)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_8">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>VCR/DVD</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_9" onchange="appliance_calculator(\'utilityroom\', 9)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_9" onchange="appliance_calculator(\'utilityroom\', 9)" value="30" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_9" onchange="appliance_calculator(\'utilityroom\', 9)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_9">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Clock Radio</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_10" onchange="appliance_calculator(\'utilityroom\', 10)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_10" onchange="appliance_calculator(\'utilityroom\', 10)" value="10" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_10" onchange="appliance_calculator(\'utilityroom\', 10)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_10">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Computer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_11" onchange="appliance_calculator(\'utilityroom\', 11)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_11" onchange="appliance_calculator(\'utilityroom\', 11)" value="300" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_11" onchange="appliance_calculator(\'utilityroom\', 11)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_11">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Laptop</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_12" onchange="appliance_calculator(\'utilityroom\', 12)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_12" onchange="appliance_calculator(\'utilityroom\', 12)" value="65" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_12" onchange="appliance_calculator(\'utilityroom\', 12)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_12">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_12">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Electric Blanked</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_13" onchange="appliance_calculator(\'utilityroom\', 13)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_13" onchange="appliance_calculator(\'utilityroom\', 13)" value="175" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_13" onchange="appliance_calculator(\'utilityroom\', 13)" value="4" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_13">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_13">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_13">0</span>
		</td>
	</tr>
	
    <tr>
		<td>
			<span>Clothes Iron</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_utilityroom_6" onchange="appliance_calculator(\'utilityroom\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_utilityroom_6" onchange="appliance_calculator(\'utilityroom\', 6)" value="1090" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_utilityroom_6" onchange="appliance_calculator(\'utilityroom\', 6)" value="0.15" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_utilityroom_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_utilityroom_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_utilityroom_6">0</span>
		</td>
	</tr>

    </tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="utilityroom_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="utilityroom_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="utilityroom_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-6">
<h2>Bathroom</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	<tr>
		<td>
			<span>Hair Dryer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_bathroom_1" onchange="appliance_calculator(\'bathroom\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_bathroom_1" onchange="appliance_calculator(\'bathroom\', 1)" value="1200" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_bathroom_1" onchange="appliance_calculator(\'bathroom\', 1)" value="0.25" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_bathroom_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_bathroom_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_bathroom_1">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Hair Clippers</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_bathroom_4" onchange="appliance_calculator(\'bathroom\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_bathroom_4" onchange="appliance_calculator(\'bathroom\', 4)" value="9" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_bathroom_4" onchange="appliance_calculator(\'bathroom\', 4)" value="0.25" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_bathroom_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_bathroom_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_bathroom_4">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Whirlpool Tub</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_bathroom_2" onchange="appliance_calculator(\'bathroom\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_bathroom_2" onchange="appliance_calculator(\'bathroom\', 2)" value="1800" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_bathroom_2" onchange="appliance_calculator(\'bathroom\', 2)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_bathroom_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_bathroom_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_bathroom_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Curling Iron</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_bathroom_3" onchange="appliance_calculator(\'bathroom\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_bathroom_3" onchange="appliance_calculator(\'bathroom\', 3)" value="50" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_bathroom_3" onchange="appliance_calculator(\'bathroom\', 3)" value="0.16" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_bathroom_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_bathroom_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_bathroom_3">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="bathroom_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="bathroom_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="bathroom_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-8">
<h2>Medical</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	<tr>
		<td>
			<span>Nebulizer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_1" onchange="appliance_calculator(\'medical\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_1" onchange="appliance_calculator(\'medical\', 1)" value="165" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_1" onchange="appliance_calculator(\'medical\', 1)" value="1.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_1">0</span>
		</td>
	</tr>

	<tr>
		<td>
			<span>Oxygen Concentrator</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_2" onchange="appliance_calculator(\'medical\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_2" onchange="appliance_calculator(\'medical\', 2)" value="460" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_2" onchange="appliance_calculator(\'medical\', 2)" value="24" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>CPAP-Sleep Apnea Machine</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_3" onchange="appliance_calculator(\'medical\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_3" onchange="appliance_calculator(\'medical\', 3)" value="200" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_3" onchange="appliance_calculator(\'medical\', 3)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_3">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Dehumidifier</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_4" onchange="appliance_calculator(\'medical\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_4" onchange="appliance_calculator(\'medical\', 4)" value="750" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_4" onchange="appliance_calculator(\'medical\', 4)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_4">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Humidifier - Cool</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_5" onchange="appliance_calculator(\'medical\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_5" onchange="appliance_calculator(\'medical\', 5)" value="200" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_5" onchange="appliance_calculator(\'medical\', 5)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_5">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Humidifier - Warm</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_medical_6" onchange="appliance_calculator(\'medical\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_medical_6" onchange="appliance_calculator(\'medical\', 6)" value="384" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_medical_6" onchange="appliance_calculator(\'medical\', 6)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_medical_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_medical_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_medical_6">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="medical_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="medical_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="medical_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-10">
	<h2>HVAC</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>
<tbody>
	<tr>
		<td>
			<span>Space Heater</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_1" onchange="appliance_calculator(\'heatcool\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_1" onchange="appliance_calculator(\'heatcool\', 1)" value="1500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_1" onchange="appliance_calculator(\'heatcool\', 1)" value="3" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_1">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Hot Air 1/2 HP Motor</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_5" onchange="appliance_calculator(\'heatcool\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_5" onchange="appliance_calculator(\'heatcool\', 5)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_5" onchange="appliance_calculator(\'heatcool\', 5)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_5">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Hot Air 3/4 HP Motor</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_6" onchange="appliance_calculator(\'heatcool\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_6" onchange="appliance_calculator(\'heatcool\', 6)" value="750" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_6" onchange="appliance_calculator(\'heatcool\', 6)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_6">0</span>
		</td>
	</tr>
	
</tbody>
<tbody>	

    <tr>
		<td>
			<span>Window Fan</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_2" onchange="appliance_calculator(\'heatcool\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_2" onchange="appliance_calculator(\'heatcool\', 2)" value="150" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_2" onchange="appliance_calculator(\'heatcool\', 2)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_2">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Ceiling Fan</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_3" onchange="appliance_calculator(\'heatcool\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_3" onchange="appliance_calculator(\'heatcool\', 3)" value="50" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_3" onchange="appliance_calculator(\'heatcool\', 3)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_3">0</span>
		</td>
	</tr>

    <tr>
		<td>
			<span>Ceiling Fan w/ 3 - 60 W Bulbs</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_4" onchange="appliance_calculator(\'heatcool\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_4" onchange="appliance_calculator(\'heatcool\', 4)" value="230" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_4" onchange="appliance_calculator(\'heatcool\', 4)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_4">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Attic Fan</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_7" onchange="appliance_calculator(\'heatcool\', 7)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_7" onchange="appliance_calculator(\'heatcool\', 7)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_7" onchange="appliance_calculator(\'heatcool\', 7)" value="10" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_7">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Central Air</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_8" onchange="appliance_calculator(\'heatcool\', 8)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_8" onchange="appliance_calculator(\'heatcool\', 8)" value="2500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_8" onchange="appliance_calculator(\'heatcool\', 8)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_8">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_8">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>A/C - 10,000 BTU</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_9" onchange="appliance_calculator(\'heatcool\', 9)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_9" onchange="appliance_calculator(\'heatcool\', 9)" value="1000" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_9" onchange="appliance_calculator(\'heatcool\', 9)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_9">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_9">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>A/C - 5,000 BTU</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_10" onchange="appliance_calculator(\'heatcool\', 10)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_10" onchange="appliance_calculator(\'heatcool\', 10)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_10" onchange="appliance_calculator(\'heatcool\', 10)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_10">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_10">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>A/C - 7,000 BTU</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_heatcool_11" onchange="appliance_calculator(\'heatcool\', 11)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_heatcool_11" onchange="appliance_calculator(\'heatcool\', 11)" value="750" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_heatcool_11" onchange="appliance_calculator(\'heatcool\', 11)" value="8" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_heatcool_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_heatcool_11">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_heatcool_11">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="heatcool_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="heatcool_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="heatcool_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-11">
	<h2>Garage</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	<tr>
		<td>
			<span>Bench Grinder</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_1" onchange="appliance_calculator(\'garage\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_1" onchange="appliance_calculator(\'garage\', 1)" value="600" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_1" onchange="appliance_calculator(\'garage\', 1)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_1">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Circular Saw</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_3" onchange="appliance_calculator(\'garage\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_3" onchange="appliance_calculator(\'garage\', 3)" value="1000" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_3" onchange="appliance_calculator(\'garage\', 3)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_3">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Drill</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_4" onchange="appliance_calculator(\'garage\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_4" onchange="appliance_calculator(\'garage\', 4)" value="400" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_4" onchange="appliance_calculator(\'garage\', 4)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_4">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Saber Saw</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_5" onchange="appliance_calculator(\'garage\', 5)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_5" onchange="appliance_calculator(\'garage\', 5)" value="400" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_5" onchange="appliance_calculator(\'garage\', 5)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_5">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_5">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Belt Sander</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_7" onchange="appliance_calculator(\'garage\', 7)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_7" onchange="appliance_calculator(\'garage\', 7)" value="300" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_7" onchange="appliance_calculator(\'garage\', 7)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_7">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_7">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Soldering Gun</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_6" onchange="appliance_calculator(\'garage\', 6)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_6" onchange="appliance_calculator(\'garage\', 6)" value="600" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_6" onchange="appliance_calculator(\'garage\', 6)" value="0.5" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_6">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_6">0</span>
		</td>
	</tr>

	<tr>
		<td>
			<span>Engine Block Heater</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_garage_2" onfocus="this.select();" onmouseup="return false;" onchange="appliance_calculator(\'garage\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_garage_2" onchange="appliance_calculator(\'garage\', 2)" value="300" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_garage_2" onchange="appliance_calculator(\'garage\', 2)" value="7" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_garage_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_garage_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_garage_2">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="garage_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="garage_total_annual_cost">0.00</span>$ |
	Monthly Avg: $<span id="garage_total_monthly_avg">0.00</span>$</h3>
</div>
<div class="clearIt"></div>
</div>

<div id="tabs-12">
	<h2>Outdoors</h2>
<table style="width: 100%;" cellpadding="0" border="0">
<tbody>
	<tr>
		<th rowspan="1" width="25%"></th>
		<th style="text-align:center;" colspan="3">
			<u>Inputs</u>
		</th>
		<th colspan="2">
			<u>Annual</u>
		</th>
		<th style="text-align:center;" colspan="1">
			<u>Monthly</u>
		</th>
	</tr>
	<tr>
		<th style="text-align:left;">Type</th>
		<th>Quantity</th>
		<th>Wattage</th>
		<th>Hours/Day</th>
		<th>kWh</th>
		<th style="text-align:center;">Cost</th>
		<th style="text-align:center;">Avg</th>
	</tr>
</tbody>

<tbody>
	
	<tr>
		<td>
			<span>Hedge Trimmer</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_outdoors_3" onchange="appliance_calculator(\'outdoors\', 3)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_outdoors_3" onchange="appliance_calculator(\'outdoors\', 3)" value="450" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_outdoors_3" onchange="appliance_calculator(\'outdoors\', 3)" value="0.067" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_outdoors_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_outdoors_3">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_outdoors_3">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Weed Eater</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_outdoors_4" onchange="appliance_calculator(\'outdoors\', 4)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_outdoors_4" onchange="appliance_calculator(\'outdoors\', 4)" value="500" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_outdoors_4" onchange="appliance_calculator(\'outdoors\', 4)" value="0.067" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_outdoors_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_outdoors_4">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_outdoors_4">0</span>
		</td>
	</tr>
	
	<tr>
		<td>
			<span>Water Pump</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_outdoors_1" onchange="appliance_calculator(\'outdoors\', 1)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_outdoors_1" onchange="appliance_calculator(\'outdoors\', 1)" value="900" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_outdoors_1" onchange="appliance_calculator(\'outdoors\', 1)" value="1.43" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_outdoors_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_outdoors_1">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_outdoors_1">0</span>
		</td>
	</tr>

	<tr>
		<td>
			<span>Septic Pump</span>
		</td>
		<td style="text-align: center;">
			<input id="quantity_outdoors_2" onchange="appliance_calculator(\'outdoors\', 2)" value="0" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="watts_outdoors_2" onchange="appliance_calculator(\'outdoors\', 2)" value="1000" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<input id="hours_per_day_outdoors_2" onchange="appliance_calculator(\'outdoors\', 2)" value="1.33" size="1" type="text">
		</td>
		<td style="text-align: center;">
			<span id="kwh_annual_outdoors_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="annual_cost_outdoors_2">0</span>
		</td>
		<td style="text-align: center;">
			$<span id="monthly_avg_outdoors_2">0</span>
		</td>
	</tr>

	</tbody></table>
<!--total table here-->
<div class="ft-small-result">
	<h3 align="right">Annual kWh: <span id="outdoors_total_annual_kwh">0.00</span> |
	Annual Cost: $<span id="outdoors_total_annual_cost">0.00</span> |
	Monthly Avg: $<span id="outdoors_total_monthly_avg">0.00</span></h3>
</div>
<div class="clearIt"></div>
</div>

<div id="result">
		'.stripslashes(get_option('active_ft_result_top')).'
		<div class="ft_grand_total">
			<table cellspacing="0" style="margin-top:10px;" width="100%" border="0">
				<tr>
					<th>Section</th>
					<th>Annual kWh</th>
					<th>Annual Cost</th>
					<th>Monthly Avg</th>
				</tr>
				<tr>
    <td>Lights</td>
    <td><span id="tv_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="tv_2_total_annual_cost">0.00</span></td>
    <td>$<span id="tv_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Kitchen</td>
    <td><span id="kitchen_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="kitchen_2_total_annual_cost">0.00</span></td>
    <td>$<span id="kitchen_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Refrigerator</td>
    <td><span id="refrigerator_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="refrigerator_2_total_annual_cost">0.00</span></td>
    <td>$<span id="refrigerator_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Utility Room</td>
    <td><span id="utilityroom_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="utilityroom_2_total_annual_cost">0.00</span></td>
    <td>$<span id="utilityroom_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Bathroom</td>
    <td><span id="bathroom_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="bathroom_2_total_annual_cost">0.00</span></td>
    <td>$<span id="bathroom_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Medical</td>
    <td><span id="medical_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="medical_2_total_annual_cost">0.00</span></td>
    <td>$<span id="medical_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>HVAC</td>
    <td><span id="heatcool_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="heatcool_2_total_annual_cost">0.00</span></td>
    <td>$<span id="heatcool_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Garage</td>
    <td><span id="garage_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="garage_2_total_annual_cost">0.00</span></td>
    <td>$<span id="garage_2_total_monthly_avg">0.00</span></td>
</tr>

<tr>
    <td>Outdoors</td>
    <td><span id="outdoors_2_total_annual_kwh">0.00</span></td>
    <td>$<span id="outdoors_2_total_annual_cost">0.00</span></td>
    <td>$<span id="outdoors_2_total_monthly_avg">0.00</span></td>
</tr>
			</table>
			<div class="clearIt"></div>
			<h2 style="margin-top:20px !important;text-align:left;">Grand Total</h2>
			<table cellspacing="0" style="margin-top:25px;" width="100%" border="0">
				<tr>
					<th>&nbsp;</th>
					<th>Annual kWh</th>
					<th>Annual Cost</th>
					<th>Monthly Avg</th>
				</tr>
				<tr>
					<td><strong>Totals</strong></td>
					<td><span id="grand_total_annual_kwh">0.00</span></td>
					<td>$<span id="grand_total_annual_cost">0.00</span></td>
					<td>$<span id="grand_total_monthly_avg">0.00</span></td>
				</tr>
			</table>
			</div><!--grand total-->
			<div class="clearIt"></div>
	</div>

	<div id="review">
		'.stripslashes(get_option('active_ft_review')).'
	<div class="clearIt"></div>
	</div>

	<div id="terms">
		'.stripslashes(get_option('active_ft_terms')).'
	<div class="clearIt"></div>
	</div>

</div><!--ft-tabs-->';

$content .=	'</div>';
	echo $content;
} //Function with acordion ends here.

if(get_option('active_ft_user_accordion') == 'yes') { 
	add_shortcode('ft_calculator', 'ft_calculator_accordion');
} else { 
	add_shortcode('ft_calculator', 'ft_calculator_accordion');
}