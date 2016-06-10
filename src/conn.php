<?php
require_once 'config.php';
$conn = new mysqli($servername,$username,$password,$baseName);

if($conn->connect_error){
    die("Polaczenie nieudane. Blad: ".$conn->connect_error);
}

