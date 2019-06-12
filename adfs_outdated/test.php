<?php

function isLoggedIn()
{
    if (isset($_SESSION['loggedIn']))
    {
        return $_SESSION['loggedIn'];
    }
    else
    {
        return false;
    }
}

$actual_link = $_SESSION['$actual_link'];


$aantal = substr_count($actual_link, "/"); // tellen waar precies de huidige link staat tov het ahslogin-mapje


if(!isLoggedIn())
{

    // bepalen waar de website de handlelogin moet gaan halen
    switch ($aantal) {
        case 4:
            header("Location:ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 5:
            header("Location:../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 6:
            header("Location:../../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 7:
            header("Location:../../../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 8:
            header("Location:../../../../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 9:
            header("Location:../../../../../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
        case 10:
            header("Location:../../../../../../ahslogin/handleLogin.php?returnLink=$actual_link");
            break;
    }

	//header("Location:../../../ahsgezondheidszorg/ahslogin/handleLogin.php?returnLink=$actual_link");
}




/*
if(!isLoggedIn())
{   
	header("Location:../ahslogin/handleLogin.php?returnLink=$actual_link");
}
*/