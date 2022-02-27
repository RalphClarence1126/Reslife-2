-- CREATE DATABASE prototype;


CREATE TABLE `ad` (
  `ad_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_email` varchar(255) NOT NULL,
  `ad_pass` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ad_lname` varchar(255) DEFAULT NULL,
  `ad_fname` varchar(255) DEFAULT NULL,
  `ad_mname` varchar(255) DEFAULT NULL,
  `ad_suffix` varchar(255) DEFAULT NULL,
  `ad_profile_pic` longtext,
  `ad_account_theme` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ad_acc_id`),
  UNIQUE KEY `ad_email` (`ad_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `ad_stdAnn` (
  `ad_stdAnn_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_acc_id` int(11) DEFAULT NULL,
  `ad_stdAnn_title` longtext NOT NULL,
  `ad_stdAnn_msg` longtext NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ad_stdAnn_id`),
  KEY `ad_acc_id` (`ad_acc_id`),
  CONSTRAINT `ad_stdann_ibfk_1` FOREIGN KEY (`ad_acc_id`) REFERENCES `ad` (`ad_acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

CREATE TABLE `ad_stdUpd` (
  `ad_stdUpd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_acc_id` int(11) DEFAULT NULL,
  `ad_stdUpd_title` longtext NOT NULL,
  `ad_stdUpd_msg` longtext NOT NULL,
  `stds_acc_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ad_stdUpd_id`),
  KEY `ad_acc_id` (`ad_acc_id`),
  CONSTRAINT `ad_stdupd_ibfk_1` FOREIGN KEY (`ad_acc_id`) REFERENCES `ad` (`ad_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `ad_uniAnn` (
  `ad_uniAnn_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_acc_id` int(11) DEFAULT NULL,
  `ad_uniAnn_title` longtext NOT NULL,
  `ad_uniAnn_msg` longtext NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ad_uniAnn_id`),
  KEY `ad_acc_id` (`ad_acc_id`),
  CONSTRAINT `ad_uniann_ibfk_1` FOREIGN KEY (`ad_acc_id`) REFERENCES `ad` (`ad_acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


CREATE TABLE `stds` (
  `stds_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `stds_email` varchar(255) NOT NULL,
  `stds_pass` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `stds_std_num` varchar(12) DEFAULT NULL,
  `stds_lname` varchar(255) DEFAULT NULL,
  `stds_fname` varchar(255) DEFAULT NULL,
  `stds_mname` varchar(255) DEFAULT NULL,
  `stds_suffix` varchar(255) DEFAULT NULL,
  `stds_contact` varchar(255) DEFAULT NULL,
  `stds_gender` varchar(255) DEFAULT NULL,
  `stds_regligion` varchar(255) DEFAULT NULL,
  `stds_age` varchar(255) DEFAULT NULL,
  `stds_birth_month` varchar(255) DEFAULT NULL,
  `stds_birth_day` varchar(255) DEFAULT NULL,
  `stds_birth_year` varchar(255) DEFAULT NULL,
  `stds_address` longtext,
  `stds_profile_pic` longtext,
  `stds_account_theme` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`stds_acc_id`),
  UNIQUE KEY `stds_email` (`stds_email`),
  UNIQUE KEY `stds_std_num` (`stds_std_num`)
) ENGINE=InnoDB AUTO_INCREMENT=39690 DEFAULT CHARSET=latin1;

CREATE TABLE `stds_frm_addm` (
  `stds_submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `stds_acc_id` int(11) DEFAULT NULL,
  `stds_status_bool` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `stds_birth_address` longtext,
  `stds_tel_number` varchar(255) DEFAULT NULL,
  `stds_grade_level` varchar(255) DEFAULT NULL,
  `stds_admission_strand` varchar(255) DEFAULT NULL,
  `stds_student_status` varchar(255) DEFAULT NULL,
  `stds_std_number` varchar(255) DEFAULT NULL,
  `stds_2x2_pic` longtext,
  `stds_psa` longtext,
  `stds_good_moral` longtext,
  `stds_form_137` longtext,
  `stds_std_lrn` varchar(255) DEFAULT NULL,
  `stds_former_school` longtext,
  `stds_former_graduate_year` varchar(255) DEFAULT NULL,
  `stds_former_school_year` varchar(255) DEFAULT NULL,
  `stds_mother_lname` varchar(255) DEFAULT NULL,
  `stds_mother_fname` varchar(255) DEFAULT NULL,
  `stds_mother_mname` varchar(255) DEFAULT NULL,
  `stds_mother_occupation` longtext,
  `stds_mother_contact` varchar(255) DEFAULT NULL,
  `stds_father_lname` varchar(255) DEFAULT NULL,
  `stds_father_fname` varchar(255) DEFAULT NULL,
  `stds_father_mname` varchar(255) DEFAULT NULL,
  `stds_father_occupation` longtext,
  `stds_father_contact` varchar(255) DEFAULT NULL,
  `stds_emergency_contact_lname` varchar(255) DEFAULT NULL,
  `stds_emergency_contact_fname` varchar(255) DEFAULT NULL,
  `stds_emergency_contact_mname` varchar(255) DEFAULT NULL,
  `stds_emergency_contact_contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`stds_submission_id`),
  UNIQUE KEY `stds_acc_id` (`stds_acc_id`),
  UNIQUE KEY `stds_std_number` (`stds_std_number`),
  UNIQUE KEY `stds_std_lrn` (`stds_std_lrn`),
  CONSTRAINT `stds_frm_addm_ibfk_1` FOREIGN KEY (`stds_acc_id`) REFERENCES `stds` (`stds_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `g_frm_admn` (
  `g_frm_admn_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_frm_admn_bool` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`g_frm_admn_id`),
  UNIQUE KEY `g_frm_admn_bool` (`g_frm_admn_bool`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO g_frm_admn(g_frm_admn_bool)
VALUES (0);

DELIMITER $$
CREATE TRIGGER g_frm_admn_upd
    AFTER UPDATE
    ON g_frm_admn FOR EACH ROW
BEGIN
    IF (OLD.g_frm_admn_bool = NEW.g_frm_admn_bool) THEN
		UPDATE g_frm_admn
        SET g_frm_admn_bool = OLD.g_frm_admn_bool;
    END IF;

    IF (NEW.g_frm_admn_bool = 1) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_title, ad_stdAnn_msg)
        VALUES ('Admission Announcement', 'Admission Open (This announcement is automated, please wait for further announcements)');

        INSERT INTO ad_uniAnn (ad_uniAnn_title, ad_uniAnn_msg)
        VALUES ('Admission Announcement', 'Admission Open (This announcement is automated, please wait for further announcements)');
    END IF;

    IF (NEW.g_frm_admn_bool = 0) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_title, ad_stdAnn_msg)
        VALUES ('Admission Announcement', 'Admission Closed (This announcement is automated, please wait for further announcements)');

        INSERT INTO ad_uniAnn (ad_uniAnn_title, ad_uniAnn_msg)
        VALUES ('Admission Announcement', 'Admission Closed (This announcement is automated, please wait for further announcements)');
    END IF;
END; $$


DELIMITER ;


CREATE TABLE `g_frm_enrll` (
  `g_frm_enrll_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_frm_enrll_bool` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`g_frm_enrll_id`),
  UNIQUE KEY `g_frm_enrll_bool` (`g_frm_enrll_bool`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO g_frm_enrll(g_frm_enrll_bool)
VALUES (0);

DELIMITER $$
CREATE TRIGGER g_frm_enrll_upd
    AFTER UPDATE
    ON g_frm_enrll FOR EACH ROW
BEGIN
    IF (OLD.g_frm_enrll_bool = NEW.g_frm_enrll_bool) THEN
		UPDATE g_frm_enrll
        SET g_frm_enrll_bool = OLD.g_frm_enrll_bool;
    END IF;

    IF (NEW.g_frm_enrll_bool = 1) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_title, ad_stdAnn_msg)
        VALUES ('Enrollment Announcement', 'Enrollment Open (This announcement is automated, please wait for further announcements)');
    
        INSERT INTO ad_uniAnn (ad_uniAnn_title, ad_uniAnn_msg)
        VALUES ('Enrollment Announcement', 'Enrollment Open (This announcement is automated, please wait for further announcements)');
    END IF;

    IF (NEW.g_frm_enrll_bool = 0) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_title, ad_stdAnn_msg)
        VALUES ('Enrollment Announcement', 'Enrollment Closed (This announcement is automated, please wait for further announcements)');

        INSERT INTO ad_uniAnn (ad_uniAnn_title, ad_uniAnn_msg)
        VALUES ('Enrollment Announcement', 'Enrollment Closed (This announcement is automated, please wait for further announcements)');
    END IF;
END; $$


DELIMITER ;
