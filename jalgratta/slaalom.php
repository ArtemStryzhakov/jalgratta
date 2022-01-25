<?php
global $yhendus;
require_once("konf.php");
if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=2 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vigane_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus>=9 AND slaalom=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Slaalom</title>
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
                    <li><a href="registreerimine.php">Registreerimine</a></li>
                    <li><a href="teooriaeksam.php">teooriaeksam</a></li>
                    <li><a href="slaalom.php">Slaalom</a></li>
                    <li><a href="ringtee.php">Ringtee</a></li>
                    <li><a href="t2nav.php">Tänavasõit</a></li>
                    <li><a href="lubadeleht.php">Lõpetamine</a></li>
                </ul>
            </div>
            <div class="main">
                <h1 style="text-align: center; padding-bottom: 15px;">Slaalom</h1>
                <table>
                    <?php
                    while($kask->fetch()){
                        echo "
                            <tr>
                            <td>$eesnimi</td>
                            <td>$perekonnanimi</td>
                            <td>
                                <a href='?korras_id=$id'>Korras</a>
                                <a href='?vigane_id=$id'>Ebaõnnestunud</a>
                            </td>
                            </tr>
                        ";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

