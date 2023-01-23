<?php

require_once "Verbes.php";

$mysql = mysqli_connect("localhost", "root", "", "ajax", "3306");

if (!$mysql){
    die("Impossible de se co");
}

$lettre = $_GET['lettre'];

$result = $mysql->query("SELECT * FROM verbes WHERE libelle LIKE '$lettre%'");

$rows = $result->fetch_all(MYSQLI_ASSOC);
$tab = array();
foreach ($rows as $unVerbe) {
    $obj = new Verbes($unVerbe["id"], $unVerbe["libelle"]);
    var_dump($obj);
    $tab[] = $obj;
}


echo json_encode($tab);
