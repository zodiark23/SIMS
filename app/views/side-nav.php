<div class="side-nav">
    <div class="admin">
    <?php

    $imgSrc = isset($_SESSION['full_path']) && !empty($_SESSION['full_path']) ? BASE_URL.$_SESSION['full_path'] : BASE_URL."/img/default.png";
    ?>
        <img src="<?=$imgSrc?>" alt="" class="adm-img">
        <span class="adm-name"><?= $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'] ?> <i class="fas fa-user-secret"></i></i></span>
    </div>
<?php
$adminPointer = "";
if($this->pointer == "master_list" ||$this->pointer == "approval" || $this->pointer == "create_education" || $this->pointer == "add_news" || $this->pointer == "level_configuration" || $this->pointer == "grade_schemes" || $this->pointer == "edit_grade_scheme" || $this->pointer == "add_grade_scheme" || $this->pointer == "edit_education" || $this->pointer == "show_education" || $this->pointer == "manage_roles" || $this->pointer == "roles" || $this->pointer == "education" || $this->pointer == "news" || $this->pointer == "grades_scheme"){
    $adminPointer = "active";
}

$teacherPointer = "";
if($this->pointer == "create_teacher" || $this->pointer == "overview_teacher" || $this->pointer == "my_students"){
    $teacherPointer = "active";
}

$studentPointer = "";
if($this->pointer == "enroll_student" || $this->pointer == "student_overview"){
    $studentPointer = "active";
}

$schedulePointer = "";
if($this->pointer == "manage_schedule" || $this->pointer == "schedule"){
    $schedulePointer = "active";
}

$subjectPointer = "";
if($this->pointer == "subject_list" || $this->pointer == "edit_subject"  || $this->pointer == "create_subject" ){
    $subjectPointer = "active";
}
$sectionPointer = "";
if($this->pointer == "section_list" || $this->pointer == "add_section"){

    $sectionPointer = "active";
}
use SIMS\App\Models\RoleModel;
$rightsModel = new RoleModel();

$adminCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("ADD_NEWS") || $rightsModel->verifyRights("APPROVE_STUDENT") || $rightsModel->verifyRights("MANAGE_GRADE_SCHEME")){
    $educationRights = true;
    $rolesRights = true;
    $masterListRights = true;
    $newsRights = true;
    $approvalRights = true;
    $gradeSchemeRights = true;
    $adminCounter++;
}

$studentCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("MANAGE_STUDENT") ){
    $overviewRights = true;
    $studentCounter++;
}

$teacherCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("VIEW_TEACHER") || $rightsModel->verifyRights("ADD_TEACHER") || $rightsModel->verifyRights("VIEW_STUDENT") || $rightsModel->verifyRights("MANAGE_GRADES")){
    $overviewTeacherRights = true;
    $createTeacherRights = true;
    $myStudentsRights = true;
    $gradeManagementRights = true;
    $teacherCounter++;
}

$scheduleCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("MANAGE_SCHEDULE")){
    $manageScheduleRights = true;
    $scheduleCounter++;
}

$subjectCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("VIEW_SUBJECT") || $rightsModel->verifyRights("ADD_SUBJECT")){
    $subjectListRights = true;
    $createSubjectRights = true;
    $subjectCounter++;
}

