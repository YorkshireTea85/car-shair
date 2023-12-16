CREATE TABLE user (
    user_id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    user_first varchar(256) not null,
    user_last varchar(256) not null,
    user_email varchar(256) not null,
    user_pwd varchar(256) not null,
    user_role varchar(256) not null,
    user_uid varchar(256) not null,
    user_created datetime not null,
    user_last_login datetime not null,
    user_recovery_token varchar(256)
);