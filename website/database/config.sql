-- Create initial database
-- CREATE DATABASE prototype;


-- Create admin accounts table in database
CREATE TABLE ad (
    ad_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_email VARCHAR(255) NOT NULL UNIQUE,
    ad_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    ad_lname VARCHAR(255),
    ad_fname VARCHAR(255),
    ad_mname VARCHAR(255),
    ad_suffix VARCHAR(255),
    ad_profile_pic LONGTEXT
);
-- Create student announcements table for students
CREATE TABLE ad_stdAnn (
    ad_stdAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_stdAnn_title LONGTEXT NOT NULL,
    ad_stdAnn_msg LONGTEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);
-- Create student updates table for students
CREATE TABLE ad_stdUpd (
    ad_stdUpd_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_stdUpd_title LONGTEXT NOT NULL,
    ad_stdUpd_msg LONGTEXT NOT NULL,
    stds_acc_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);
-- Create university announcements table for students
CREATE TABLE ad_uniAnn (
    ad_uniAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_uniAnn_title LONGTEXT NOT NULL,
    ad_uniAnn_msg LONGTEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);


-- Create student accounts table in database
CREATE TABLE stds (
    stds_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_email VARCHAR(255) NOT NULL UNIQUE,
    stds_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    stds_std_num VARCHAR(12) UNIQUE,
    stds_lname VARCHAR(255),
    stds_fname VARCHAR(255),
    stds_mname VARCHAR(255),
    stds_suffix VARCHAR(255),
    stds_contact VARCHAR(255),
    stds_gender VARCHAR(255),
    stds_regligion VARCHAR(255),
    stds_age VARCHAR(255),
    stds_birth_month VARCHAR(255),
    stds_birth_day VARCHAR(255),
    stds_birth_year VARCHAR(255),
    stds_address LONGTEXT,
    stds_profile_pic LONGTEXT
    -- Alter to add columns for student basic info as necessarry
);
CREATE TABLE stds_frm_addm (
    stds_submission_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_acc_id INT UNIQUE,
    stds_status_bool VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    -- Learner Information
    stds_birth_address LONGTEXT,
    stds_tel_number VARCHAR(255),

    -- Application Details
    stds_grade_level VARCHAR(255),
    stds_admission_strand VARCHAR(255),
    stds_student_status VARCHAR(255),
    stds_std_number VARCHAR(255) UNIQUE,
    stds_2x2_pic LONGTEXT,
    stds_psa LONGTEXT,
    stds_good_moral LONGTEXT,
    stds_form_137 LONGTEXT,

    -- Educational Background
    stds_std_lrn VARCHAR(255) UNIQUE,
    stds_former_school LONGTEXT,
    stds_former_graduate_year VARCHAR(255),
    stds_former_school_year VARCHAR(255),

    -- Parent Information
    stds_mother_lname VARCHAR(255),
    stds_mother_fname VARCHAR(255),
    stds_mother_mname VARCHAR(255),
    stds_mother_occupation LONGTEXT,
    stds_mother_contact VARCHAR(255),

    stds_father_lname VARCHAR(255),
    stds_father_fname VARCHAR(255),
    stds_father_mname VARCHAR(255),
    stds_father_occupation LONGTEXT,
    stds_father_contact VARCHAR(255),

    -- Contact Information
    stds_emergency_contact_lname VARCHAR(255),
    stds_emergency_contact_fname VARCHAR(255),
    stds_emergency_contact_mname VARCHAR(255),
    stds_emergency_contact_contact VARCHAR(255),

    FOREIGN KEY (stds_acc_id) REFERENCES stds(stds_acc_id)
);

-- Create global boolean form table
CREATE TABLE g_frm_admn (
    g_frm_admn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    g_frm_admn_bool BOOLEAN UNIQUE
);
-- Insert default value
INSERT INTO g_frm_admn(g_frm_admn_bool)
VALUES (0);
-- Create trigger that automatically creates both a student and university announcement on admission form boolean update
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


-- Create global boolean form table
CREATE TABLE g_frm_enrll (
    g_frm_enrll_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    g_frm_enrll_bool BOOLEAN UNIQUE
);
-- Insert default value
INSERT INTO g_frm_enrll(g_frm_enrll_bool)
VALUES (0);
-- Create trigger that automatically creates both a student and university Enrollment on admission form boolean update
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
