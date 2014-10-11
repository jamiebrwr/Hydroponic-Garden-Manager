jQuery(function() {  
	var pull  = jQuery('#res_btn');  
		menu  = jQuery('.shop_cat_wrap ul');  
		menuHeight = menu.height();  
  
	jQuery(pull).on('click', function(e) {  
		e.preventDefault();  
		menu.slideToggle();  
	});  
}); 

jQuery(function() {
	jQuery("#ft_tabs").tabs();
	jQuery("#ft_total").tabs();
});
jQuery(document).ready(function () {
    jQuery('table').accordion({header: '.television'});
});
function appliance_calculator(appliance, value) {
	quantity = document.getElementById('quantity_'+appliance+'_'+value).value;
	wattage = document.getElementById('watts_'+appliance+'_'+value).value;
	daily_hour = document.getElementById('hours_per_day_'+appliance+'_'+value).value;
	kwh_rate = document.getElementById('electric_rate_kwh').value;
	 
	annual_kwh = (quantity*wattage*daily_hour*365)/1000;
	annual_cost = annual_kwh*kwh_rate;
	monthly_average = annual_cost/12;
	 
	document.getElementById('kwh_annual_'+appliance+'_'+value).innerHTML = annual_kwh.toFixed(0);
	document.getElementById('annual_cost_'+appliance+'_'+value).innerHTML = annual_cost.toFixed(2);;
	document.getElementById('monthly_avg_'+appliance+'_'+value).innerHTML = monthly_average.toFixed(2);
	
	if(document.getElementById(appliance+'_'+value) != null) {
		document.getElementById(appliance+'_'+value).innerHTML = (daily_hour*365).toFixed(0);
	}
	
	if(appliance == 'tv') { 
		update_television_total();
	} else if(appliance == 'kitchen') { 
		update_kitchen_total();
	} else if(appliance == 'outdoors') { 
		update_outdoors_total();
	} else if(appliance == 'garage') { 
		update_garage_total();
	} else if(appliance == 'heatcool') { 
		update_heatcool_total();
	} else if(appliance == 'office') { 
		update_office_total();
	} else if(appliance == 'medical') { 
		update_medical_total();
	} else if(appliance == 'bedroom') { 
		update_bedroom_total();
	} else if(appliance == 'bathroom') { 
		update_bathroom_total();
	} else if(appliance == 'livingroom') { 
		update_livingroom_total();
	} else if(appliance == 'utilityroom') { 
		update_utilityroom_total();
	} else if(appliance == 'refrigerator') { 
		update_refrigerator_total();
	}
	ft_calc_grand_total();
}

function ft_calc_grand_total() { 
	kwh_1 = parseFloat(document.getElementById('refrigerator_total_annual_kwh').innerHTML);
	cost_1 = parseFloat(document.getElementById('refrigerator_total_annual_cost').innerHTML);
	avg_1 = parseFloat(document.getElementById('refrigerator_total_monthly_avg').innerHTML);
	
	kwh_2 = parseFloat(document.getElementById('utilityroom_total_annual_kwh').innerHTML);
	cost_2 = parseFloat(document.getElementById('utilityroom_total_annual_cost').innerHTML);
	avg_2 = parseFloat(document.getElementById('utilityroom_total_monthly_avg').innerHTML);
	
	kwh_4 = parseFloat(document.getElementById('bathroom_total_annual_kwh').innerHTML);
	cost_4 = parseFloat(document.getElementById('bathroom_total_annual_cost').innerHTML);
	avg_4 = parseFloat(document.getElementById('bathroom_total_monthly_avg').innerHTML);
	
	kwh_6 = parseFloat(document.getElementById('medical_total_annual_kwh').innerHTML);
	cost_6 = parseFloat(document.getElementById('medical_total_annual_cost').innerHTML);
	avg_6 = parseFloat(document.getElementById('medical_total_monthly_avg').innerHTML);
	
	kwh_8 = parseFloat(document.getElementById('heatcool_total_annual_kwh').innerHTML);
	cost_8 = parseFloat(document.getElementById('heatcool_total_annual_cost').innerHTML);
	avg_8 = parseFloat(document.getElementById('heatcool_total_monthly_avg').innerHTML);
	
	kwh_9 = parseFloat(document.getElementById('garage_total_annual_kwh').innerHTML);
	cost_9 = parseFloat(document.getElementById('garage_total_annual_cost').innerHTML);
	avg_9 = parseFloat(document.getElementById('garage_total_monthly_avg').innerHTML);
	
	kwh_10 = parseFloat(document.getElementById('outdoors_total_annual_kwh').innerHTML);
	cost_10 = parseFloat(document.getElementById('outdoors_total_annual_cost').innerHTML);
	avg_10 = parseFloat(document.getElementById('outdoors_total_monthly_avg').innerHTML);
	
	kwh_11 = parseFloat(document.getElementById('kitchen_total_annual_kwh').innerHTML);
	cost_11 = parseFloat(document.getElementById('kitchen_total_annual_cost').innerHTML);
	avg_11 = parseFloat(document.getElementById('kitchen_total_monthly_avg').innerHTML);
	
	kwh_12 = parseFloat(document.getElementById('tv_total_annual_kwh').innerHTML);
	cost_12 = parseFloat(document.getElementById('tv_total_annual_cost').innerHTML);
	avg_12 = parseFloat(document.getElementById('tv_total_monthly_avg').innerHTML);
	
	total_kwh = kwh_1+kwh_2+kwh_4+kwh_6+kwh_8+kwh_9+kwh_10+kwh_11+kwh_12;
	total_cost = cost_1+cost_2+cost_4+cost_6+cost_8+cost_9+cost_10+cost_11+cost_12;
	total_avg = avg_1+avg_2+avg_4+avg_6+avg_8+avg_9+avg_10+avg_11+avg_12;
	
	document.getElementById('grand_total_annual_kwh').innerHTML = total_kwh.toFixed(0);
	document.getElementById('grand_total_annual_cost').innerHTML = total_cost.toFixed(2);
	document.getElementById('grand_total_monthly_avg').innerHTML = total_avg.toFixed(2);
}

