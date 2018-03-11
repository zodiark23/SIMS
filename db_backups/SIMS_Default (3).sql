CREATE TABLE `students` (
	`student_id` int(10) NOT NULL AUTO_INCREMENT,
	`first_name` TEXT NOT NULL,
	`middle_name` TEXT NOT NULL,
	`last_name` TEXT NOT NULL,
	`email` TEXT NOT NULL,
	`password` TEXT NOT NULL,
	`contact_number` TEXT NOT NULL,
	`create_date` DATETIME NOT NULL,
	`last_updated` DATETIME NOT NULL,
	`gender` int(4) NOT NULL,
	`status` int(1) NOT NULL,
	PRIMARY KEY (`student_id`)
);

CREATE TABLE `curriculum` (
	`curriculum_id` int(5) NOT NULL AUTO_INCREMENT,
	`description` TEXT NOT NULL,
	`year_duration` int(2) NOT NULL,
	PRIMARY KEY (`curriculum_id`)
);

CREATE TABLE `teachers` (
	`teacher_id` int(10) NOT NULL AUTO_INCREMENT,
	`first_name` TEXT NOT NULL,
	`middle_name` TEXT NOT NULL,
	`last_name` TEXT NOT NULL,
	`email` TEXT NOT NULL,
	`password` TEXT NOT NULL,
	`gender` int(4) NOT NULL,
	`status` int NOT NULL,
	PRIMARY KEY (`teacher_id`)
);

CREATE TABLE `enum_table` (
	`enum_id` int(4) NOT NULL AUTO_INCREMENT,
	`enum_value` TEXT NOT NULL,
	PRIMARY KEY (`enum_id`)
);

CREATE TABLE `sections` (
	`section_id` int(6) NOT NULL AUTO_INCREMENT,
	`section_name` TEXT NOT NULL,
	`section_adviser` int(10) NOT NULL,
	PRIMARY KEY (`section_id`)
);

CREATE TABLE `schedules` (
	`schedule_id` int(10) NOT NULL AUTO_INCREMENT,
	`schedule_name` TEXT NOT NULL,
	`active` int(1) NOT NULL,
	`level_id` int(10) NOT NULL,
	`create_at` DATETIME NOT NULL,
	`last_updated` DATETIME NOT NULL,
	`modified_by` int(10) NOT NULL,
	`year_start` int(5) NOT NULL,
	`year_end` int(5) NOT NULL,
	PRIMARY KEY (`schedule_id`)
);

CREATE TABLE `log` (
	`log_id` int NOT NULL AUTO_INCREMENT,
	`description` TEXT NOT NULL,
	`user_id` int(10) NOT NULL,
	`time_created` DATETIME NOT NULL,
	PRIMARY KEY (`log_id`)
);

CREATE TABLE `schedule_items` (
	`sched_item_id` int(10) NOT NULL AUTO_INCREMENT,
	`schedule_id` INT(10) NOT NULL,
	`teacher_id` int(10) NOT NULL,
	`section_id` int(6) NOT NULL,
	`start_time` TEXT NOT NULL,
	`end_time` TEXT NOT NULL,
	PRIMARY KEY (`sched_item_id`)
);

CREATE TABLE `student_schedule` (
	`ss_id` int NOT NULL AUTO_INCREMENT,
	`student_id` INT(10) NOT NULL,
	`schedule_id` INT(10) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`last_updated` DATETIME NOT NULL,
	`modified_by` int(10) NOT NULL,
	PRIMARY KEY (`ss_id`)
);

CREATE TABLE `grades` (
	`grade_id` int NOT NULL AUTO_INCREMENT,
	`section_id` int(6) NOT NULL,
	`student_id` int(10) NOT NULL,
	`subject_id` int(10) NOT NULL,
	PRIMARY KEY (`grade_id`)
);

CREATE TABLE `subjects` (
	`subject_id` int(10) NOT NULL AUTO_INCREMENT,
	`subject_name` TEXT NOT NULL,
	`curriculum_id` int(5) NOT NULL,
	PRIMARY KEY (`subject_id`)
);

CREATE TABLE `section_subject_group` (
	`ssg_id` int(10) NOT NULL AUTO_INCREMENT,
	`section_id` int(6) NOT NULL,
	`subject_id` int(10) NOT NULL,
	PRIMARY KEY (`ssg_id`)
);

CREATE TABLE `roles` (
	`role_id` int(6) NOT NULL AUTO_INCREMENT,
	`role_name` TEXT NOT NULL,
	`default` int(1) NOT NULL,
	PRIMARY KEY (`role_id`)
);

CREATE TABLE `rights` (
	`rights_id` int(8) NOT NULL AUTO_INCREMENT,
	`rights_code` TEXT NOT NULL,
	PRIMARY KEY (`rights_id`)
);

CREATE TABLE `role_privilege` (
	`privilege_id` int(8) NOT NULL AUTO_INCREMENT,
	`role_id` int(6) NOT NULL,
	`rights_id` int(8) NOT NULL,
	PRIMARY KEY (`privilege_id`)
);

