<?php
require 'config.php';
/*
 * Dit is een webserver only script, waar je alleen mag komen als je via een form
 * data verstuurd, en niet als je via de url hier naar toe komt. Iedereen die dat doet
 * sturen we terug naar index.php
 *
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    header('location: index.php');
    exit;
}

if ( $_POST['type'] === 'login' ) {
    /*
     * Hier komen we als we de login form data versturen.
     * things to do:
     * 1. Checken of gebruikersnaam EN email in de database bestaat met de ingevoerde data
     * 2. Indien ja, een $_SESSION['id'] vullen met de id van de persoon die probeert in te loggen.
     * 3. gebruiker doorsturen naar de admin pagina
     *
     * 3. Indien nee, gebruiker terugsturen naar de login pagina met de melding dat gebruikersnaam en/of
     * wachtwoord niet in orde is.
     *
     */
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //Retrieve the user account information for the given username.
    $sql = "SELECT id, username, password FROM login  WHERE username = :username";
    $stmt = $db->prepare($sql);

    //Bind the value.
    $stmt->bindValue(':username', $username);

    $stmt->execute();

    //Fetch the row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if($user === false){

        //Could not find a user with that username.
        die('Incorrect username / password combination!');
    } else{

        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){

            //Provide the user with a login session.
            $_SESSION['id'] = $user['id'];
            $_SESSION['logged_in'] = time();

            //Redirect to index.php
            header('Location: index.php');
            exit;

        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
}

if ($_POST['type'] === 'register') {
    /*
     * Hier komen we als we de register form data versturen
     * things to do:
     *
     * 1. Checken of er al iemand met dit emailadres of username bestaat
     * 2. Indien nee, eerst checken of de password en password_confirm inderdaad hetzelfde ingevoerde is.
     * 3. Dan gebruiker inserten in de database, zodat deze kan gaan inloggen.
     * 4. Gebruiker doorsturen naar de nieuwe inlog pagina.
     *
     * 5. Indien ja, gebruiker terugsturen naar register form met de melding dat gebruikersnaam en/of wachtworod niet op
     * orde is.
     *
     *
     */

    $username = $_POST['username'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['password'];
    $wachtwoord_confirm = $_POST['password_confirm'];

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }

    if (isset($_POST['submit'])) {

        try {
            $stmt = $conn->prepare('SELECT email FROM login WHERE email = ?');
            $stmt->bindParam(1, $_POST['email']);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if ($stmt->rowCount() > 0) {
            echo "Email exists already";
        } else {
            echo "email doesn't exist yet";
        }


    }
    if (isset($_POST['submit'])) {

        try {
            $stmt = $conn->prepare('SELECT username FROM login WHERE username = ?');
            $stmt->bindParam(1, $_POST['username']);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            }
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        if ($stmt->rowCount() > 0) {
            echo "username exists already";
        } else {
            echo "username doesn't exist yet";
        }

    }

    if (trim($_POST['password']) == '' || trim($_POST['password_confirm']) == '') {
        echo('All fields are required!');
    } else if ($_POST['password'] != $_POST['password_confirm']) {
        echo('Passwords do not match!');
    } else if ($_POST['password'] == $_POST['password_confirm']) {
        $errors = array();
        if (strlen($wachtwoord) < 7 || strlen($wachtwoord) > 16) {
            $errors[] = "Password should be min 7 characters and max 16 characters";
        }
        if (!preg_match("/\d/", $wachtwoord)) {
            $errors[] = "Password should contain at least one digit";
        }
        if (!preg_match("/[A-Z]/", $wachtwoord)) {
            $errors[] = "Password should contain at least one Capital Letter";
        }
        if (!preg_match("/[a-z]/", $wachtwoord)) {
            $errors[] = "Password should contain at least one small Letter";
        }

        if ($errors) {
            foreach ($errors as $error) {
                echo $error . "\n";
            }
            die();
        } else {
            header('location: login.php');
        }
        if(empty($_POST['agree']) || $_POST['agree'] != 'agree') {
            echo 'Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy';
        }
        else {


            $passwordHash = password_hash($wachtwoord, PASSWORD_BCRYPT, array("cost" => 12));

            $sql = "INSERT INTO login (username, email, password) 
                     VALUES (:username, :email, :password)";
            $prepare = $db->prepare($sql);
            $prepare->execute([
                ':email' => $email,
                ':username' => $username,
                ':password' => $passwordHash
            ]);
        }
    }
}
    exit;





