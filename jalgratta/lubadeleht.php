<?php
global $yhendus;
require_once("konf.php");
if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus, 
	     slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus,
    $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();

function asenda($nr){
    if($nr==-1){return ".";} //tegemata
    if($nr== 1){return "korras";}
    if($nr== 2){return "ebaõnnestunud";}
    return "Tundmatu number";
}
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
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
                <div class="main">
                    <h1 style="text-align: center; padding-bottom: 15px;">Lõpetamine</h1>
                    <table id="customers">
                        <tr style="font-size: 20px">
                            <th>Eesnimi</th>
                            <th>Perekonnanimi</th>
                            <th>Teooriaeksam</th>
                            <th>Slaalom</th>
                            <th>Ringtee</th>
                            <th>Tänavasõit</th>
                            <th>Lubade väljastus</th>
                        </tr>
                        <?php
                        while($kask->fetch()){
                            $asendatud_slaalom=asenda($slaalom);
                            $asendatud_ringtee=asenda($ringtee);
                            $asendatud_t2nav=asenda($t2nav);
                            $loalahter=".";
                            if($luba==1){$loalahter="Väljastatud";}
                            if($luba==-1 and $t2nav==1){
                                $loalahter="<a href='?vormistamine_id=$id'>Vormista load</a>";
                            }
                            echo "
                         <tr>
                           <td>$eesnimi</td>
                           <td>$perekonnanimi</td>
                           <td>$teooriatulemus</td>
                           <td>$asendatud_slaalom</td>
                           <td>$asendatud_ringtee</td>
                           <td>$asendatud_t2nav</td>
                           <td>$loalahter</td>
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


