<?php
/**
 * Template Name: App Dashboard
 *
 * The App Dashboard page template displays a summary of the web app
 *
 * @package Underscores
 * @subpackage Template
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="contentpanel">
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="panel panel-success panel-stat">
					<div class="panel-heading">
						<div class="stat">
							<div class="row">
								<div class="col-xs-4">
									<img src="images/is-user.png" alt="">
								</div>
								<div class="col-xs-8">
									<small class="stat-label">Visits Today</small>
									<h1>900k+</h1>
								</div>
							</div>
							<!-- row -->
							<div class="mb15"></div>
							<div class="row">
								<div class="col-xs-6">
									<small class="stat-label">Pages / Visit</small>
									<h4>7.80</h4>
								</div>
								<div class="col-xs-6">
									<small class="stat-label">% New Visits</small>
									<h4>76.43%</h4>
								</div>
							</div>
							<!-- row -->
						</div>
						<!-- stat -->
					</div>
					<!-- panel-heading -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
			<div class="col-sm-6 col-md-3">
				<div class="panel panel-danger panel-stat">
					<div class="panel-heading">
						<div class="stat">
							<div class="row">
								<div class="col-xs-4">
									<img src="images/is-document.png" alt="">
								</div>
								<div class="col-xs-8">
									<small class="stat-label">% Unique Visitors</small>
									<h1>54.40%</h1>
								</div>
							</div>
							<!-- row -->
							<div class="mb15"></div>
							<small class="stat-label">Avg. Visit Duration</small>
							<h4>01:80:22</h4>
						</div>
						<!-- stat -->
					</div>
					<!-- panel-heading -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
			<div class="col-sm-6 col-md-3">
				<div class="panel panel-primary panel-stat">
					<div class="panel-heading">
						<div class="stat">
							<div class="row">
								<div class="col-xs-4">
									<img src="images/is-document.png" alt="">
								</div>
								<div class="col-xs-8">
									<small class="stat-label">Page Views</small>
									<h1>300k+</h1>
								</div>
							</div>
							<!-- row -->
							<div class="mb15"></div>
							<small class="stat-label">% Bounce Rate</small>
							<h4>34.23%</h4>
						</div>
						<!-- stat -->
					</div>
					<!-- panel-heading -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
			<div class="col-sm-6 col-md-3">
				<div class="panel panel-dark panel-stat">
					<div class="panel-heading">
						<div class="stat">
							<div class="row">
								<div class="col-xs-4">
									<img src="images/is-money.png" alt="">
								</div>
								<div class="col-xs-8">
									<small class="stat-label">Today's Earnings</small>
									<h1>$655</h1>
								</div>
							</div>
							<!-- row -->
							<div class="mb15"></div>
							<div class="row">
								<div class="col-xs-6">
									<small class="stat-label">Last Week</small>
									<h4>$32,322</h4>
								</div>
								<div class="col-xs-6">
									<small class="stat-label">Last Month</small>
									<h4>$503,000</h4>
								</div>
							</div>
							<!-- row -->
						</div>
						<!-- stat -->
					</div>
					<!-- panel-heading -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-sm-8 col-md-9">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-8">
								<h5 class="subtitle mb5">Network Performance</h5>
								<p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
								<div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px; padding: 0px; position: relative;">
									<canvas class="flot-base" width="551" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 551px; height: 300px;"></canvas>
									<div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
										<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 27px; text-align: center;">0.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 111px; text-align: center;">1.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 196px; text-align: center;">2.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 280px; text-align: center;">3.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 365px; text-align: center;">4.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 449px; text-align: center;">5.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 78px; top: 278px; left: 534px; text-align: center;">6.0</div>
										</div>
										<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 258px; left: 8px; text-align: right;">0.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 215px; left: 8px; text-align: right;">2.5</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 172px; left: 8px; text-align: right;">5.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 129px; left: 8px; text-align: right;">7.5</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 86px; left: 1px; text-align: right;">10.0</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 43px; left: 1px; text-align: right;">12.5</div>
											<div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">15.0</div>
										</div>
									</div>
									<canvas class="flot-overlay" width="551" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 551px; height: 300px;"></canvas>
									<div class="legend">
										<div style="position: absolute; width: 74px; height: 42px; top: 16px; left: 40px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div>
										<table style="position:absolute;top:16px;left:40px;;font-size:smaller;color:#545454">
											<tbody>
												<tr>
													<td class="legendColorBox">
														<div style="border:1px solid #ccc;padding:1px">
															<div style="width:4px;height:0;border:5px solid #1CAF9A;overflow:hidden"></div>
														</div>
													</td>
													<td class="legendLabel">Uploads</td>
												</tr>
												<tr>
													<td class="legendColorBox">
														<div style="border:1px solid #ccc;padding:1px">
															<div style="width:4px;height:0;border:5px solid #428BCA;overflow:hidden"></div>
														</div>
													</td>
													<td class="legendLabel">Downloads</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- col-sm-8 -->
							<div class="col-sm-4">
								<h5 class="subtitle mb5">Server Status</h5>
								<p class="mb15">Summary of the status of your server.</p>
								<span class="sublabel">CPU Usage (40.05 - 32 cpus)</span>
								<div class="progress progress-sm">
									<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
								</div>
								<!-- progress -->
								<span class="sublabel">Memory Usage (32.2%)</span>
								<div class="progress progress-sm">
									<div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
								</div>
								<!-- progress -->
								<span class="sublabel">Disk Usage (82.2%)</span>
								<div class="progress progress-sm">
									<div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
								</div>
								<!-- progress -->
								<span class="sublabel">Databases (63/100)</span>
								<div class="progress progress-sm">
									<div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning"></div>
								</div>
								<!-- progress -->
								<span class="sublabel">Domains (2/10)</span>
								<div class="progress progress-sm">
									<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
								</div>
								<!-- progress -->
								<span class="sublabel">Email Account (13/50)</span>
								<div class="progress progress-sm">
									<div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
								</div>
								<!-- progress -->
							</div>
							<!-- col-sm-4 -->
						</div>
						<!-- row -->
					</div>
					<!-- panel-body -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-9 -->
			<div class="col-sm-4 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="subtitle mb5">Most Browser Used</h5>
						<p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
						<div id="donut-chart2" style="text-align: center; height: 298px;">
							<svg height="298" version="1.1" width="239" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.25px;">
								<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
								<defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
								<path fill="none" stroke="#d9534f" d="M119.5,222A73,73,0,0,0,189.66070857984107,128.83877554376716" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path>
								<path fill="#d9534f" stroke="#ffffff" d="M119.5,225A76,76,0,0,0,192.54402537079346,128.01023207296305L224.7410628697616,118.75816331565072A109.5,109.5,0,0,1,119.5,258.5Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<path fill="none" stroke="#1caf9a" d="M189.66070857984107,128.83877554376716A73,73,0,0,0,122.01097140901466,76.04319755784869" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
								<path fill="#1caf9a" stroke="#ffffff" d="M192.54402537079346,128.01023207296305A76,76,0,0,0,122.11416201486458,73.04497279995206L123.09447277043878,44.56183759993408A104.5,104.5,0,0,1,219.935534884841,120.1390691003242Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<path fill="none" stroke="#428bca" d="M122.01097140901466,76.04319755784869A73,73,0,0,0,50.891457187091405,124.06272161824246" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
								<path fill="#428bca" stroke="#ffffff" d="M122.11416201486458,73.04497279995206A76,76,0,0,0,48.07192803039652,123.03790195871818L21.286401041795216,113.30211519323751A104.5,104.5,0,0,1,123.09447277043878,44.56183759993408Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<path fill="none" stroke="#5bc0de" d="M50.891457187091405,124.06272161824246A73,73,0,0,0,74.5784176652702,206.54173650963338" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
								<path fill="#5bc0de" stroke="#ffffff" d="M48.07192803039652,123.03790195871818A76,76,0,0,0,72.73232524055527,208.90646540728955L55.194447205763495,231.3713899350231A104.5,104.5,0,0,1,21.286401041795216,113.30211519323751Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<path fill="none" stroke="#428bca" d="M74.5784176652702,206.54173650963338A73,73,0,0,0,119.47706637400604,221.99999639759432" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path>
								<path fill="#428bca" stroke="#ffffff" d="M72.73232524055527,208.90646540728955A76,76,0,0,0,119.47612389622547,224.99999624955026L119.46717035731002,253.49999484313162A104.5,104.5,0,0,1,55.194447205763495,231.3713899350231Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<text x="119.5" y="139" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" font-size="15px" font-weight="800" transform="matrix(2.175,0,0,2.175,-140.4181,-173.1908)" stroke-width="0.4597602739726028" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: 800; font-size: 15px; line-height: normal; font-family: Arial;">
									<tspan dy="5.203125" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Chrome</tspan>
								</text>
								<text x="119.5" y="159" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#000000" font-size="14px" transform="matrix(1.5542,0,0,1.5542,-66.2299,-83.7832)" stroke-width="0.6434075342465754" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-family: Arial;">
									<tspan dy="4.859375" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">30</tspan>
								</text>
							</svg>
						</div>
					</div>
					<!-- panel-body -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-3 -->
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-sm-7">
				<div class="table-responsive dashboard-datatable">
					<div id="table1_wrapper" class="dataTables_wrapper" role="grid">
						<div class="dataTables_filter" id="table1_filter"><label>Search: <input type="text" aria-controls="table1"></label></div>
						<table class="table dataTable" id="table1" aria-describedby="table1_info">
							<thead>
								<tr role="row">
									<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 153px;">Rendering engine</th>
									<th class="sorting" role="columnheader" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 242px;">Browser</th>
									<th class="sorting" role="columnheader" tabindex="0" aria-controls="table1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 222px;">Platform(s)</th>
								</tr>
							</thead>
							<tbody role="alert" aria-live="polite" aria-relevant="all">
								<tr class="gradeA odd">
									<td class=" sorting_1">Gecko</td>
									<td class=" ">Firefox 1.0</td>
									<td class=" ">Win 98+ / OSX.2+</td>
								</tr>
								<tr class="gradeA even">
									<td class=" sorting_1">Gecko</td>
									<td class=" ">Firefox 1.5</td>
									<td class=" ">Win 98+ / OSX.2+</td>
								</tr>
								<tr class="gradeA odd">
									<td class=" sorting_1">Gecko</td>
									<td class=" ">Firefox 2.0</td>
									<td class=" ">Win 98+ / OSX.2+</td>
								</tr>
								<tr class="gradeA even">
									<td class=" sorting_1">Gecko</td>
									<td class=" ">Firefox 3.0</td>
									<td class=" ">Win 2k+ / OSX.3+</td>
								</tr>
								<tr class="gradeA odd">
									<td class=" sorting_1">Gecko</td>
									<td class=" ">Camino 1.0</td>
									<td class=" ">OSX.2+</td>
								</tr>
							</tbody>
						</table>
						<div class="dataTables_info" id="table1_info">Showing 1 to 5 of 57 entries</div>
						<div class="dataTables_paginate paging_two_button" id="table1_paginate"><a class="paginate_disabled_previous" tabindex="0" role="button" id="table1_previous" aria-controls="table1">Previous</a><a class="paginate_enabled_next" tabindex="0" role="button" id="table1_next" aria-controls="table1">Next</a></div>
					</div>
				</div>
				<!-- table-responsive -->
			</div>
			<!-- col-sm-7 -->
			<div class="col-sm-5">
				<div class="panel panel-success">
					<div class="panel-heading padding5">
						<div id="line-chart" style="height: 248px; position: relative;">
							<svg height="248" version="1.1" width="468" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.078125px;">
								<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
								<defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
								<text x="36.5" y="208.984375" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
								</text>
								<text x="36.5" y="162.98828125" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.16015625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">17.5</tspan>
								</text>
								<text x="36.5" y="116.9921875" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.15625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">35</tspan>
								</text>
								<text x="36.5" y="70.99609375" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.16015625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">52.5</tspan>
								</text>
								<text x="36.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">70</tspan>
								</text>
								<text x="443.00000000000006" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan>
								</text>
								<text x="377.3633044272022" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan>
								</text>
								<text x="311.7266088544044" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan>
								</text>
								<text x="246.08991328160658" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan>
								</text>
								<text x="180.27339114559564" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan>
								</text>
								<text x="114.63669557279782" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan>
								</text>
								<text x="49" y="221.484375" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#ffffff" font-size="12px" font-family="sans-serif" font-weight="normal" fill-opacity="0.5" transform="matrix(1,0,0,1,0,7.0078)" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;">
									<tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan>
								</text>
								<path fill="none" stroke="#fdd2a4" d="M49,208.984375L114.63669557279782,143.27566964285714L180.27339114559564,130.13392857142856L246.08991328160658,156.41741071428572L311.7266088544044,116.9921875L377.3633044272022,77.56696428571428L443.00000000000006,64.4252232142857" stroke-width="2px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<path fill="none" stroke="#ffffff" d="M49,77.56696428571428L114.63669557279782,51.28348214285714L180.27339114559564,90.70870535714285L246.08991328160658,103.85044642857142L311.7266088544044,77.56696428571428L377.3633044272022,51.28348214285714L443.00000000000006,38.141741071428555" stroke-width="2px" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
								<circle cx="49" cy="208.984375" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="114.63669557279782" cy="143.27566964285714" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="180.27339114559564" cy="130.13392857142856" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="246.08991328160658" cy="156.41741071428572" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="311.7266088544044" cy="116.9921875" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="377.3633044272022" cy="77.56696428571428" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="443.00000000000006" cy="64.4252232142857" r="4" fill="#fdd2a4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="49" cy="77.56696428571428" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="114.63669557279782" cy="51.28348214285714" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="180.27339114559564" cy="90.70870535714285" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="246.08991328160658" cy="103.85044642857142" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="311.7266088544044" cy="77.56696428571428" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="377.3633044272022" cy="51.28348214285714" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
								<circle cx="443.00000000000006" cy="38.141741071428555" r="4" fill="#ffffff" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
							</svg>
						</div>
					</div>
					<div class="panel-body">
						<div class="tinystat pull-left">
							<div id="sparkline" class="chart mt5">
								<canvas width="59" height="30" style="display: inline-block; width: 59px; height: 30px; vertical-align: top;"></canvas>
							</div>
							<div class="datainfo">
								<span class="text-muted">Average Sales</span>
								<h4>$630,201</h4>
							</div>
						</div>
						<!-- tinystat -->
						<div class="tinystat pull-right">
							<div id="sparkline2" class="chart mt5">
								<canvas width="59" height="30" style="display: inline-block; width: 59px; height: 30px; vertical-align: top;"></canvas>
							</div>
							<div class="datainfo">
								<span class="text-muted">Total Sales</span>
								<h4>$139,201</h4>
							</div>
						</div>
						<!-- tinystat -->
					</div>
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
		</div>
		<!-- row -->
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<div class="panel panel-default widget-photoday">
					<div class="panel-body">
						<a href="" class="photoday"><img src="images/photos/photo1.png" alt=""></a>
						<div class="photo-details">
							<h4 class="photo-title">Strawhat In The Beach</h4>
							<small class="text-muted"><i class="fa fa-map-marker"></i> San Franciso, California, USA</small>
							<small>By: <a href="">ThemePixels</a></small>
						</div>
						<!-- photo-details -->
						<ul class="photo-meta">
							<li><span><i class="fa fa-eye"></i> 32,102</span></li>
							<li><a href="#"><i class="fa fa-heart"></i> 1,003</a></li>
							<li><a href="#"><i class="fa fa-comments"></i> 52</a></li>
						</ul>
					</div>
					<!-- panel-body -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
			<div class="col-sm-6 col-md-4">
				<div class="panel panel-default panel-alt widget-messaging">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="panel-edit"><i class="fa fa-edit"></i></a>
						</div>
						<!-- panel-btns -->
						<h3 class="panel-title">Messaging</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li>
								<small class="pull-right">Dec 10</small>
								<h4 class="sender">Jennier Lawrence</h4>
								<small>Lorem ipsum dolor sit amet...</small>
							</li>
							<li>
								<small class="pull-right">Dec 9</small>
								<h4 class="sender">Marsha Mellow</h4>
								<small>Lorem ipsum dolor sit amet...</small>
							</li>
							<li>
								<small class="pull-right">Dec 9</small>
								<h4 class="sender">Holly Golightly</h4>
								<small>Lorem ipsum dolor sit amet...</small>
							</li>
							<li>
								<small class="pull-right">Dec 10</small>
								<h4 class="sender">Jennier Lawrence</h4>
								<small>Lorem ipsum dolor sit amet...</small>
							</li>
							<li>
								<small class="pull-right">Dec 9</small>
								<h4 class="sender">Marsha Mellow</h4>
								<small>Lorem ipsum dolor sit amet...</small>
							</li>
						</ul>
					</div>
					<!-- panel-body -->
				</div>
				<!-- panel -->
			</div>
			<!-- col-sm-6 -->
			<div class="col-sm-6 col-md-4">
				<div class="panel panel-dark panel-alt widget-quick-status-post">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="panel-close">×</a>
							<a href="" class="minimize">−</a>
						</div>
						<!-- panel-btns -->
						<h3 class="panel-title">Quick Status Post</h3>
					</div>
					<div class="panel-body">
						<ul class="nav nav-tabs nav-justified">
							<li class="active"><a href="#post-status" data-toggle="tab"><i class="fa fa-pencil"></i> <strong>Status</strong></a></li>
							<li><a href="#post-photo" data-toggle="tab"><i class="fa fa-picture-o"></i> <strong>Photo</strong></a></li>
							<li><a href="#post-checkin" data-toggle="tab"><i class="fa fa-map-marker"></i> <strong>Check-In</strong></a></li>
						</ul>
						<div class="tab-content">
							<div id="post-status" class="tab-pane active">
								<input type="text" class="form-control" placeholder="What's your status?">
							</div>
							<div id="post-photo" class="tab-pane">
								<input type="text" class="form-control" placeholder="Choose photo">
							</div>
							<div id="post-checkin" class="tab-pane">
								<input type="text" class="form-control" placeholder="Search location">
							</div>
							<button class="btn btn-primary btn-block mt10">Submit Post</button>
						</div>
						<!-- tab-content -->
					</div>
					<!-- panel-body -->
				</div>
				<!-- panel -->
				<div class="mb20"></div>
				<div class="row">
					<div class="col-xs-6">
						<div class="panel panel-warning panel-alt widget-today">
							<div class="panel-heading text-center">
								<i class="fa fa-calendar-o"></i>
							</div>
							<div class="panel-body text-center">
								<h3 class="today">Fri, Dec 13</h3>
							</div>
							<!-- panel-body -->
						</div>
						<!-- panel -->
					</div>
					<div class="col-xs-6">
						<div class="panel panel-danger panel-alt widget-time">
							<div class="panel-heading text-center">
								<i class="glyphicon glyphicon-time"></i>
							</div>
							<div class="panel-body text-center">
								<h3 class="today">4:50AM PST</h3>
							</div>
							<!-- panel-body -->
						</div>
						<!-- panel -->
					</div>
				</div>
			</div>
			<!-- col-sm-6 -->
		</div>
	</div>

    
<?php endwhile; ?>

	<?php// custody_agreements_paging_nav(); ?>

<?php else : ?>

	<?php// get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
   
<?php get_footer(); ?>
