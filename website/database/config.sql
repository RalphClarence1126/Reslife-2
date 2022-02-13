-- Create initial database
CREATE DATABASE prototype;


-- Create admin accounts table in database
CREATE TABLE ad (
    ad_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_email VARCHAR(255) NOT NULL UNIQUE,
    ad_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- Create student announcements table for students
CREATE TABLE ad_stdAnn (
    ad_stdAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_stdAnn_msg LONGTEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);
-- Create student updates table for students
CREATE TABLE ad_stdUpd (
    ad_stdUpd_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_stdUpd_msg LONGTEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);
-- Create university announcements table for students
CREATE TABLE ad_uniAnn (
    ad_uniAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_acc_id INT,
    ad_uniAnn_msg LONGTEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_acc_id) REFERENCES ad(ad_acc_id)
);


-- Create student accounts table in database
CREATE TABLE stds (
    stds_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_email VARCHAR(255) NOT NULL UNIQUE,
    stds_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- Create student ptofile table in database related to the student accounts
CREATE TABLE stds_profile (
	stds_profile_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_acc_id INT,
    stds_std_num VARCHAR(12) UNIQUE,
    stds_fname VARCHAR(255),
    stds_lname VARCHAR(255),
    -- Alter to add columns for student basic info as necessarry
    FOREIGN KEY (stds_acc_id) REFERENCES stds(stds_acc_id)
);
-- Create a trigger that automtically creates an insert into student profile table after in insert in student accounts table
DELIMITER $$
CREATE TRIGGER new_std_insert
    AFTER INSERT
    ON stds FOR EACH ROW
BEGIN
    INSERT INTO stds_profile (stds_acc_id)
    SELECT stds_acc_id
    FROM (stds);
END; $$


DELIMITER ;


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
        INSERT INTO ad_stdAnn (ad_stdAnn_msg)
        VALUES ('Admission Open');

        INSERT INTO ad_uniAnn (ad_uniAnn_msg)
        VALUES ('Admission Open');
    END IF;

    IF (NEW.g_frm_admn_bool = 0) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_msg)
        VALUES ('Admission Closed');

        INSERT INTO ad_uniAnn (ad_uniAnn_msg)
        VALUES ('Admission Closed');
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
        INSERT INTO ad_stdAnn (ad_stdAnn_msg)
        VALUES ('Enrollment Open');
    
        INSERT INTO ad_uniAnn (ad_uniAnn_msg)
        VALUES ('Enrollment Open');
    END IF;

    IF (NEW.g_frm_enrll_bool = 0) THEN
        INSERT INTO ad_stdAnn (ad_stdAnn_msg)
        VALUES ('Enrollment Closed');

        INSERT INTO ad_uniAnn (ad_uniAnn_msg)
        VALUES ('Enrollment Closed');
    END IF;
END; $$


DELIMITER ;
