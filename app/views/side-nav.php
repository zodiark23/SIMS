<div class="side-nav">
    <div class="admin">
        <img src="<?=BASE_URL?>/img/reyan.jpg" alt="" class="adm-img">
        <span class="adm-name">Reyan Tropia <i class="fas fa-user-secret"></i></i></span>
    </div>

    <div class="nav-list">
        <ul class="parent-ul">
            <li class="parent-li">
                <a href="javascript:void(0);">Admin</a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/education">Education Settings</a></li>
                    <li class="roles"><a href="<?=BASE_URL?>/admin/roles">Roles</a></li>
                    <!-- <li><a href="">Privileges</a></li> -->
                    <li><a href="">Master List</a></li>
                    <li><a href="<?=BASE_URL?>/admin/news">News &amp; Announcements</a></li>
                    <!-- <li><a href="">Management</a></li> -->
                    <!-- <li><a href="">Payments</a></li> -->
                    <li><a href="">Approvals</a></li>
                    <li><a href="">Parental Tools</a></li>
                </ul>
            </li>
            <li class="parent-li">
                <a href="javascript:void(0);">Students <span class="count">1000</span></a>
                <ul class="child-ul">
                    <li><a href="">Overview</a></li>
                    <li><a href="">Create New</a></li>
                    <li><a href="">Manage Student</a></li>
                    <li><a href="">Academic Status</a></li>
                </ul>
            </li>
            <li class="parent-li">
                <a href="javascript:void(0);">Teachers <span class="count"><?= ($this->side_nav_data['teacherCount'] ?? 0)?></span></a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/overview-teacher">Overview</a></li>
                    <li><a href="<?=BASE_URL?>/admin/create-teacher">Add Teacher</a></li>
                    <li><a href="">Grade Management</a></li>
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
            <li class="parent-li">
                <a href="javascript:void(0);">Schedules <span class="count">5</span></a>
                <ul class="child-ul">
                    <li><a href="">View Schedules</a></li>
                    <li><a href="">My Schedule</a></li>
                    <li><a href="<?=BASE_URL?>/admin/manage-schedule">Manage Schedule</a></li>
                </ul>
            </li>
            <li class="parent-li">
                <a href="javascript:void(0);">Subjects <span class="count">5</span></a>
                <ul class="child-ul">
                    <li><a href="">Overview</a></li>
                    <li><a href="<?=BASE_URL?>/admin/subject-list">Lists</a></li>
                    <li><a href="<?=BASE_URL?>/admin/create-subject">Manage Subjects</a></li>
                </ul>
            </li>
            <li class="parent-li">
                <a href="javascript:void(0);">Sections <span class="count">5</span></a>
                <ul class="child-ul">
                    <li><a href="<?=BASE_URL?>/admin/section-list">Section List</a></li>
                    <li><a href="<?=BASE_URL?>/admin/add-section">Add Section</a></li>
                    <li><a href="">Change Advisor</a></li>
                </ul>
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
