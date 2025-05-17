<?php
function route(){
    $path = $_SERVER['REQUEST_URI'];
    if(isAdminsTableEmpty()){
        regis();
    }elseif($path == "/index.php" || $path == "/"){
        showhome();
    }elseif($path == "/login"){
loginform();
    }elseif(isset($_POST['username']) && isset($_POST['login'])){
        validate($_POST['username'], $_POST['password']);
    }elseif(isset($_POST['username']) && isset($_POST['register'])){
        if(isAdminsTableEmpty()){
            registeradmin($_POST['username'], $_POST['password']);
        }else{
            loginform();
        }
    }else{
        showhome();
    }
}