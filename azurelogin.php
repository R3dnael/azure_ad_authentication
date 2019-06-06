<?php
session_start();
error_reporting(-1);
ini_set('display_errors', 'On');

if (!isset($_GET['code'])) {
 $authUrl = "https://login.microsoftonline.com/b6e080ea-adb9-4c79-9303-6dcf826fb854/oauth2/authorize?";
 $authUrl .= "client_id=0db6ad3a-5d4a-4ae9-b38a-5305e7b1bbd3";
 $authUrl .= "&response_type=code";
 $authUrl .= "&redirect_uri=https%3a%2f%2fwww.arteveldehogeschool.be%2fazuredirectory%2f1%2fazurelogin.php";
 $authUrl .= "&response_mode=query";
 $authUrl .= "&resource=https%3A%2F%2Fgraph.microsoft.com%2F";
 $authUrl .= "&state=12345";

 header('Location: '.$authUrl);
 exit;

} else {

 $accesscode = $_GET['code'];

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL,"https://login.microsoftonline.com/b6e080ea-adb9-4c79-9303-6dcf826fb854/oauth2/token");
 curl_setopt($ch, CURLOPT_POST, 1);
 $client_id = "0db6ad3a-5d4a-4ae9-b38a-5305e7b1bbd3";
 $client_secret = "kk8Y-YV@2dm1@bzs7k=+Ix=2RrEtR[c2";
 curl_setopt($ch, CURLOPT_POSTFIELDS,
 "grant_type=authorization_code&client_id=".$client_id."&redirect_uri=https%3a%2f%2fwww.arteveldehogeschool.be%2fazuredirectory%2f1%2fazurelogin.php&resource=https%3A%2F%2Fgraph.microsoft.com%2F&&code=".$accesscode."&client_secret=".urlencode($client_secret));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $server_output = curl_exec ($ch);
 curl_close ($ch);
 $jsonoutput = json_decode($server_output, true);

 $bearertoken = $jsonoutput['access_token'];
 $url = "https://graph.microsoft.com/v1.0/me";
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $User_Agent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
 $request_headers = array();
 $request_headers[] = 'User-Agent: '. $User_Agent;
 $request_headers[] = 'Accept: application/json';
 $request_headers[] = 'Authorization: Bearer '. $bearertoken;
 curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
 $result = curl_exec($ch);
 curl_close($ch);
 $json = json_decode($result, true);
 $mail = $json['mail'];
 $_SESSION['mail'] = (string)$mail;
 session_write_close();
 header("Location: https://www.arteveldehogeschool.be/azuredirectory/1/index.php");
}

?>
