<?php
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Models\CurriculumModel;

$curriculumModel = new CurriculumModel();

$result = $curriculumModel->schoolLevels( ($_POST['cid'] ?? 0) );



if($result === false){
    echo "false";
}else{
    if(count($result) > 0){
            echo "<option value=''>Please Select Level</option>";
        foreach($result as $r){
            echo "<option value='".$r['level_id']."' >".$r['level_name']."</option>";
        }
    }
}

