<?php

include_once("config.php");


/**
 * Basic routing 
 */
if(isset($_REQUEST['page'])){
    if(file_exists("pages/".$_REQUEST['page'].".php")){
        include("pages/".$_REQUEST['page'].".php");
    }else{
        echo "404 page";
    }
}else{
    if(file_exists("pages/".DEFAULT_ROUTE_PAGE.".php")){
        include("pages/".DEFAULT_ROUTE_PAGE.".php");
    }else{
        echo "404 page";
    }
}
