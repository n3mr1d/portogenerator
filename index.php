<?php 
// config db
define("DBHOST","localhost");
define("DBNAME","porto");
define("DBPASS","180406");
define("DBUSER","root");
// autoload config
require_once __DIR__ . '/autoload.php';
/**
 * print start function
 * 
 * @param string $css,$title,$js
 */


function print_start(string $title, string $css=""){
  echo'  <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Portofolio | ' . $title .'</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
        ';
     
   
    if(empty($css)){
        echo'<link rel="stylesheet" href="/resource/style/global.css">';
        echo'<link rel="stylesheet" href="/font/fontawesome-free-6.7.2-web/css/all.min.css">'; 
    }else{
        echo'<link rel="stylesheet" href="/font/fontawesome-free-6.7.2-web/css/all.min.css">'; 
        echo'<link rel="stylesheet" href="/resource/style/global.css">';
        echo'<link rel="stylesheet" href="/resource/style/' . $css . '.css">'; 
    }
echo'</head>
    <body>';
    navbar();

}
function jsallow(string $name){
        echo'<script src="/resource/script/'. $name .'.js"></script>';
}
function showhome(){
  
    print_start('home','home');
echo<<<HTML
<div class="kontainer-hero">
<div class="kontainer-text">
<h3 id="autotext1"></h3>
<div class="kontainer-subtitle">
<span class="subtitle">Hello User Im N3mraid</span>
<span class="subtitle"> Welcome To My Space</span>
</div>
</div> 

</div>
HTML;
    jsallow('home');
    endhtml();
}

function endhtml(){
    echo'</body></html>';
}
