<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','On');

//HANDLE LOGOUT
if(isset($_GET['logout']) && $_GET['logout'] == "true")
{
	session_destroy();
	header("Location:https://sts.arteveldehs.be/adfs/ls/?wa=wsignout1.0");
	exit();
}
else //HANDLE LOGIN 
{
		
	if(isset($_GET['returnLink']) && $_GET['returnLink'] != '')
	{
		$_SESSION['returnLink'] = $_GET['returnLink'];
	}
	include("../../includes/sts/login.php");
	
	//get the return url of the elpa sites
		
	
	//get the info from the sts
	$userInfo = unserialize($_SESSION['AdfsUserDetails']);
	
	//filter username out of emailaddress
	$userName = substr($userInfo->attributes['upn'][0],0,strpos($userInfo->attributes['upn'][0],"@"));
	
	if(count($userInfo->attributes) > 0)
	{
		//FILLING THE NECESSARY INFORMATION FIELDS
		$_SESSION['naam'] 			= $userInfo->attributes['surname'][0];
		$_SESSION['voornaam'] 	= $userInfo->attributes['givenname'][0];
		$_SESSION['email'] 			= $userInfo->attributes['emailaddress'][0];
		//CHECK IF ROLE IS STUDENT OR MEDEWERKER
        	foreach ($userInfo->attributes['role'] as $role)
        	{
        		if(stristr($role,"student"))
        		{
        			$_SESSION['rol'] = "student";
        		}
        		elseif (stristr($role,"personeel"))
        		{
        			$_SESSION['rol'] = "medewerker";
        		}
        	}
		$_SESSION['loggedIn']	= 1;
		$_SESSION['user']	= $userName;

		if (in_array($_SESSION['user'], $_SESSION['adminsvoordezeapp']))
		{
			$_SESSION['admin'] = true;
		}
		else
		{
			$_SESSION['admin'] = false;
		}

		$loc 			= "Location:".$_SESSION['returnLink'];
		//DOUBLE CHECK OMDAT STS OM 1 OF ANDERE REDEN EEN DUBBELE REDIRECT DOET!
		if($_SESSION['naam'] != '')
			header($loc);
	}
	else
	{
		$_SESSION['loggedIn'] 	= 0;
	}
}
