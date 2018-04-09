-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2018 at 08:29 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims`
--

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `curriculum_id` int(5) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_duration` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enum_table`
--

CREATE TABLE `enum_table` (
  `enum_id` int(4) NOT NULL,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enum_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enum_table`
--

INSERT INTO `enum_table` (`enum_id`, `field`, `enum_value`) VALUES
(1, 'gender', 'male'),
(2, 'gender', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `section_id` int(6) NOT NULL,
  `student_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `grade` int(3) NOT NULL,
  `created_date` DATETIME NOT NULL,
  `modified_date` DATETIME NOT NULL,
  `flags` int(10) NOT NULL,
  `result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_scheme`
--

CREATE TABLE `grade_scheme` (
  `grade_scheme_id` int(10) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_implemented` datetime NOT NULL,
  `published` int(1) NOT NULL,
  `pass_threshold` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_scheme_item_id`
--

CREATE TABLE `grade_scheme_item_id` (
  `grade_scheme_item_id` int(10) NOT NULL,
  `grade_scheme_id` int(10) NOT NULL,
  `school_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `time_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parents_id` int(10) NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `contact_number` text NOT NULL,
  `create_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `gender` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `role_id` int(5) DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parents_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `contact_number`, `create_date`, `last_updated`, `gender`, `status`, `role_id`) VALUES
(1, 'amos', 'rhagel', 'reyes', 'amos@test.com', 'easy1234', '09121231234', '2018-03-05 08:39:36', '2018-03-05 08:39:36', 1, 1, 4),
(2, 'christian', 'robert', 'salenga', 'christian@test.com', 'easy1234', '09121231234', '2018-03-05 08:39:36', '2018-03-05 08:39:36', 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(10) NOT NULL,
  `payment_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_line`
--

CREATE TABLE `payment_line` (
  `payment_line_id` int(10) NOT NULL,
  `payment_date` datetime NOT NULL,
  `amount_paid` int(10) NOT NULL,
  `isPaid` int(1) NOT NULL,
  `student_id` int(10) NOT NULL,
  `payment_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `rights_id` int(8) NOT NULL,
  `rights_code` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`rights_id`, `rights_code`) VALUES
(1, 'ALL'),
(2, 'ADD_STUDENT'),
(3, 'EDIT_STUDENT'),
(4, 'DELETE_STUDENT'),
(5, 'VIEW_STUDENT'),
(6, 'ADD_GRADE'),
(7, 'EDIT_GRADE'),
(8, 'DELETE_GRADE'),
(9, 'VIEW_GRADE'),
(10, 'ADD_SUBJECT'),
(11, 'EDIT_SUBJECT'),
(12, 'DELETE_SUBJECT'),
(13, 'VIEW_SUBJECT'),
(14, 'ADD_TEACHER'),
(15, 'EDIT_TEACHER'),
(16, 'DELETE_TEACHER'),
(17, 'VIEW_TEACHER'),
(18, 'VIEW_SECTION'),
(19, 'ADD_SECTION'),
(20, 'EDIT_SECTION'),
(21, 'ADD_SCHEDULE'),
(22, 'MANAGE_SCHEDULE'),
(23, 'MANAGE_STUDENT');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(6) NOT NULL,
  `role_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `default`) VALUES
(1, 'admin', 1),
(2, 'teacher', 2),
(3, 'student', 3),
(4, 'parent', 4);

-- --------------------------------------------------------

--
-- Table structure for table `role_privilege`
--

CREATE TABLE `role_privilege` (
  `privilege_id` int(8) NOT NULL,
  `role_id` int(6) NOT NULL,
  `rights_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_privilege`
--

INSERT INTO `role_privilege` (`privilege_id`, `role_id`, `rights_id`) VALUES
(1, 1, 1),
(4, 2, 2),
(5, 2, 5),
(6, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(10) NOT NULL,
  `schedule_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(1) NOT NULL,
  `level_id` int(10) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `modified_by` int(10) NOT NULL,
  `year_start` int(5) NOT NULL,
  `year_end` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_items`
--

CREATE TABLE `schedule_items` (
  `sched_item_id` int(10) NOT NULL,
  `schedule_id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL,
  `section_id` int(6) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `start_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_levels`
