<?php 
	
	require('google-api-php-client/src/Google_Client.php');
	require('google-api-php-client/src/contrib/Google_AnalyticsService.php');
	
	//START THE SESSION
	session_start();
	
	//CREATE A NEW OBJECT
	$client = new Google_Client();

	$client->setApplicationName('API PROJECT DEMO 3');

	// SET CREDENTIALS
		
	$client->setAssertionCredentials(
	    new Google_AssertionCredentials(
		    	'EMAIL ADDESS FROM GOOGLE CONSOLE WITHIN SERVICE ACCOUNT',//EMAIL ADDRESS FROM CONSOLE
	    	array('https://www.googleapis.com/auth/analytics.readonly'),
	    	file_get_contents('PRIVATE KEY PATH') // keyfile you downloaded
	    )
	);

	// SET UP THE CLIEND ID FROM API CONSOLE
		
	$client->setClientId('CLIENT ID FROM GOOGLE CONSOLE WITHIN SERVICE ACCOUNT');
		
	// THIS IS AN OPTIONAL
	$client->setAccessType('offline_access');
		
	// RETRIEVE DATA AS AN OBJECT

	$client->setUseObjects(true);
		
	// ANALYSE THE API SERVICE OBJECT
		
	$service = new Google_AnalyticsService($client);
	

	$projectId = 'PROJECT ID';
		
	//OPTIONAL PARAMS
		
	$optParams = array(
        	'dimensions' => 'ga:pagePath,ga:date',
         	'max-results' => '1000'
    );

    //SET THE METRICS
	$metrics = "ga:visitors,ga:pageviews,ga:uniquePageviews";
		
	//MAKE A CALL AND STORE THE RESULT IN VARIABLE
	//START DATE: YYYY-MM-DD
	//END DATE: YYYY-MM-DD
		
	$results=$service->data_ga->get('ga:' . $projectId,'START DATE','END DATE',$metrics,$optParams);
 	
 	//LET'S ECHO THE RESULT
 	
 	echo "<table>";
 	echo "<tr>";
 	echo "<th>PAGE VISITED</th>";
 	echo "<th>DATE</th>";
 	echo "<th>VISITORS</th>";
 	echo "<th>PAGEVIEWS</th>";
 	echo "<th>UNIQUE PAGEVIEWS</th>";
 	echo "</tr>";

 	foreach ($results->getRows() as $key => $value) {
 		echo "<tr>";
 		foreach ($value as $key => $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
 	}
 	echo "</table>";
?>