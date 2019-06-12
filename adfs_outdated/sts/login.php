<?php    
    if(!isset($_SESSION)) {
        session_start();
    }
    include_once("classes/adfsbridge.php");
    include_once("classes/adfsuserdetails.php");
    include_once("conf/adfsconf.php"); 
		
	if(!isset($_SESSION['AdfsUserDetails'])) 
	{
		$_SERVER['HTTP_HOST'] = 'www.arteveldehogeschool.be'; //add domain if different from host config
		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
         	//automatisch doorsturen naar adfs, dit met een redirect naar huidige pg
         	$adfs = new AdfsBridge();
         	$adfs->redirectToAdfsSignInUrl(AdfsConf::getInstance(), $actual_link);    
	}
?>
