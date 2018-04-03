<div class="side-nav">
    <div class="admin">
        <img src="<?= BASE_URL ?><?php echo $_SESSION['full_path'] ?>" alt="" class="adm-img">
        <span class="adm-name"><?= $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'] ?> <i class="fas fa-user-secret"></i></i></span>
    </div>
<?php
$adminPointer = "";
if($this->pointer == "approval" || $this->pointer == "create_education" || $this->pointer == "add_news" || $this->pointer == "level_configuration" || $this->pointer == "grade_schemes" || $this->pointer == "edit_grade_scheme" || $this->pointer == "add_grade_scheme" || $this->pointer == "edit_education" || $this->pointer == "show_education" || $this->pointer == "manage_roles" || $this->pointer == "roles" || $this->pointer == "education" || $this->pointer == "news" || $this->pointer == "grades_scheme"){
    $adminPointer = "active";
}

$teacherPointer = "";
if($this->pointer == "create_teacher" || $this->pointer == "overview_teacher" || $this->pointer == "my_students"){
    $teacherPointer = "active";
}

$studentPointer = "";
if($this->pointer == "enroll_student"){
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

?>
    <div class="nav-list">
        <ul class="parent-ul">
            <li class="parent-li <?= $adminPointer ?>">
                <a href="javascript:void(0);">Administration</a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/education">Education Settings</a></li>
                    <li class="roles"><a href="<?=BASE_URL?>/admin/roles">Roles</a></li>
                    <!-- <li><a href="">Privileges</a></li> -->
                    <li><a href="">Master List</a></li>
                    <li><a href="<?=BASE_URL?>/admin/news">News &amp; Announcements</a></li>
                    <!-- <li><a href="">Management</a></li> -->
                    <!-- <li><a href="">Payments</a></li> -->
                    <li><a href="<?=BASE_URL?>/admin/approval">Approvals</a></li>
                    <li><a href="<?=BASE_URL?>/admin/grade-schemes">Grade Scheme</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $studentPointer ?>">
                <a href="javascript:void(0);">Students <span class="count"><?=($this->side_nav_data['studentCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/student-overview">Overview</a></li>
                    <!-- <li><a href="">Create New</a></li> -->
                    <!-- <li><a href="">Manage Student</a></li> -->
                    <li><a href="">Academic Status</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $teacherPointer ?>">
                <a href="javascript:void(0);">Teachers <span class="count"><?= ($this->side_nav_data['teacherCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/overview-teacher">Overview</a></li>
                    <li><a href="<?=BASE_URL?>/admin/create-teacher">Add Teacher</a></li>
                    <?php 
                        $teacher = $_SESSION['user']['teacher_id'] ?? null;
                        if(!empty($teacher) && $teacher > 1){
                        // prevent displaying on non teacher
                    ?>
                    <li><a href="<?=BASE_URL?>/account/my-students">My Students</a></li>
                        <?php }?>
                    <li><a href="<?=BASE_URL?>/account/grade-management">Grade Management</a></li>
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
            <li class="parent-li <?= $schedulePointer?>">
                <a href="javascript:void(0);">Schedules <span class="count"><?=($this->side_nav_data['scheduleCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <!-- <li><a href="">View Schedules</a></li> -->
                    <!-- <li><a href="">My Schedule</a></li> -->
                    <li><a href="<?=BASE_URL?>/admin/manage-schedule">Manage Schedule</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $subjectPointer?>">
                <a href="javascript:void(0);">Subjects <span class="count"><?=($this->side_nav_data['subjectCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <!-- <li><a href="">Overview</a></li> -->
                    <li><a href="<?=BASE_URL?>/admin/subject-list">Lists</a></li>
                    <li><a href="<?=BASE_URL?>/admin/create-subject">Create Subjects</a></li>
                </ul>
            </li>
            <li class="parent-li <?= $sectionPointer?>">
                <a href="javascript:void(0);">Sections <span class="count"><?=($this->side_nav_data['sectionCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/section-list">Section List</a></li>
                    <li><a href="<?=BASE_URL?>/admin/add-section">Add Section</a></li>
                    <!-- <li><a href="">Change Advisor</a></li> -->
                </ul>
            </li>


            <!-- Side nave dru -->
            <li class="parent-li">
                <a href="<?= BASE_URL ?>/account/profile">My Profile</a>
            </li>
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
