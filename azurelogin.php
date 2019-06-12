<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');
//load azureconfig
$configs = include('azureconfig.php');
//include curlcall.php
include_once('curlcall.php');

//Kijken of login met azure ad al gebeurd is
if (!isset($_GET['code'])) {
 $authUrl = $configs["urlAuthorize"]."?";
 $authUrl .= "client_id=".$configs["clientId"];
 $authUrl .= "&response_type=code";
 $authUrl .= "&redirect_uri=".$configs["redirectUri"];
 $authUrl .= "&response_mode=query";
 $authUrl .= "&scope=".$configs["scope"];
 $authUrl .= "&state=12345";

 header('Location: '.$authUrl); //loginurl
 exit;

} else {

 //code ophalen uit return login-procedure
 $accesscode = $_GET['code'];
 //authenticatietoken voor graph api

 $curlopt = "grant_type=authorization_code
            &redirect_uri=".$configs["redirectUri"]."
            &client_id=".$configs["clientId"]."
            &scope=offline_access%20https://graph.microsoft.com/user.read%20openid
            &client_secret=".urlencode($configs["clientSecret"])."
            &&code=" . $_GET['code'];
 $getaccesstoken = new curllcall();
 $result = $getaccesstoken->POSTcall($configs["urlAccessToken"], $curlopt);
 $apicall = new curllcall();
 $result = $apicall->GETcall($configs["urlResourceOwnerDetails"],  $result['access_token']);
 $obj = json_decode($result);
 $mail = $obj->mail;
 $name = $obj->givenName;
 $surname = $obj->surname;
 $_SESSION['mail'] = (string)$mail;
 $_SESSION['name'] = (string)$name;
 $_SESSION['surname'] = (string)$surname;
 session_write_close();
 header("Location: ".$configs["homeurl"]);
}
?>
