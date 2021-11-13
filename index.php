<?php

    require_once("Config/Config.php");
    require_once("Helpers/Helpers.php");
    
    $Link = !empty($_GET['link']) ? $_GET['link'] : 'home/home';
    $arrLink = explode('/',$Link);
    $controller = $arrLink[0];
    $method = $arrLink[0];
    $params = "";

    if(!empty($arrLink[1])){
        if($arrLink[1] != ""){
            $method = $arrLink[1];
        }
    }

    if(!empty($arrLink[2])){
        if($arrLink[2] != ""){
            for($i=2; $i < count($arrLink); $i++){
                $params .= $arrLink[$i].", ";
            }
        }
        $params = trim($params,", ");
        //echo $params;
    }  

    require_once("Libraries/Core/Autoload.php");
    require_once("Libraries/Core/Load.php");


    /*echo "<br>";
    echo "Controller: ".$controller;
    echo "<br>";
    echo "Method: ".$method;
    echo "<br>";
    echo "Params: ".$params;*/
    //echo "Controller: ".$controller." - Method: ".$method;

    //print_r($arrUrl);
?>