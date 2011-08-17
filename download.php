<?php
	$csvfile = $_GET['file'];
	preg_match('@[0-9]{14}\.csv@',$csvfile,$match);
	if(!$match)
		return;
	$fullpath = dirname(__FILE__).'/files/'.$match[0];
	if(!file_exists($fullpath))
		return;
	wpas_download_file($fullpath);
function wpas_download_file( $fullPath ){ 

	// Must be fresh start 
	if( headers_sent() ) 
		die('Headers Sent'); 

	    // Required for some browsers 
	if(ini_get('zlib.output_compression')) 
	ini_set('zlib.output_compression', 'Off'); 

	header("Pragma: public"); // required 
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Cache-Control: private",false); // required for certain browsers 
	header("Content-Type: text/csv"); 
	header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" ); 
	header("Content-Transfer-Encoding: binary");
	ob_clean(); 
	flush(); 
	wpas_get_file( $fullPath ); 

}
function wpas_get_file($url){
	$data = '';
	if(ini_get('allow_url_fopen') != 1) {
		@ini_set('allow_url_fopen', '1');
	}

	if(ini_get('allow_url_fopen') != 1) {
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		if($data === false){
			exit(curl_error($ch));
		}
		curl_close($ch);
    
	} else {
		$data  = readfile($url);
	}
	if($data  === false){
		exit("File Not Found");
	}
	return $data;

 
}	
?>
