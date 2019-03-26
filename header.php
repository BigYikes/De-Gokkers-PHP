<?php
    require 'config.php';
?>

<!-- Even heel easy html code, omdat de focus nu op het inlogsysteem ligt en niet op fancy looks :)  -->
<html>
<head>
    <style>
        nav {
            display: flex;
        }
        .container{
            font-family: Verdana;
        }
        .menu a{
            font-size: 18px;
            color: white;
            text-decoration: none;
            margin-right: 10px;
        }
        .header{
            background-color: black;
            width: 100%;
        }
        .login a{
            float: right;
            font-size: 18px;
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>



</head>
<body>
<header>
    <nav>
        <div class="header">
            <div class="container">
                <div class="menu">
                    <a href="index.php">Home</a>
                    <a href="download.php">Download</a>
                    <a href="about.php">What is De Gokkers?</a>
                </div>
            </div>

            <div class="login">
        <?php
        /*
         * Hier checken we of we al ooit eens een 'id' key hebben opgeslagen in de
         * $_SESSION variabele. de ENIGE plek waar we dit doen is als we onszelf inloggen
         * en onze gegevens kloppen. Kijk maar in de logincontroller.php
         *
         * Als we dus al een id in onze session hebben (dus onze klant is al ingelogd) willen we niet dat onze
         * klanten zich nogmaals kunnen registreren of inloggen...
         *
         */
        if ( isset($_SESSION['id']) ) {
            echo "You are currently logged in. Want to <a href='register.php'>logout?</a>";
        } else {
            echo "<a href='register.php'> Register </a> &nbsp; or &nbsp; <a href='login.php'>Login</a> ";
        }
        ?>
            </div>
        </div>
    </nav>
</header>