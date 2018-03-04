<?php
	// TEST CASE: LIST MEMBERSHIP TYPES ---------------------------------------------------------		
	// head
	echo '<h1>TEST CASE 1: LIST MEMBERSHIP TYPES</h1><hr>';
	// post
	$response = $client->get('membership_types');
	// simplexml
	$xml = @simplexml_load_string($response);
	// endpoint
	echo sprintf('Endpoint: %s<br>', $client->get_endpoint());
	// dump
	if($xml){			
		echo sprintf('<pre>%s</pre>', print_r($xml, 1));
	}else{
		echo 'Response: <hr>' . $response;
	}
?>