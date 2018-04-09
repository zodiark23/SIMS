<?php

require 'vendor/autoload.php';
use SIMS\Classes\Database;
use SIMS\App\Models\StudentModel;
use SIMS\App\Models\CurriculumModel;
use SIMS\App\Models\SectionModel;
use Mpdf\Mpdf;

$db = new Database();
$studentModel = new StudentModel();
$currModel = new CurriculumModel();
$sectionModel = new SectionModel();
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);


ob_start();
?>
<style>
		@page {
			margin-left: 0.5cm;
			margin-right: 0.5cm;
			margin-top:1cm;
		}
</style>
<style>
    .clean {
        width: 100%;
        border-collapse:collapse;
    }

    .clean tr th{
        padding:3px;
    }
    .clean tr td,.clean tr th{
        border:1px solid #555;
    }
</style>
<table class='clean'>
    <tr>
        <th>#</th>
        <th>Student Name</th>
        <th>Section</th>
        <th>Level</th>
        <th>Status</th>
    </tr>

    <?php

    $uri = explode('?',$_SERVER['REQUEST_URI']);
    $string = ($uri[1]) ?? '';
    parse_str($string, $fakePost);
    $curr = $fakePost['curr'] ?? '';
    $level = $fakePost['level'] ?? '';

    //build the dynamic query;
    $where = '';
    $whereArray = [];
    if(!empty($curr) && empty($level_)){
        //get the levels of this curriculum
        $query = $db->prepare("SELECT * FROM `school_levels` WHERE curriculum_id = :curr_id");
        $query->execute(['curr_id' => $curr]);
        $pendingLevels = $query->fetchAll(\PDO::FETCH_OBJ);

        if($pendingLevels){
            $levelsArray = [];
            foreach($pendingLevels as $level_){
                $levelsArray[] = "level_id=".$level_->level_id;
            }

            if(count($levelsArray) > 0){
                $whereArray[] = "(".implode(" OR ", $levelsArray).")";
            }
        }
    }

   
    
        if(count($whereArray) > 0){
            $where = "WHERE ".implode(" AND " , $whereArray);
        }

        if(!empty($level)){
            $where = "WHERE level_id = $level";
        }

        $stmt = $db->prepare("SELECT * FROM `student_educational` $where");
        $stmt->execute();


        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            $count = 1;
            foreach($result as $r){
                $studentInfo = $studentModel->studentInfo($r->student_id ?? 0);
                $sectionInfo = $sectionModel->info($r->section_id ?? 0);
                $currInfo  = $currModel->schoolLevelInfo($r->level_id ?? 0);
                echo "<tr>

                    <td>$count</td>
                    <td>".($studentInfo->first_name ?? ''). " ". ($studentInfo->middle_name ?? '')." ". ($studentInfo->last_name ?? '')."</td>
                    <td><center>".($sectionInfo['section_name'] ?? '')."</center></td>
                    <td><center>".($currInfo['level_name'] ?? '')."</center></td>
                    <td><center>".($r->status ?? '')."</center></td>
                </tr>
                ";
                $count++;
            }
        }
    
    

    ?>

    <?php if(!$result){ ?>
    <tr>
        <td colspan="5"><center>No data</center></td>
    </tr>

    <?php } ?>
 
</table>
<?php if($result){
echo "<br>";
echo "<span style='font-size:13'>Date Generated : ".date("Y-m-d")."</span>"; 
echo "<br>";
echo "<span style='font-size:13'>Total Students : $count</span>";
}
?>




<?php
$html  = ob_get_contents();
ob_clean();
try{

	$mpdf->WriteHTML($html);
	$mpdf->Output();
}catch(\Mpdf\MpdfException $e){
	echo $e->getMessage();
}
?>