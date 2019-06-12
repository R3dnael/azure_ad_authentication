<?php
    session_start();
    if ( isset( $_SESSION['mail']) && !empty($_SESSION['mail'])) {
    // Grab user data from the database using the user_id
    echo $_SESSION['mail']."<br>";
    echo $_SESSION['name']."<br>";
    echo $_SESSION['surname']."<br>";
    $email = $_SESSIOn['mail'];
    $domain = substr($email, strpos($email, '@') + 1);
      if($domain == 'student.arteveldehs.be')
        $functie = "student";
        else {
          $functie = "Medewerker";
        }
    echo $functie;
    ?>
    <hmtl>
    <body>
    <form action="https://www.arteveldehogeschool.be/azuredirectory/1/logout.php" method="get">
    <button type="submit" value="Submit">Uitloggen</button>
    </form>
    <?php
    // Let them access the "logged in only" pages
    // Redirect them to the login page
  } else { echo $_SESSION['mail']?>
    <form action="https://www.arteveldehogeschool.be/azuredirectory/1/azurelogin.php" method="get">
    <button type="submit" value="Submit">Log in met Azure AD</button>
    </form>
    </body>
    </html>
    <?php
     }
		?>
