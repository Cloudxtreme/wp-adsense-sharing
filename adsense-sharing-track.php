<?php
	require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/wp-config.php');
	nocache_headers();
	require_once( dirname(__FILE__) . '/adsense-sharing.php' );
	
	if(!isset($wpas))
		$wpas = new WPAS();
		
	$wpas_data = array();
	$wpas_data['postid'] = absint($_GET['postid']);
	$wpas_data['author'] = absint($_GET['author']);
	$wpas_data['kw'] = urldecode(trim($_GET['kw']));
	$wpas->handle_record($wpas_data);
	
?>