--

CREATE TABLE `school_levels` (
  `level_id` int(10) NOT NULL,
  `curriculum_id` int(5) NOT NULL,
  `level_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_id` int(6) NOT NULL,
  `section_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` INT(10) NOT NULL,
  `curr_id` INT(10) NOT NULL,
  `section_adviser` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_subject_group`
--

CREATE TABLE `section_subject_group` (
  `ssg_id` int(10) NOT NULL,
  `section_id` int(6) NOT NULL,
  `subject_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(10) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `gender` int(4) NOT NULL,
  `house_street_number` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subdivision_barangay` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `town_city` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` text COLLATE utf8mb4_unicode_ci,
  `cell_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `role_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `educational_attainment` (
  `ea_id` int(11) NOT NULL,
  `curriculum_id` int(10) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `student_id` int(10) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_completed` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `educational_attainment`
--
ALTER TABLE `educational_attainment`
  ADD PRIMARY KEY (`ea_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `educational_attainment`
--
ALTER TABLE `educational_attainment`
  MODIFY `ea_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

CREATE TABLE `student_schedule` (
  `ss_id` int(11) NOT NULL,
  `student_id` int(10) NOT NULL,
  `schedule_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `modified_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(10) NOT NULL,
  `subject_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `curriculum_id` int(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(10) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(4) NOT NULL,
  `date_of_birth` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `role_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `gender`, `date_of_birth`, `nationality`, `civil_status`, `address`, `create_date`, `last_modified`, `status`, `role_id`) VALUES
(1, 'Administrator', '-', '-', 'admin@sims.com', 'acc1b2532ab4314b909ea6c282f55c20', 1, '1994-06-29', '-', '-', '-', '2018-03-01 00:00:00', '2018-03-01 00:00:00', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indexes for table `enum_table`
--
ALTER TABLE `enum_table`
  ADD PRIMARY KEY (`enum_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `grades_fk0` (`student_id`),
  ADD KEY `grades_fk1` (`subject_id`);

--
-- Indexes for table `grade_scheme`
--
ALTER TABLE `grade_scheme`
  ADD PRIMARY KEY (`grade_scheme_id`);

--
-- Indexes for table `grade_scheme_item_id`
--
ALTER TABLE `grade_scheme_item_id`
  ADD PRIMARY KEY (`grade_scheme_item_id`),
  ADD KEY `grade_scheme_item_id_fk0` (`grade_scheme_id`),
  ADD KEY `grade_scheme_item_id_fk1` (`school_level_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parents_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_line`
--
ALTER TABLE `payment_line`
  ADD PRIMARY KEY (`payment_line_id`),
  ADD KEY `payment_line_fk0` (`student_id`),
  ADD KEY `payment_line_fk1` (`payment_id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`rights_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_privilege`
--
ALTER TABLE `role_privilege`
  ADD PRIMARY KEY (`privilege_id`),
  ADD KEY `role_privilege_fk0` (`role_id`),
  ADD KEY `role_privilege_fk1` (`rights_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedules_fk0` (`level_id`);

--
-- Indexes for table `schedule_items`
--
ALTER TABLE `schedule_items`
  ADD PRIMARY KEY (`sched_item_id`),
  ADD KEY `schedule_items_fk0` (`schedule_id`),
  ADD KEY `schedule_items_fk1` (`teacher_id`),
  ADD KEY `schedule_items_fk2` (`section_id`);

--
-- Indexes for table `school_levels`
--
ALTER TABLE `school_levels`
  ADD PRIMARY KEY (`level_id`),
  ADD KEY `school_levels_fk0` (`curriculum_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_id`),
  ADD KEY `sections_fk0` (`section_adviser`);

--
-- Indexes for table `section_subject_group`
--
ALTER TABLE `section_subject_group`
  ADD PRIMARY KEY (`ssg_id`),
  ADD KEY `section_subject_group_fk0` (`section_id`),
  ADD KEY `section_subject_group_fk1` (`subject_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `students_fk0` (`gender`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `student_schedule_fk0` (`student_id`),
  ADD KEY `student_schedule_fk1` (`schedule_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `subjects_fk0` (`curriculum_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `teachers_fk0` (`gender`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enum_table`
--
ALTER TABLE `enum_table`
  MODIFY `enum_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade_scheme`
--
ALTER TABLE `grade_scheme`
  MODIFY `grade_scheme_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade_scheme_item_id`
--
ALTER TABLE `grade_scheme_item_id`
  MODIFY `grade_scheme_item_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parents_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_line`
--
ALTER TABLE `payment_line`
  MODIFY `payment_line_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `rights_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_privilege`
--
ALTER TABLE `role_privilege`
  MODIFY `privilege_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule_items`
--
ALTER TABLE `schedule_items`
  MODIFY `sched_item_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school_levels`
--
ALTER TABLE `school_levels`
  MODIFY `level_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `section_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `section_subject_group`
--
ALTER TABLE `section_subject_group`
  MODIFY `ssg_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_fk0` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `grades_fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `grade_scheme_item_id`
--
ALTER TABLE `grade_scheme_item_id`
  ADD CONSTRAINT `grade_scheme_item_id_fk0` FOREIGN KEY (`grade_scheme_id`) REFERENCES `grade_scheme` (`grade_scheme_id`),
  ADD CONSTRAINT `grade_scheme_item_id_fk1` FOREIGN KEY (`school_level_id`) REFERENCES `school_levels` (`level_id`);

--
-- Constraints for table `payment_line`
--
ALTER TABLE `payment_line`
  ADD CONSTRAINT `payment_line_fk0` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `payment_line_fk1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`);

--
-- Constraints for table `role_privilege`
--
ALTER TABLE `role_privilege`
  ADD CONSTRAINT `role_privilege_fk0` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `role_privilege_fk1` FOREIGN KEY (`rights_id`) REFERENCES `rights` (`rights_id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_fk0` FOREIGN KEY (`level_id`) REFERENCES `school_levels` (`level_id`);

--
-- Constraints for table `schedule_items`
--
ALTER TABLE `schedule_items`
  ADD CONSTRAINT `schedule_items_fk0` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`),
  ADD CONSTRAINT `schedule_items_fk1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `schedule_items_fk2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`);

--
-- Constraints for table `school_levels`
--
ALTER TABLE `school_levels`
  ADD CONSTRAINT `school_levels_fk0` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_fk0` FOREIGN KEY (`section_adviser`) REFERENCES `teachers` (`teacher_id`);

--
-- Constraints for table `section_subject_group`
--
ALTER TABLE `section_subject_group`
  ADD CONSTRAINT `section_subject_group_fk0` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`),
  ADD CONSTRAINT `section_subject_group_fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk0` FOREIGN KEY (`gender`) REFERENCES `enum_table` (`enum_id`);

--
-- Constraints for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_fk0` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `student_schedule_fk1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_fk0` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_fk0` FOREIGN KEY (`gender`) REFERENCES `enum_table` (`enum_id`);
  
  -- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(10) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_author` text NOT NULL,
  `create_date` date NOT NULL,
  `last_updated` date NOT NULL,
  `news_content` text NOT NULL,
  `news_publish` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `token_id` int(11) NOT NULL,
  `student_id` int(10) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `date_validity` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`token_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Table structure for table `student_educational`
--

CREATE TABLE `student_educational` (
  `sse` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `level_id` int(10) NOT NULL,
  `section_id` int(10) NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_level` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_educational`
--
ALTER TABLE `student_educational`
  ADD PRIMARY KEY (`sse`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_educational`
--
ALTER TABLE `student_educational`
  MODIFY `sse` int(10) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Table structure for table `school_level_subjects`
--

CREATE TABLE `school_level_subjects` (
  `sls_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `level_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Indexes for table `school_level_subjects`
--
ALTER TABLE `school_level_subjects`
  ADD PRIMARY KEY (`sls_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school_level_subjects`
--
ALTER TABLE `school_level_subjects`
  MODIFY `sls_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Table structure for table `profile_img`
--

CREATE TABLE `profile_img` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `full_path` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_img`
--

INSERT INTO `profile_img` (`id`, `role_id`, `email`, `full_path`, `status`) VALUES
(1, 0, 'default', '/user_uploads/1522690295donotdelete.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile_img`
--
ALTER TABLE `profile_img`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile_img`
--
ALTER TABLE `profile_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

