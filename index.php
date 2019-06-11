<?php
    session_start();
    if ( isset( $_SESSION['mail'] ) && !empty($_SESSION['mail']) ) {
    // Grab user data from the database using the user_id
    echo $_SESSION['mail'];
    ?>
    <hmtl>
    <body>
    <form action="https://www.arteveldehogeschool.be/azuredirectory/1/logout.php" method="get">
    <button type="submit" value="Submit">Uitloggen/button>
    </form>
    <?php
    // Let them access the "logged in only" pages
    // Redirect them to the login page
    } else {?>
    <form action="https://www.arteveldehogeschool.be/azuredirectory/1/azurelogin.php" method="get">
    <button type="submit" value="Submit">Log in met Azure AD</button>
    </form>
    </body>
    </html>
    <?php
     }
		?>
