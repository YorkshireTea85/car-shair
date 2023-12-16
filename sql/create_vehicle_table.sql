CREATE TABLE vehicle (
    vehicle_id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    vehicle_owner_id int(11) not null,
    CONSTRAINT fk_owner FOREIGN KEY (vehicle_owner_id) 
        REFERENCES user(user_id)
        ON DELETE CASCADE  
        ON UPDATE CASCADE,
    vehicle_address_id int(11) not null,
    CONSTRAINT fk_address FOREIGN KEY (vehicle_address_id) 
        REFERENCES address(address_id)
        ON DELETE CASCADE  
        ON UPDATE CASCADE,
    vehicle_registration varchar(8) not null,
    vehicle_make varchar(256) not null,
    vehicle_model varchar(256) not null,
    vehicle_colour varchar(256) not null,
    vehicle_body varchar(256) not null,
    vehicle_doors tinyint(1) not null,
    vehicle_seats tinyint(2) not null,
    vehicle_transmission varchar(256) not null,
    vehicle_fuel_type varchar(256) not null,
    vehicle_engine_capacity int(6) not null,
    vehicle_co2_emissions int(4),
    vehicle_ulez tinyint(1) not null,
    vehicle_tax_status varchar(256) not null,
    vehicle_tax_due_date date not null,
    vehicle_mot_status varchar(256) not null,
    vehicle_mot_expiry date not null,
    vehicle_aircon tinyint(1) not null,
    vehicle_heated_seats tinyint(1) not null,
    vehicle_satnav tinyint(1) not null,
    vehicle_smartphone tinyint(1) not null,
    vehicle_radio tinyint(1) not null,
    vehicle_cd_player tinyint(1) not null,
    vehicle_bluetooth tinyint(1) not null,
    vehicle_isofix tinyint(1) not null,
    vehicle_smoking_status tinyint(1) not null,
    vehicle_pet_status tinyint(1) not null,
    vehicle_image varchar(4000),
    vehicle_daily_mileage_allowance int(4) not null,
    vehicle_hourly_rate decimal(3,2) not null,
    vehicle_daily_rate decimal(4,2) not null
);