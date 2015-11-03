<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Home</title>
    </head>
    <body>
        <?php
            include_once("shell.php");
            session_start();    //start $_SESSION
            Authentication::processLogin();     //process login form if submitted
            $nav = new Navigation_Menu();
            $nav->processControlMenu(); //process nav if submitted
            
            /******TEST CODE*******/
            if(!empty($_GET['page'])) {
                    echo Lights::getForm();
            }

            if(!empty($_POST['lights'])) {
                    echo Lights::processPost();
            }
            /******TEST CODE******/
            
            /***Add new User temp code***/
            if(isset($_GET['username'])){
                Authentication::createNewUser();
            }
            if(Authentication::isAuthenticated()){
                //echo page
                $nav->displayMenu();
                
            }else{
                echo Authentication::getForm();
            }
        ?>
    </body>
</html>