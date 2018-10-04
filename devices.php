<?php
$devices = array();

$devices[] = array(
	
	'host' => 'http://www.google.com',
	'alias' => 'Google Web',
	'description' => 'Google Website status code check on port 80',
	'location' => '',
	'port' => 80
);

$devices[] = array(
	
	'host' => 'http://www.bbc.co.uk',
	'alias' => 'BBC Web (Ping Only)',
	'description' => 'Ping test on the BBC Website',
	'location' => '',
	'port' => ''
);

$devices[] = array(
	
	'host' => 'http://www.yahoo.co.uk',
	'alias' => 'Yahoo Web (Ping Only)',
	'description' => 'Ping test on the Yahoo UK website',
	'location' => '',
	'port' => ''
);

$devices[] = array(
	
	'host' => 'SQLSRV001',
	'alias' => 'SQLSRV001 (Port Check)',
	'description' => 'Port test for a SQL server that does not exist',
	'location' => '',
	'port' => 1433
);

$devices[] = array(
	
	'host' => 'http://www.thisisawebsitethatdoesnot.exist',
	'alias' => 'BADSITE001',
	'description' => 'Website status code check that does not exist',
	'location' => '',
	'port' => 80
);

$devices[] = array(
	
	'host' => '127.0.0.1',
	'alias' => 'LOCALHOST (Ping Only)',
	'description' => 'Check yourself',
	'location' => '',
	'port' => ''
);

$devices[] = array(
	
	'host' => 'https://www.theguardian.com/uk-news',
	'alias' => 'Guardian UK News',
	'description' => 'Website status code check on the Guardian UK',
	'location' => '',
	'port' => 443
);

$devices[] = array(
	
	'host' => 'OFFLINESRV001',
	'alias' => 'SRV001 (Ping Only)',
	'description' => 'Ping test for a server that does not exist',
	'location' => '',
	'port' => ''
);
?>