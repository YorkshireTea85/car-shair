<?php

session_start();

if (isset($_POST['add-vehicle-submit'])) {
    require 'dbh.inc.php';

    $userId = $_SESSION["u_id"];

    //get address details
    $addressSelect = $_POST['address-select'];
    $address = (int)$addressSelect;
    $addressLine1 = htmlspecialchars($_POST['address-line-1']);
    $addressSubLine = htmlspecialchars($_POST['address-sub-line']);
    $locality = htmlspecialchars($_POST['locality']);
    $adminArea = htmlspecialchars($_POST['admin-area']);
    $postCode = htmlspecialchars($_POST['post-code']);
    $country = htmlspecialchars($_POST['country']);
    $latitude = htmlspecialchars($_POST['latitude']);
    $longitude = htmlspecialchars($_POST['longitude']);

    //add new address
    if ($addressSelect === "add-new") {
        $addressInsertSql = "INSERT INTO address 
                            (address_user_id, address_line_1, address_sub_line, address_locality, address_admin_area, address_postcode, address_country, address_latitude, address_longitude)
                            VALUES 
                            (:address_user_id, :address_line_1, :address_sub_line, :address_locality, :address_admin_area,
                            :address_postcode, :address_country, :address_latitude, :address_longitude);";
        
        $newAddress['address_user_id'] = $userId;
        $newAddress['address_line_1'] = $addressLine1;
        $newAddress['address_sub_line'] = $addressSubLine;
        $newAddress['address_locality'] = $locality;
        $newAddress['address_admin_area'] = $adminArea;
        $newAddress['address_postcode'] = $postCode;
        $newAddress['address_country'] = $country;
        $newAddress['address_latitude'] = $latitude;
        $newAddress['address_longitude'] = $longitude;
        
        $statement = $pdo->prepare($addressInsertSql);
        $statement->execute($newAddress);

        //get address id of new address
        $addressSelectSql = "SELECT address_id FROM address WHERE address_user_id='$userId' AND address_line_1='$addressLine1'
                             AND address_locality='$locality' AND address_country='$country'";
        $statement = $pdo->query($addressSelectSql);
        $addressID = $statement->fetch();
        $address = $addressID['address_id'];
    }

    $imageMoved = false;
    $imageMessage = '';
    $imageError = '';
    $uploadPath = 'uploads/';
    $maxSize = '500000';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $allowedExts = ['jpeg', 'jpg', 'png', 'gif'];

    // //upload image and add get stored image address
    function create_filename($filename, $uploadPath)
    {
        $basename = pathinfo($filename, PATHINFO_FILENAME);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $basename = preg_replace('/[^A-z0-9]/','-',$basename);
        $i = 0;
        while (file_exists($uploadPath . $filename)) {
            $i = $i + 1;
            $filename = $basename . $i . '.' . $extension;
        }
        return $filename;
    }

    $imageError = ($_FILES['vehicle-image']['error'] === 1) ? 'too big' : '';
    //Check file type is accepted file type
    $type = mime_content_type($_FILES['vehicle-image']['tmp_name']);
    $imageError .= in_array($type, $allowedTypes) ? '' : 'wrong type';
    //Check file extension is accepted file extension
    $ext = strtolower(pathinfo($_FILES['vehicle-image']['name'], PATHINFO_EXTENSION));
    $imageError .= in_array($ext, $allowedExts) ? '' : 'wrong file extension';
    //if no errors create filepath and move file
    if (!$imageError) {
        $filename = create_filename($_FILES['vehicle-image']['name'], $uploadPath);
        $destination = $uploadPath . $filename;
        $imageMoved = move_uploaded_file($_FILES['vehicle-image']['tmp_name'], "../" . $destination);
    }

    if ($imageMoved === true) {
        $imageMessage = 'Uploaded:<br><img src="' . $destination . '">';
    } else {
        $imageMessage = '<b>Could not upload file:</b>' . $imageError;
    }

    //get car details
    $reg = htmlspecialchars($_POST['registration']);
    $make = mb_convert_case(htmlspecialchars($_POST['make']), MB_CASE_TITLE, "UTF-8");
    $model = mb_convert_case(htmlspecialchars($_POST['model']), MB_CASE_TITLE, "UTF-8");
    $colour = mb_convert_case(htmlspecialchars($_POST['colour']), MB_CASE_TITLE, "UTF-8");
    $body = mb_convert_case(htmlspecialchars($_POST['body']), MB_CASE_TITLE, "UTF-8");
    $doors = (int)$_POST['doors'];
    $seats = (int)$_POST['seats'];
    $transmission = mb_convert_case(htmlspecialchars($_POST['transmission']), MB_CASE_TITLE, "UTF-8");
    $fuel = mb_convert_case(htmlspecialchars($_POST['fuel-type']), MB_CASE_TITLE, "UTF-8");
    $engineCapacity = (isset($_POST['engine-capacity'])) ? (int)$_POST['engine-capacity'] : NULL;
    $co2Emissions = (isset($_POST['emissions'])) ? (int)$_POST['co2-emissions'] : NULL;
    $ulez = ($_POST['ulez']) ? 1 : 0;
    $taxStatus = mb_convert_case(htmlspecialchars($_POST['tax-status']), MB_CASE_TITLE, "UTF-8");
    $taxDue = htmlspecialchars($_POST['tax-due']);
    $motStatus = mb_convert_case(htmlspecialchars($_POST['mot-status']), MB_CASE_TITLE, "UTF-8");
    $motExpiry = htmlspecialchars($_POST['mot-expiry']);
    $aircon = (isset($_POST['aircon'])) ? 1 : 0;
    $heatedSeats = (isset($_POST['heated-seats'])) ? 1 : 0;
    $satnav = (isset($_POST['satnav'])) ? 1 : 0;
    $smartphone = (isset($_POST['smartphone'])) ? 1 : 0;
    $radio = (isset($_POST['radio'])) ? 1 : 0;
    $cdPlayer = (isset($_POST['cd-player'])) ? 1 : 0;
    $bluetooth = (isset($_POST['bluetooth'])) ? 1 : 0;
    $isofix = (isset($_POST['isofix'])) ? 1 : 0;
    $smoking = (isset($_POST['smoking'])) ? 1 : 0;
    $pets = (isset($_POST['pets'])) ? 1 : 0;
    $hourlyRate = (float)$_POST['hourly-rate'];
    $dailyRate = (float)$_POST['daily-rate'];
    $dailyMileage = (isset($_POST['mileage-allowance'])) ? (int)$_POST['mileage-allowance'] : NULL;

    //Insert the vehicle into the database
    $vehicleInsertSql = "INSERT INTO vehicle
        (vehicle_owner_id, vehicle_address_id, vehicle_registration, vehicle_make,
        vehicle_model, vehicle_colour, vehicle_body, vehicle_doors, vehicle_seats, vehicle_transmission,
        vehicle_fuel_type, vehicle_engine_capacity, vehicle_co2_emissions, vehicle_ulez, vehicle_tax_status,
        vehicle_tax_due_date, vehicle_mot_status, vehicle_mot_expiry, vehicle_aircon, vehicle_heated_seats, 
        vehicle_satnav, vehicle_smartphone, vehicle_radio, vehicle_cd_player, vehicle_bluetooth, vehicle_isofix,
        vehicle_smoking_status, vehicle_pet_status, vehicle_daily_mileage_allowance, vehicle_hourly_rate, vehicle_daily_rate, vehicle_image)
        VALUES
        (:vehicle_owner_id, :vehicle_address_id, :vehicle_registration, :vehicle_make, :vehicle_model, :vehicle_colour, :vehicle_body, :vehicle_doors,
        :vehicle_seats, :vehicle_transmission, :vehicle_fuel_type, :vehicle_engine_capacity, :vehicle_co2_emissions,
        :vehicle_ulez, :vehicle_tax_status, :vehicle_tax_due_date, :vehicle_mot_status, :vehicle_mot_expiry, :vehicle_aircon,
        :vehicle_heated_seats, :vehicle_satnav, :vehicle_smartphone, :vehicle_radio, :vehicle_cd_player, :vehicle_bluetooth,
        :vehicle_isofix, :vehicle_smoking_status, :vehicle_pet_status, :vehicle_mileage_allowance, :vehicle_hourly_rate,
        :vehicle_daily_rate, :vehicle_image);";

    $vehicle['vehicle_owner_id'] = $userId;
    $vehicle['vehicle_address_id'] = $address;
    $vehicle['vehicle_registration'] = $reg;
    $vehicle['vehicle_make'] = $make;
    $vehicle['vehicle_model'] = $model;
    $vehicle['vehicle_colour'] = $colour;
    $vehicle['vehicle_body'] = $body;
    $vehicle['vehicle_doors'] = $doors;
    $vehicle['vehicle_seats'] = $seats;
    $vehicle['vehicle_transmission'] = $transmission;
    $vehicle['vehicle_fuel_type'] = $fuel;
    $vehicle['vehicle_engine_capacity'] = $engineCapacity;
    $vehicle['vehicle_co2_emissions'] = $co2Emissions;
    $vehicle['vehicle_ulez'] = $ulez;
    $vehicle['vehicle_tax_status'] = $taxStatus;
    $vehicle['vehicle_tax_due_date'] = $taxDue;
    $vehicle['vehicle_mot_status'] = $motStatus;
    $vehicle['vehicle_mot_expiry'] = $motExpiry;
    $vehicle['vehicle_aircon'] = $aircon;
    $vehicle['vehicle_heated_seats'] = $heatedSeats;
    $vehicle['vehicle_satnav'] = $satnav;
    $vehicle['vehicle_smartphone'] = $smartphone;
    $vehicle['vehicle_radio'] = $radio;
    $vehicle['vehicle_cd_player'] = $cdPlayer;
    $vehicle['vehicle_bluetooth'] = $bluetooth;
    $vehicle['vehicle_isofix'] = $isofix;
    $vehicle['vehicle_smoking_status'] = $smoking;
    $vehicle['vehicle_pet_status'] = $pets;
    $vehicle['vehicle_mileage_allowance'] = $dailyMileage;
    $vehicle['vehicle_hourly_rate'] = $hourlyRate;
    $vehicle['vehicle_daily_rate'] = $dailyRate;
    $vehicle['vehicle_image'] = $destination;
    
    $statement = $pdo->prepare($vehicleInsertSql);
    $statement->execute($vehicle);

    //get vehicle id of new vehicle
    $vehicleSelectSql = "SELECT vehicle_id FROM vehicle WHERE vehicle_owner_id='$userId' AND vehicle_registration='$reg'";
    $statement = $pdo->query($vehicleSelectSql);
    $vehicleSqlResult = $statement->fetch();
    $vehicleId = $vehicleSqlResult['vehicle_id'];

    //get availability details
    $mondayAvailability = (isset($_POST['monday-availability'])) ? 1 : 0;
    $mondayFrom = ($_POST['monday-from']) ? htmlspecialchars($_POST['monday-from']) : NULL;
    $mondayTo = ($_POST['monday-to']) ? htmlspecialchars($_POST['monday-to']) : NULL;
    $tuesdayAvailability = (isset($_POST['tuesday-availability'])) ? 1 : 0;
    $tuesdayFrom = ($_POST['tuesday-from']) ? htmlspecialchars($_POST['tuesday-from']) : NULL;
    $tuesdayTo = ($_POST['tuesday-to']) ? htmlspecialchars($_POST['tuesday-to']) : NULL;
    $wednesdayAvailability = (isset($_POST['wednesday-availability'])) ? 1 : 0;
    $wednesdayFrom = ($_POST['wednesday-from']) ? htmlspecialchars($_POST['wednesday-from']) : NULL;
    $wednesdayTo = ($_POST['wednesday-to']) ? htmlspecialchars($_POST['wednesday-to']) : NULL;
    $thursdayAvailability = (isset($_POST['thursday-availability'])) ? 1 : 0;
    $thursdayFrom = ($_POST['thursday-from']) ? htmlspecialchars($_POST['thursday-from']) : NULL;
    $thursdayTo = ($_POST['thursday-to']) ? htmlspecialchars($_POST['thursday-to']) : NULL;
    $fridayAvailability = (isset($_POST['friday-availability'])) ? 1 : 0;
    $fridayFrom = ($_POST['friday-from']) ? htmlspecialchars($_POST['friday-from']) : NULL;
    $fridayTo = ($_POST['friday-to']) ? htmlspecialchars($_POST['friday-to']) : NULL;
    $saturdayAvailability = (isset($_POST['saturday-availability'])) ? 1 : 0;
    $saturdayFrom = ($_POST['saturday-from']) ? htmlspecialchars($_POST['saturday-from']) : NULL;
    $saturdayTo = ($_POST['saturday-to']) ? htmlspecialchars($_POST['saturday-to']) : NULL;
    $sundayAvailability = (isset($_POST['sunday-availability'])) ? 1 : 0;
    $sundayFrom = ($_POST['sunday-from']) ? $_POST['sunday-from'] : NULL;
    $sundayTo = ($_POST['sunday-to']) ? htmlspecialchars($_POST['sunday-to']) : NULL;
    $januaryAvailability = (isset($_POST['january-availability'])) ? 1 : 0;
    $februaryAvailability = (isset($_POST['february-availability'])) ? 1 : 0;
    $marchAvailability = (isset($_POST['march-availability'])) ? 1 : 0;
    $aprilAvailability = (isset($_POST['april-availability'])) ? 1 : 0;
    $mayAvailability = (isset($_POST['may-availability'])) ? 1 : 0;
    $juneAvailability = (isset($_POST['june-availability'])) ? 1 : 0;
    $julyAvailability = (isset($_POST['july-availability'])) ? 1 : 0;
    $augustAvailability = (isset($_POST['august-availability'])) ? 1 : 0;
    $septemberAvailability = (isset($_POST['september-availability'])) ? 1 : 0;
    $octoberAvailability = (isset($_POST['october-availability'])) ? 1 : 0;
    $novemberAvailability = (isset($_POST['november-availability'])) ? 1 : 0;
    $decemberAvailability = (isset($_POST['december-availability'])) ? 1 : 0;

    //Insert vehicle availability into the database
    $availabilityInsertSql = "INSERT INTO availability (availability_vehicle_id,
        availability_monday, availability_monday_start_time, availability_monday_end_time, 
        availability_tuesday, availability_tuesday_start_time, availability_tuesday_end_time,
        availability_wednesday, availability_wednesday_start_time, availability_wednesday_end_time,
        availability_thursday, availability_thursday_start_time, availability_thursday_end_time,
        availability_friday, availability_friday_start_time, availability_friday_end_time,
        availability_saturday, availability_saturday_start_time, availability_saturday_end_time,
        availability_sunday, availability_sunday_start_time, availability_sunday_end_time,
        availability_january, availability_february, availability_march, availability_april,
        availability_may, availability_june, availability_july, availability_august, availability_september,
        availability_october, availability_november, availability_december)
        VALUES
        (:availability_vehicle_id,
        :availability_monday, :availability_monday_start_time, :availability_monday_end_time, 
        :availability_tuesday, :availability_tuesday_start_time, :availability_tuesday_end_time,
        :availability_wednesday, :availability_wednesday_start_time, :availability_wednesday_end_time,
        :availability_thursday, :availability_thursday_start_time, :availability_thursday_end_time,
        :availability_friday, :availability_friday_start_time, :availability_friday_end_time,
        :availability_saturday, :availability_saturday_start_time, :availability_saturday_end_time,
        :availability_sunday, :availability_sunday_start_time, :availability_sunday_end_time,
        :availability_january, :availability_february, :availability_march, :availability_april,
        :availability_may, :availability_june, :availability_july, :availability_august, :availability_september,
        :availability_october, :availability_november, :availability_december);";

    $availability['availability_vehicle_id'] = $vehicleId;
    $availability['availability_monday'] = $mondayAvailability;
    $availability['availability_monday_start_time'] = $mondayFrom;
    $availability['availability_monday_end_time'] = $mondayTo;
    $availability['availability_tuesday'] = $tuesdayAvailability;
    $availability['availability_tuesday_start_time'] = $tuesdayFrom;
    $availability['availability_tuesday_end_time'] = $tuesdayTo;
    $availability['availability_wednesday'] = $wednesdayAvailability;
    $availability['availability_wednesday_start_time'] = $wednesdayFrom;
    $availability['availability_wednesday_end_time'] = $wednesdayTo;
    $availability['availability_thursday'] = $thursdayAvailability;
    $availability['availability_thursday_start_time'] = $thursdayFrom;
    $availability['availability_thursday_end_time'] = $thursdayTo;
    $availability['availability_friday'] = $fridayAvailability;
    $availability['availability_friday_start_time'] = $fridayFrom;
    $availability['availability_friday_end_time'] = $fridayTo;
    $availability['availability_saturday'] = $saturdayAvailability;
    $availability['availability_saturday_start_time'] = $saturdayFrom;
    $availability['availability_saturday_end_time'] = $saturdayTo;
    $availability['availability_sunday'] = $sundayAvailability;
    $availability['availability_sunday_start_time'] = $sundayFrom;
    $availability['availability_sunday_end_time'] = $sundayTo;
    $availability['availability_january'] = $januaryAvailability;
    $availability['availability_february'] = $februaryAvailability;
    $availability['availability_march'] = $marchAvailability;
    $availability['availability_april'] = $aprilAvailability;
    $availability['availability_may'] = $mayAvailability;
    $availability['availability_june'] = $juneAvailability;
    $availability['availability_july'] = $julyAvailability;
    $availability['availability_august'] = $augustAvailability;
    $availability['availability_september'] = $septemberAvailability;
    $availability['availability_october'] = $octoberAvailability;
    $availability['availability_november'] = $novemberAvailability;
    $availability['availability_december'] = $decemberAvailability;

    $statement = $pdo->prepare($availabilityInsertSql);
    $statement->execute($availability);

      header("Location: ../php/add-vehicle.php?add-vehicle=success");
  } else {
      header("Location: ../php/add-vehicle.php?add-vehicle=error");
}
