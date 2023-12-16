CREATE TABLE address (
    address_id int(11) not null AUTO_INCREMENT PRIMARY KEY,  
    address_user_id int(11) not null,
    CONSTRAINT fk_user FOREIGN KEY (address_user_id) 
        REFERENCES user(user_id)
        ON DELETE CASCADE  
        ON UPDATE CASCADE,
    address_line_1 varchar(256) not null,
    address_sub_line varchar(256),
    address_city varchar(256) not null,
    address_county varchar(256),
    address_admin_area varchar(256),
    address_postcode varchar(256) not null,
    address_country varchar(256) not null,
    address_w3w varchar(256),
    address_latitude decimal(10,8),
    address_longitude decimal(11,8)
);