-- Create admin accounts table in database
CREATE TABLE ad (
    ad_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    ad_email VARCHAR(255) NOT NULL UNIQUE,
    ad_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create student accounts table in database
CREATE TABLE stds (
    stds_acc_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_email VARCHAR(255) NOT NULL UNIQUE,
    stds_pass VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    -- Add columns student basic info as necessarry
);

-- Create student announcements table for students
CREATE TABLE stds_stdAnn (
    stds_stdAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_stdAnn_msg TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create student updates table for students
CREATE TABLE stds_stdUpd (
    stds_stdUpd_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_stdUpd_msg TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create university announcements table for students
CREATE TABLE stds_uniAnn (
    stds_uniAnn_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stds_uniAnn_msg TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