function update_television_total() {
	var index;
	var appliance = ["tv_1", "tv_2", "tv_3", "tv_4", "tv_5", "tv_6", "tv_7", "tv_8", "tv_9", "tv_10", "tv_11", "tv_12"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('tv_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('tv_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('tv_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('tv_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('tv_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('tv_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_kitchen_total() {
	var index;
	var appliance = ["kitchen_1", "kitchen_2", "kitchen_3", "kitchen_4", "kitchen_41", "kitchen_6", "kitchen_5"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('kitchen_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('kitchen_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('kitchen_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('kitchen_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('kitchen_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('kitchen_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_outdoors_total() {
	var index;
	var appliance = ["outdoors_1", "outdoors_2", "outdoors_3", "outdoors_4"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('outdoors_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('outdoors_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('outdoors_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('outdoors_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('outdoors_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('outdoors_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_garage_total() {
	var index;
	var appliance = ["garage_1", "garage_2", "garage_3", "garage_4", "garage_5", "garage_6", "garage_7"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('garage_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('garage_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('garage_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('garage_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('garage_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('garage_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_heatcool_total() {
	var index;
	var appliance = ["heatcool_1", "heatcool_2", "heatcool_3", "heatcool_4", "heatcool_5", "heatcool_6", "heatcool_7", "heatcool_8", "heatcool_9", "heatcool_10", "heatcool_11"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('heatcool_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('heatcool_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('heatcool_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('heatcool_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('heatcool_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('heatcool_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_office_total() {
	var index;
	var appliance = ["office_1", "office_2"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('office_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('office_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('office_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('office_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('office_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('office_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_medical_total() {
	var index;
	var appliance = ["medical_1", "medical_2", "medical_3", "medical_4", "medical_5", "medical_6"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('medical_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('medical_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('medical_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('medical_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('medical_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('medical_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_bedroom_total() {
	var index;
	var appliance = ["bedroom_1", "bedroom_2", "bedroom_3", "bedroom_4", "bedroom_5", "bedroom_6", "bedroom_7"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('bedroom_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('bedroom_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('bedroom_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('bedroom_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('bedroom_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('bedroom_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_bathroom_total() {
	var index;
	var appliance = ["bathroom_1", "bathroom_2", "bathroom_3", "bathroom_4"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('bathroom_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('bathroom_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('bathroom_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('bathroom_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('bathroom_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('bathroom_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_livingroom_total() {
	var index;
	var appliance = ["livingroom_1", "livingroom_2"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('livingroom_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('livingroom_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('livingroom_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('livingroom_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('livingroom_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('livingroom_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_utilityroom_total() {
	var index;
	var appliance = ["utilityroom_1", "utilityroom_2", "utilityroom_3", "utilityroom_4", "utilityroom_5", "utilityroom_6", "utilityroom_7", "utilityroom_8", "utilityroom_9", "utilityroom_10", "utilityroom_11", "utilityroom_12", "utilityroom_13"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
		document.getElementById('utilityroom_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
		document.getElementById('utilityroom_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
		document.getElementById('utilityroom_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
		
		document.getElementById('utilityroom_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
		document.getElementById('utilityroom_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
		document.getElementById('utilityroom_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}

function update_refrigerator_total() {
	var index;
	var appliance = ["refrigerator_1", "refrigerator_2", "refrigerator_3", "refrigerator_4", "refrigerator_5", "refrigerator_6", "refrigerator_7", "refrigerator_8", "refrigerator_9", "refrigerator_10", "refrigerator_11", "refrigerator_12", "refrigerator_13", "refrigerator_14", "refrigerator_15"];
	total_kwh_annual = 0;
	total_annual_cost = 0;
	total_monthly_avg = 0;
	
	for (index = 0; index < appliance.length; ++index) {
	    total_kwh_annual += parseFloat(document.getElementById('kwh_annual_'+appliance[index]).innerHTML);
		total_annual_cost += parseFloat(document.getElementById('annual_cost_'+appliance[index]).innerHTML);
		total_monthly_avg += parseFloat(document.getElementById('monthly_avg_'+appliance[index]).innerHTML);  
	}
	
	document.getElementById('refrigerator_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('refrigerator_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('refrigerator_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
	
	document.getElementById('refrigerator_2_total_annual_kwh').innerHTML = total_kwh_annual.toFixed(0);
	document.getElementById('refrigerator_2_total_annual_cost').innerHTML = total_annual_cost.toFixed(2);
	document.getElementById('refrigerator_2_total_monthly_avg').innerHTML = total_monthly_avg.toFixed(2);
}