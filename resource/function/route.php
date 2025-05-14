<?php
function route(){
    $path = $_SERVER['REQUEST_URI'];
    if($path = "/index.php" || $path == "/"){
        showhome();
    } 
}
route();