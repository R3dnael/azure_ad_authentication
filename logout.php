<?php
Session_start();
Session_destroy();
// to log out of azure also
// --> header("Location: https://login.microsoftonline.com/b6e080ea-adb9-4c79-9303-6dcf826fb854/oauth2/logout?post_logout_redirect_uri=https://www.arteveldehogeschool.be/azuredirectory/1/");
// to log out of the site
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
