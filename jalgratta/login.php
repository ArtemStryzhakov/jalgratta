<?php
require_once("konf.php");
global $yhendus;
// login ja pass kontroll

if(isSet($_REQUEST["sisestusnupp"])) {
    if (!empty($_POST['login']) && !empty($_POST['pass'])) {
        if ($_POST['login'] == "admin" && $_POST['pass'] == "admin"){
            header("location: lubadeleht.php");
            $_SESSION["error"] = "";
            $_SESSION['login'] = "admin";
            $_SESSION['pass'] = "admin";
        }
        else{
            $_SESSION["error"] = "Login või Parool in vale";
            header("location: login.php");
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="intro">
    <div class="video">
        <video class="video_media" src="video/bikesilouhette.mp4" autoplay muted loop>
        </video>
    </div>

    <div class="intro_content">
        <div id="navigation">
            <img src="image/bike.png" alt="bike">
            <p style="font-size: 35px; margin-top: 10px; font-family: Comic Sans MS;">Jalgrattaeksam<p>
        </div>
        <div class="container">           
            <input type="checkbox" id="active">
            <label for="active" class="menu-btn"><span></span></label>
            <label for="active" class="close"></label>
            <div class="wrapper">
                <ul>
                    <?php if ($_SESSION['login'] == "admin" && $_SESSION['pass'] == "admin"){?>
                        <li><a href="teooriaeksam.php">teooriaeksam</a></li>
                        <li><a href="slaalom.php">Slaalom</a></li>
                        <li><a href="ringtee.php">Ringtee</a></li>
                        <li><a href="t2nav.php">Tänavasõit</a></li>
                        <li><a href="lubadeleht.php">Lõpetamine</a></li>
                    <?php }
                    else {?>
                        <li><a href="registreerimine.php">Registreerimine</a></li>
                        <li><a href="lubadeleht.php">Lõpetamine</a></li>
                    <?php }?>
                </ul>
            </div>
            <div id="register">
                <h1 style="text-align: center; padding-bottom: 15px;">Login sisse</h1>
                <strong><?= $_SESSION["error"] ?? ""; ?></strong>
                <form action="?" style="margin: auto; text-align: center;" method="post">
                    <dl>
                        <dt>Login:</dt>
                        <dd><input type="text" name="login" id="login"/></dd>
                        <dt>Parool:</dt>
                        <dd><input type="password" name="pass" id="pass"/></dd>
                        <dt><input type="submit" name="sisestusnupp" value="sisesta"/></dt>
                        <p>või <a href="registreerimine.php">registreerimine õpilase</a></p>
                    </dl>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>