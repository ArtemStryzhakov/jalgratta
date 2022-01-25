<?php
global $yhendus;
require_once("konf.php");
if(isSet($_REQUEST["sisestusnupp"])){
    $kask=$yhendus->prepare("INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
    $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
    $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
    exit();  
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
                    <?php if ($_POST['login'] == "admin" && $_POST['pass'] == "admin"){?>
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
                <h1 style="text-align: center; padding-bottom: 15px;">Registreerimine</h1>
                <?php
                if(isSet($_REQUEST["lisatudeesnimi"])){
                    echo "Lisati $_REQUEST[lisatudeesnimi]";
                }
                ?>
                <form action="?" style="margin: auto; text-align: center;">
                    <dl>
                        <dt>Eesnimi:</dt>
                        <dd><input type="text" name="eesnimi" /></dd>
                        <dt>Perekonnanimi:</dt>
                        <dd><input type="text" name="perekonnanimi" /></dd>
                        <dt><input type="submit" name="sisestusnupp" value="sisesta"/></dt>
                        <p>või <a href="login.php">Logi sisse</a></p>
                    </dl>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


