<?php
require_once('settings.php');
require_once('devices.php');

if (!empty($devices) && is_array($devices)) {
	
	$curl = (function_exists('curl_version') ? TRUE : FALSE);
	
	foreach ($devices as &$info) {
		
		$info['method'] = NULL;
		
		$info['heartbeat'] = FALSE;
		$info['heartbeat_icon'] = '<i class="fas fa-exclamation-triangle text-danger" data-toggle="tooltip" data-placement="top" title="Failed Test, No Heartbeat"></i>';
		
		$info['service'] = NULL;
		$info['service_result'] = NULL;
		$info['service_icon'] = NULL;
		
		$target = parse_url($info['host'])['host'] ?: $info['host'];
		$ping = (!isset($info['port']) || !is_numeric($info['port']) ? TRUE : FALSE);
		$web = (!empty($settings['website']) && is_array($settings['website']['ports']) && in_array($info['port'], $settings['website']['ports']) ? TRUE : FALSE);

		if ($ping === TRUE) {
			
			$info['method'] = 'ICMP Ping';
			
			exec("ping -n {$settings['ping']['requests']} {$target}", $info['result'], $info['status']);
			
			$i = 0;
			
			if (!empty($info['result']) && is_array($info['result'])) {
				
				foreach ($info['result'] as $result) {
					
					if (strpos($result, 'Reply from') !== FALSE) {
						
						$i++;
					}
				}
				
				if ($i === $settings['ping']['requests'] || ($settings['ping']['strict'] === FALSE && $i > 0)) {
					
					$info['heartbeat'] = TRUE;
					$info['heartbeat_icon'] = '<i class="fas fa-heartbeat text-success" data-toggle="tooltip" data-placement="top" title="PING test OK / Heartbeat Detected"></i>';
				}
			}
		}
		else {
			
			$info['method'] = 'Socket Connection via specified port';
			
			$fp = fsockopen($target, $info['port'], $info['status'], $info['result'], $settings['socket']['timeout']);
			
			if ($fp !== FALSE) {
				
				$info['result'] = "Socket Connection Established on Port {$info['port']} OK";
				
				$info['heartbeat'] = TRUE;
				$info['heartbeat_icon'] = '<i class="fas fa-route text-success" data-toggle="tooltip" data-placement="top" title="Connection Established"></i>';
			}
			
			$curl = ($settings['website']['discovery'] === TRUE || $fp !== FALSE ? TRUE : FALSE);
			
			if ($settings['website']['service'] === TRUE && $web === TRUE && $curl === TRUE) {
				
				if ($curl === TRUE) {
					
					if ($settings['website']['validate'] === FALSE || filter_var($info['host'], FILTER_VALIDATE_URL)) {
						
						$info['method'] .= '<br />CURL HTTP Status Code Check';
					
						$ch = curl_init();
						
						curl_setopt($ch, CURLOPT_URL, $info['host']);
						curl_setopt($ch, CURLOPT_USERAGENT, $settings['website']['agent']);
						curl_setopt($ch, CURLOPT_NOBODY, TRUE);
						curl_setopt($ch, CURLOPT_HEADER, FALSE);
						curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						curl_setopt($ch, CURLOPT_NOPROGRESS, TRUE);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
						
						curl_exec($ch);
						
						$co = curl_getinfo($ch, CURLINFO_HTTP_CODE);
						
						curl_close($ch);
						
						if ($co >= 200 && $co < 300) {
							
							$info['service'] = TRUE;
							$info['service_result'] = "HTTP Reponse Status {$co} OK";
							$info['service_icon'] = '<i class="fas fa-cloud text-success" data-toggle="tooltip" data-placement="top" title="HTTP Status OK"></i>';
						}
						else {
							
							$info['service'] = FALSE;
							$info['service_result'] = "ERROR indicated by HTTP Reponse Status"; 
							$info['service_icon'] = '<i class="fas fa-minus-circle text-danger" data-toggle="tooltip" data-placement="top" title="HTTP Status Error"></i>';
						}
					}
					else {
						
						$info['service'] = FALSE;
						$info['service_result'] = 'URL failed validation, check settings';
						$info['service_icon'] = '<i class="fas fa-unlink text-warning" data-toggle="tooltip" data-placement="top" title="URL failed validation"></i>';
					}
				}
				else {
					
					$info['service'] = FALSE;
					$info['service_result'] = 'CURL not enabled, check settings';
					$info['service_icon'] = '<i class="fas fa-cogs text-warning" data-toggle="tooltip" data-placement="top" title="CURL not enabled"></i>';
				}
			}
		}
	}
	
	require_once('view.php');
}
?>