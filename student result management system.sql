-- CREATE TABLE FOR STUDENTS. 
-- STUDENTS ARE REGISTERED USING THEIR NAMES, ROLLID, GENDER. 
-- ACTIVE STUDENTS MEANS THAT THEY ARE IN CLASS. INACTIVE MEANS DISCONTINUED. 
-- PRIMARY KEY IS students_id. 
CREATE TABLE STUDENTS(
  `students_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `roll_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
  `isActive` int NOT NULL,
  PRIMARY KEY (`students_id`),
  UNIQUE KEY `name` (`roll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--------- CREATE TABLE FOR STUDENT DETAILS. 
-- STUDENTS DETIALS ARE SOME OF THE DETAILS ABOUT A STUDENT THAT WERE NOT CAPTURED DURING 
-- STUDENT REGISTRATION. THIS DETAILS ARE SAVED AFTER STUDENT HAS BEEN ADMITTED WITH AN ADMISSION NUMBER. 
-- PRIMARY KEY IS student_details_id; 

CREATE TABLE STUDENT_DETAILS(
    `student_details_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `students_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,   --- FPK, STUDENTS---------
    `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `guardian_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `physical_address` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY (`student_details_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


------------------------- CREATE TABLE FOR STREAM ------------------------------------------------------------------------------
-- STREAM HOUSES ALL THE CLASSES IN THE SCHOOL. STREAM HAS MANY CLASSES. 
-- IF A STREAM IS INACTIVE, CLASSES CANNOT BE SAVED ON AN INACTIVE STREAM. 
CREATE TABLE STREAM(
    `stream_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `stream_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActice` int DEFAULT 1 NOT NULL,
    PRIMARY KEY (`stream_id),
    UNIQUE KEY `name` (`stream_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

------------------------------ CREATE TABLE FOR CLASS --------------------------------------------------------------------------
-- A CLASS BELONGS TO A STREAM.
-- WHEN A CLASS IS INACTIVE, STUDENTS CANNOT CHOOSE THIS CLASS DURING ADMISSION. 
CREATE TABLE CLASS(
    `class_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `class_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `stream_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,  ----FPK, STREAM ----------------------
    `isActive` int DEFAULT 1 NOT NULL,
     PRIMARY KEY (`class_id`),
     UNIQUE KEY `name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

---------------------------- CREATE TEACHER TABLE -----------------------------------------------
-- ACTIVE TEACHERS MEANS THAT THEY ARE IN SCHOOL. 
CREATE TABLE TEACHERS(
    `teacher_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `first_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `second_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    `id_no` int NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActive` int DEFAULT 1 NOT NULL,
    PRIMARY KEY (`teacher_id),
    UNIQUE KEY `uniq_id_no` (`id_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- WHEN THE TEACHER IS NO LONGER IN SCHOOL AND THEY WERE CLASS TEACHER, THE CLASS TEACHER FIELD 
-- IS SET TO NULL. 
CREATE TABLE CLASS_DETAILS(
    `class_details_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `class_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, 
    `class_teacher_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, 
    `max_no_of_student` int NULL,
    `max_no_of_exams` int NULL,
    PRIMARY KEY (`class_details_id`),
    UNIQUE KEY `one_clsstch_on_clss` (`class_id`, `class_teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


----------------------- CREATE TABLE ACADEMIC YEAR -------------------------------------------------------------------------------
-- AN ACADEMIC YEAR HAS MANY TERMS
-- STUDENTS SHIFT TO NEW CLASSES EVERY YEAR. 
-- ACADEMIC YEAR ARE CLOSED, WHEN CLOSED USERS CANNOT POST TO ACADEMIC YEAR. 

CREATE TABLE ACADEMIC_YEAR(
    `academic_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `academic_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActive` int DEFAULT 1 NOT NULL,
    PRIMARY KEY (`academic_id`), 
    UNIQUE KEY `name` (`academic_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

---------------- CREATE ACADEMIC YEAR CLASSES STUDENTS TABLE -------------------------------------------------------------------------
-- STUDENTS BELONG TO DIFFERENT CLASSES EVERY ACADEMIC YEAR. 
-- IN THIS TABLE THE STUDENT IS BEING PLACED IN A CLASS FOR A SPECIFIC YEAR. 
-- IF THE ACADEMIC YEAR IS CLOSED, AND THEIR IS NO ACTIVE ACADEMIC YEAR, THE STUDENT CANNOT BE POSTED.
-- IF THE STUDENT IN THIS TABLE IS INACTIVE, RESULTS CANNOT BE POSTED FOR THE STUDENT. 
-- IF THE STUDENT HAS COMPLETED THIS CLASS, THE hasCompleted FIELD IS SET TO 1. 
-- isActive MEANS THAT THE STUDENT IS NOT IN CLASS FOR A LONG PERIOD OF TIME WITHOUT A REASON. 
CREATE TABLE ACADEMIC_YEAR_CLASS_STUDENTS(
    `academic_year_class_students_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `academic_year_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, --- FPK. ACADEMIC_YEAR ---
    `students_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, --- FPK, STUDENTS --------
    `class_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,  --- FPK, CLASS--------------------
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActive` int DEFAULT 1 NOT NULL,
    `hasCompleted` int DEFAULT 0 NOT NULL,
    PRIMARY KEY (`academic_year_class_students_id`),
    UNIQUE KEY `fpk_academic_year_class_id_students_id` (`academic_year_class_id`,`students_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


---------------------------- CREATE TERMS -------------------------------------------------------------------
-- TERMS CAN BE ADDED INDEPENDENTLY TO THE SCHOOL. AND LATER BY POSTED TO ACADEMIC YEAR. 
CREATE TABLE TERMS(
    `term_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `term_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActive` int DEFAULT 1 NOT NULL,
    PRIMARY KEY (`term_id`),
    UNIQUE KEY `uniq_term_name` (`term_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-------------------- CREATE ACADEMIC_TERMS ------------------------------------------------------------------
-- AN ACADEMIC YEAR HAS MANY TERMS. THE USERS CHOOSES THE TERM TO ADD TO AN ACADEMIC YEAR
-- A TERM CAN BE EITHER ACTIVE OR INACTIVE. WHEN INACTIVE THE USER CANNOT PERFORM 
-- POSITNG. 

CREATE TABLE ACADEMIC_TERMS(
    `academic_terms_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `academic_year_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, --- FPK, ACADEMIC YEAR -----
    `term_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,  --- FPK, TERMS --------
    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL,
    `isActive` int DEFAULT 1 NOT NULL,
    PRIMARY KEY (`academic_terms_id`),
    UNIQUE KEY `uniq_terms_academic` (`academic_year_id`, `term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE DEFAULT_SETTINGS(
    `assign_rollid_dynamically` int DEFAULT 1 NOT NULL,
)   






