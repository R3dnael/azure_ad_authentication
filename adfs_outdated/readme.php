<?php

session_start();

// onderstaande S_SESSIONs en if-else dien aangemaakt te worden in de top van je pagina (kan in includes_once functions, connect,...)
$_SESSION['adminsvoordezeapp'] = ['krsiscl', 'jonade3', 'evaboo']; // dit zijn je admins voor je applicatie
$_SERVER['HTTP_HOST'] = "www.arteveldehogeschool.be"; // change for reverse proxy
$_SESSION['$actual_link'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_SESSION['admin']))
{
    $admin = $_SESSION['admin'];
}
else
{
    $admin = '';
}




// include_once '../ahslogin/login.php' deze pagina (let op dat het naar de ahslogin-map gaat)
include_once 'login.php';

// Wat kan je oproepen na login:
if ($admin) // true als de gebruiker in de ['adminsvoordezeapp'] is meegegeven
{
	echo $_SESSION['user'] = $userName;
	echo "<br>";
	echo $_SESSION['naam'];
	echo "<br>";
	echo $_SESSION['voornaam'];
	echo "<br>";
	echo $_SESSION['email'];
	echo "<br>";
	echo $_SESSION['rol']; // $_SESSION['rol'] = "student"; OF $_SESSION['rol'] = "medewerker";
}
else
{
	echo "Enkel voor admins en Eva Booms.";
}


