<?php

/**
 * include php classes, css, js
 *
 * @author Brody
 */
error_reporting(E_ALL); 
ini_set('display_errors', '1');

getIncludes();

//dont echo if an ajax call
if(!isset($_POST['AJAX'])){
    echoJavaScript();
    echoCSS();
    displayHeader();
}

//php includes
function getIncludes(){
    include_once("php/database.class.php");
    include_once("php/authentication.class.php");
    include_once("php/appliance.class.php");
    include_once("php/lightbulb.class.php");
    include_once("php/lock.class.php");
    include_once("php/user.class.php");
    include_once("php/lights.class.php");  //test class
    include_once("php/navigation_menu.class.php");
    include_once("php/thermostat.class.php");
    include_once("php/lightGroup.class.php");
}

//echo JS files
function echoJavaScript(){
    echo "<script src='js/jquery-2.1.4.min.js'></script>";
    echo "<script src='js/ajax.js'></script>";
    echo "<script src='js/thermostat.js'></script>";
    echo "<script src='js/rest_api.js'></script>";
}

//echo css files
function echoCSS(){
    echo "<link rel='stylesheet' href='css/index.css' type='text/css'>";
    echo "<link rel='stylesheet' href='css/thermostat.css' type='text/css'>";
}

//$db = new Database();

/**
 * displays info for server
 */
function displayServerInfo(){
    
    echo $_SERVER['SERVER_NAME'];
    foreach($_SERVER as $key => $value){
        echo $key . " : " . $value . "<br>";
    }

}

function displayHeader(){
    $img = "<img src='images/home.png'>";
    $class = 'header';
    $onclick = "window.location.href=\"/\";";
    $div = "<div class=$class onclick='$onclick'>$img<h3>DeepIn SmartHome<sup>&copy</sup></h3></div>";
    echo $div;
}