CREATE TABLE `payments` (
	`payment_id` int(10) NOT NULL AUTO_INCREMENT,
	`payment_description` TEXT NOT NULL,
	`start_date` DATETIME NOT NULL,
	`last_modified` DATETIME NOT NULL,
	`due_date` DATETIME NOT NULL,
	`amount` DECIMAL NOT NULL,
	PRIMARY KEY (`payment_id`)
);

CREATE TABLE `payment_line` (
	`payment_line_id` int(10) NOT NULL AUTO_INCREMENT,
	`payment_date` DATETIME NOT NULL,
	`amount_paid` int(10) NOT NULL,
	`isPaid` int(1) NOT NULL,
	`student_id` int(10) NOT NULL,
	`payment_id` int(10) NOT NULL,
	PRIMARY KEY (`payment_line_id`)
);

CREATE TABLE `school_levels` (
	`level_id` int(10) NOT NULL AUTO_INCREMENT,
	`curriculum_id` int(5) NOT NULL,
	`level_name` TEXT NOT NULL,
	`published` int(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`level_id`)
);

CREATE TABLE `grade_scheme` (
	`grade_scheme_id` int(10) NOT NULL AUTO_INCREMENT,
	`description` TEXT NOT NULL,
	`date_implemented` DATETIME NOT NULL,
	`published` int(1) NOT NULL,
	`pass_threshold` int(2) NOT NULL,
	PRIMARY KEY (`grade_scheme_id`)
);

CREATE TABLE `grade_scheme_item_id` (
	`grade_scheme_item_id` int(10) NOT NULL AUTO_INCREMENT,
	`grade_scheme_id` int(10) NOT NULL,
	`school_level_id` int NOT NULL,
	PRIMARY KEY (`grade_scheme_item_id`)
);

ALTER TABLE `students` ADD CONSTRAINT `students_fk0` FOREIGN KEY (`gender`) REFERENCES `enum_table`(`enum_id`);

ALTER TABLE `teachers` ADD CONSTRAINT `teachers_fk0` FOREIGN KEY (`gender`) REFERENCES `enum_table`(`enum_id`);

ALTER TABLE `sections` ADD CONSTRAINT `sections_fk0` FOREIGN KEY (`section_adviser`) REFERENCES `teachers`(`teacher_id`);

ALTER TABLE `schedules` ADD CONSTRAINT `schedules_fk0` FOREIGN KEY (`level_id`) REFERENCES `school_levels`(`level_id`);

ALTER TABLE `schedule_items` ADD CONSTRAINT `schedule_items_fk0` FOREIGN KEY (`schedule_id`) REFERENCES `schedules`(`schedule_id`);

ALTER TABLE `schedule_items` ADD CONSTRAINT `schedule_items_fk1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers`(`teacher_id`);

ALTER TABLE `schedule_items` ADD CONSTRAINT `schedule_items_fk2` FOREIGN KEY (`section_id`) REFERENCES `sections`(`section_id`);

ALTER TABLE `student_schedule` ADD CONSTRAINT `student_schedule_fk0` FOREIGN KEY (`student_id`) REFERENCES `students`(`student_id`);

ALTER TABLE `student_schedule` ADD CONSTRAINT `student_schedule_fk1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules`(`schedule_id`);

ALTER TABLE `grades` ADD CONSTRAINT `grades_fk0` FOREIGN KEY (`student_id`) REFERENCES `students`(`student_id`);

ALTER TABLE `grades` ADD CONSTRAINT `grades_fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`subject_id`);

ALTER TABLE `subjects` ADD CONSTRAINT `subjects_fk0` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum`(`curriculum_id`);

ALTER TABLE `section_subject_group` ADD CONSTRAINT `section_subject_group_fk0` FOREIGN KEY (`section_id`) REFERENCES `sections`(`section_id`);

ALTER TABLE `section_subject_group` ADD CONSTRAINT `section_subject_group_fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`subject_id`);

ALTER TABLE `role_privilege` ADD CONSTRAINT `role_privilege_fk0` FOREIGN KEY (`role_id`) REFERENCES `roles`(`role_id`);

ALTER TABLE `role_privilege` ADD CONSTRAINT `role_privilege_fk1` FOREIGN KEY (`rights_id`) REFERENCES `rights`(`rights_id`);

ALTER TABLE `payment_line` ADD CONSTRAINT `payment_line_fk0` FOREIGN KEY (`student_id`) REFERENCES `students`(`student_id`);

ALTER TABLE `payment_line` ADD CONSTRAINT `payment_line_fk1` FOREIGN KEY (`payment_id`) REFERENCES `payments`(`payment_id`);

ALTER TABLE `school_levels` ADD CONSTRAINT `school_levels_fk0` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum`(`curriculum_id`);

ALTER TABLE `grade_scheme_item_id` ADD CONSTRAINT `grade_scheme_item_id_fk0` FOREIGN KEY (`grade_scheme_id`) REFERENCES `grade_scheme`(`grade_scheme_id`);

ALTER TABLE `grade_scheme_item_id` ADD CONSTRAINT `grade_scheme_item_id_fk1` FOREIGN KEY (`school_level_id`) REFERENCES `school_levels`(`level_id`);

