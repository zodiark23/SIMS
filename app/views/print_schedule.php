<?php

require 'vendor/autoload.php';
use SIMS\Classes\Database;
use SIMS\App\Models\StudentModel;
use SIMS\App\Models\CurriculumModel;
use SIMS\App\Models\SectionModel;
use SIMS\App\Models\ScheduleModel;
use SIMS\App\Models\SubjectModel;
use SIMS\App\Models\TeacherModel;
use Mpdf\Mpdf;

$db = new Database();
$studentModel = new StudentModel();
$currModel = new CurriculumModel();
$sectionModel = new SectionModel();
$scheduleModel = new ScheduleModel();
$subjectModel = new SubjectModel();
$teacherModel = new TeacherModel();
$mpdf = new \Mpdf\Mpdf(['format' => 'Legal-L']);


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
        padding:10px 3px;
    }
    .clean tr td,.clean tr th{
        border:1px solid #555;
    }

    .no-border-table{
        width:100%;
    }
    .no-border-table th{
        border: none;
    }
</style>



<?php
$schedules = $scheduleModel->scheduleBuilder($this->schedule_id);
$teacherList = $teacherModel->list();

if(!empty($schedules['body']) && count($schedules['body']) > 0 ){

    $count = 0;
    foreach($schedules['sections'] as $key => $section){
        $section_name = "";

        $sectionInfo = $sectionModel->info((int)$section);
        $section_name = $sectionInfo['section_name'] ?? 'err#';

        echo "<table class='no-border-table'>
        <tr>
        <th class='no-border' style='padding:43px 3px;'> $section_name Schedule</th>
        </tr>
        </table>
        ";
        echo "<table class='clean'>
        <tr>
        <th><center>Time</center></th>
        <th><center>Subject</center></th>
        <th><center>Days</center></th>
        <th><center>Teacher</center></th>
        </tr>";
        foreach($schedules['body'] as $schedule){
            if($schedule['section'] == $section){
                $subject_name = "";
                $teacher_name = "";

                $subjectInfo = $subjectModel->info($schedule['subject']);
                $subject_name = $subjectInfo[0]['subject_name'] ?? 'err#';

                foreach($teacherList as $teacher){
                    if($teacher['teacher_id'] == $schedule['teacher']){
                        $teacher_name = ($teacher['first_name'] ?? 'err#')." ".($teacher['middle_name'] ?? 'err#')." ".($teacher['last_name'] ?? 'err#');
                        break;
                    }
                }
                
                echo "<tr>
                <td width='20%'><center>".$schedule['start_time']." - ".$schedule['start_time']."</center></td>
                <td><center>".$subject_name."</center></td>
                <td><center>".($schedule['days'] ?? '')."</center></td>
                <td><center>".$teacher_name."</center></td>
                
                </tr>";
            }
        }
        
        echo "</table>";

        $html  = ob_get_contents();
        ob_clean();
        $mpdf->WriteHTML($html);

        // Prevent adding new page if there's no section
        if( ($count + 1) < count($schedules['sections']) ){
            $count++;
            $mpdf->AddPage();
        }

    }
}


?>








<?php
$html  = ob_get_contents();
ob_clean();
try{

    
	$mpdf->Output();
}catch(\Mpdf\MpdfException $e){
	echo $e->getMessage();
}
?>