$sectionsCounter = 0;
if($rightsModel->verifyRights("ALL") || $rightsModel->verifyRights("VIEW_SECTION") || $rightsModel->verifyRights("ADD_SECTION")){
    $sectionListRights = true;
    $addSectionRights = true;
    $sectionsCounter++;
}
?>
    <div class="nav-list">
        <ul class="parent-ul">
            <li class="parent-li <?= $adminPointer ?>" style="<?= $adminCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Administration</a>
                <ul class="child-ul">
                    <li <?php if (empty($educationRights) ){?>style="display:"<?php } ?>><a href="<?=BASE_URL?>/admin/education">Education Settings</a></li>
                    <li <?php if (empty($rolesRights) ){?>style="display:"<?php } ?> class="roles"><a href="<?=BASE_URL?>/admin/roles">Roles</a></li>
                    <!-- <li><a href="">Privileges</a></li> -->
                    <li <?php if (empty($masterListRights) ){?>style="display:"<?php } ?> ><a href="<?= BASE_URL?>/admin/master-list">Master List</a></li>
                    <li <?php if (empty($newsRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/news">News &amp; Announcements</a></li>
                    <!-- <li><a href="">Management</a></li> -->
                    <!-- <li><a href="">Payments</a></li> -->
                    <li <?php if (empty($approvalRights) ){?>style="display:"<?php } ?>><a href="<?=BASE_URL?>/admin/approval">Approvals</a></li>
                    <li <?php if (empty($gradeSchemeRights) ){?>style="display:"<?php } ?>><a href="<?=BASE_URL?>/admin/grade-schemes">Grade Scheme</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $studentPointer ?>" style="<?= $studentCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Students <span class="count"><?=($this->side_nav_data['studentCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li <?php if (empty($overviewRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/student-overview">Overview</a></li>
                    <!-- <li><a href="">Create New</a></li> -->
                    <!-- <li><a href="">Manage Student</a></li> -->
                    <!-- <li><a href="">Academic Status</a></li> -->
                </ul>
            </li>
            <li class="parent-li <?= $teacherPointer ?>" style="<?= $teacherCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Teachers <span class="count"><?= ($this->side_nav_data['teacherCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li <?php if (empty($overviewTeacherRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/overview-teacher">Overview</a></li>
                    <li <?php if (empty($createTeacherRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/create-teacher">Add Teacher</a></li>
                    <?php
                        $teacher = $_SESSION['user']['teacher_id'] ?? null;
                        if(!empty($teacher) && $teacher > 1){
                        // prevent displaying on non teacher
                    ?>
                    <li <?php if (empty($myStudentsRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/account/my-students">My Students</a></li>
                        <?php }?>
                    <li <?php if (empty($gradeManagementRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/account/grade-management">Grade Management</a></li>
                </ul>
            </li>
            <!-- disabled for now not included in the system
            <li class="parent-li">
                <a href="javascript:void(0);">Accounting <span class="count">5</span></a>
                <ul class="child-ul">
                    <li><a href="">Payments</a></li>
                    <li><a href="">Balances</a></li>
                    <li><a href="">Accounting Logs</a></li>
                </ul>
            </li> -->
            <li class="parent-li <?= $schedulePointer?>" style="<?= $scheduleCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Schedules <span class="count"><?=($this->side_nav_data['scheduleCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <!-- <li><a href="">View Schedules</a></li> -->
                    <!-- <li><a href="">My Schedule</a></li> -->
                    <li <?php if (empty($manageScheduleRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/manage-schedule">Manage Schedule</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $subjectPointer?>" style="<?= $subjectCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Subjects <span class="count"><?=($this->side_nav_data['subjectCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <!-- <li><a href="">Overview</a></li> -->
                    <li <?php if (empty($subjectListRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/subject-list">Lists</a></li>
                    <li <?php if (empty($createSubjectRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/create-subject">Create Subjects</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $sectionPointer?>" style="<?= $sectionsCounter == 0 ? 'display:none' : ''?>">
                <a href="javascript:void(0);">Sections <span class="count"><?=($this->side_nav_data['sectionCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li <?php if (empty($sectionListRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/section-list">Section List</a></li>
                    <li <?php if (empty($addSectionRights) ){?>style="display:"<?php } ?> ><a href="<?=BASE_URL?>/admin/add-section">Add Section</a></li>
                    <!-- <li><a href="">Change Advisor</a></li> -->
                </ul>
            </li>


            <!-- Side nave dru -->
            <li class="parent-li">
                <a href="<?= BASE_URL ?>/account">My Profile</a>
            </li>
            <!-- ONLY VISIBLE ON STUDENT -->
            <?php if( !empty($_SESSION['user']['student_id']) ){ ?>
            <li class="parent-li">
                <a href="<?= BASE_URL ?>/account/my-grades">My Grades</a>
            </li>
            <?php } ?>
            <!-- <li class="parent-li">
                <a href="javascript:void(0);">Logs <span class="count">5</span></a>
                <ul class="child-ul">
                    <li><a href="">Grade Logs</a></li>
                    <li><a href="">Student Logs</a></li>
                    <li><a href="">Section Logs</a></li>
                    <li><a href="">Schedule Logs</a></li>
                    <li><a href="">Payment Logs</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
    <div class="admin-out">
        <a href="<?=BASE_URL?>/home/logout/">Logout</a>
    </div>
</div>

    <script>
            $(document).ready(function(){
                $(".parent-ul>li>a").on('click', function(){
                    if ($(this).parent().hasClass('active')) {
                        $(this).parent().removeClass('active');
                    } else {
                        $(".parent-ul>li").removeClass('active');
                        $(this).parent().toggleClass('active');
                    }

                });
            });
    </script>
