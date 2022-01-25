<?php
$baasiaadress="localhost";
$baasikasutaja="artemstryz";
$baasiparool="123456";
$baasinimi="artemstryz";
$yhendus=new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
session_start();
