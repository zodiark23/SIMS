<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Models\SectionModel;

$sectionModel = new SectionModel();

$result = $sectionModel->list(($_POST['cid'] ?? NULL));

if($result === false){
    echo "false";
}else{
    if(count($result) > 0){
            echo "<option value=''>Please Select Section</option>";
        foreach($result as $r){
            echo "<option value='".$r['section_id']."' >".$r['section_name']."</option>";
        }
    }
}
