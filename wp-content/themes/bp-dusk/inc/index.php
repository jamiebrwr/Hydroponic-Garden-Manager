<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			require_once('easyfreshbooks.class.php');
			$freshbooks=new easyFreshBooksAPI();
		?>
		
		 <?php
		//$page=1;
		$filters=array(
			'email'=>'hannahseayphotography@gmail.com'
		);
		$list=$freshbooks->clientList();
		echo '<pre>';
			//print_r($list);
			foreach($list as $item){
			
				//print_r($item->client);
				
				//echo $item->client;
				
				$clients = $item->client;
				//echo '</pre>';	
					foreach($clients as $client_details){
						//print_r($client_detail);
						echo '<ul>';
							echo '<li>';
								echo '<strong>Client Name:</strong> ' . $client_details->first_name . ' ' . $client_details->last_name . '<br />';
								echo '<strong>Client ID:</strong> ' . $client_details->client_id . '<br />';
								echo '<strong>Email:</strong> ' . $client_details->email . '<br />';
								echo '<strong>Username:</strong> ' . $client_details->username . '<br />';
								/*
echo '<strong>Home Phone:</strong> ' . $client_details->home_phone . '<br />';
								echo '<strong>Mobile:</strong> ' . $client_details->mobile . '<br />';
								echo '<strong>Contacts:</strong> ' . $client_details->contacts . '<br />';
								echo '<strong>Organization:</strong> ' . $client_details->organization . '<br />';
								echo '<strong>Work Phone:</strong> ' . $client_details->work_phone . '<br />';
								echo '<strong>Fax:</strong> ' . $client_details->fax . '<br />';
								echo '<strong>Vat Name:</strong> ' . $client_details->vat_name . '<br />';
								echo '<strong>Vat Number:</strong> ' . $client_details->vat_number . '<br />';
								echo '<strong>Street:</strong> ' . $client_details->p_street1 . '<br />';
*/
							echo '</li>';
						echo '</ul>';
					}
					
				}
			//echo '</pre>';
		
		 ?>
	</body>
</html>