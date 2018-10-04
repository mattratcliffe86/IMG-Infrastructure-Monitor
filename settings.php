<?php
/*-----------------------------------------//
	View Settings
	
	Organisation:	Name of the organisation, this will be shown in the top right of the page
	
//-----------------------------------------*/

$settings['view']['organisation'] = 'Your Organisation Name';

/*-----------------------------------------//
	Ping Settings
	
	Requests:	The number of PING requests to perform on the device
	Strict:		Require ALL ping requests to be completed before the device before reporting OK status
	
//-----------------------------------------*/

$settings['ping']['requests'] = 2;
$settings['ping']['strict'] = FALSE;

/*-----------------------------------------//
	Website Settings
	
	Service:	Enable checking of the website service
	Discovery:	Enable discovery of errors
	Validate:	Validation of the URL provided
	Ports:		Ports to be considered web enabled ports
	Agent:		This is who the monitor identifies itself asin
	
//-----------------------------------------*/

$settings['website']['service'] = TRUE;
$settings['website']['discovery'] = FALSE;
$settings['website']['validate'] = FALSE;
$settings['website']['ports'] = array(80, 8080, 443);
$settings['website']['agent'] = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';

/*-----------------------------------------//
	Socket Settings
	
	Timeout:	The connection timeout in seconds
	
//-----------------------------------------*/

$settings['socket']['timeout'] = 5;
?>