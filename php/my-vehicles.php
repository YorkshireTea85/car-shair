<?php 
    session_start();

    $userId = (isset($_SESSION['u_id'])) ? $_SESSION['u_id'] : NULL;

    if (!$userId) {
        header("Location: ../index.php");
        exit();
    }

    include_once 'header.php';

    require '../includes/dbh.inc.php';

    if ($userId) {
        class vehicle {
            public $vehicle_registration;
            public $vehicle_make;
            public $vehicle_model;
            public $vehicle_colour;
            public $vehicle_transmission;
            public $vehicle_fuel_type;
            public $vehicle_tax_status;
            public $vehicle_mot_status;
            public $vehicle_image;
        }

        //get list of user's vehicles 
        $vehicleSelectSql = "SELECT vehicle_registration, vehicle_make, vehicle_model, vehicle_colour, 
                             vehicle_transmission, vehicle_fuel_type, vehicle_tax_status, vehicle_mot_status, vehicle_image
                             FROM vehicle WHERE vehicle_owner_id=$userId;";
        $statement = $pdo->prepare($vehicleSelectSql);
        $statement->execute();
        $vehicles = $statement->fetchAll(PDO::FETCH_CLASS, "vehicle");
    }
?>

<div class="flex flex-col items-center w-full">
    <h1>MY VEHICLES</h1>
        <?php
            echo "<div class='flex flex-row flex-wrap w-full justify-evenly'>";
            foreach ($vehicles as $vehicle) {
                echo "<div class='w-4/6 md:max-w-sm rounded overflow-hidden shadow-lg flex flex-col items-center'>
                    <img class='object-cover w-5/6 h-56 rounded-md' src='../$vehicle->vehicle_image' alt='Car'>
                    <div class='px-6 py-4 flex flex-col items-center'>
                        <div class='font-bold text-xl mb-2'>$vehicle->vehicle_registration</div>
                        <div class='text-xl mb-2'>$vehicle->vehicle_colour $vehicle->vehicle_make $vehicle->vehicle_model</div>
                    </div>
                    <div class='px-6 pt-4 pb-2'>
                        <span class='inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2'>$vehicle->vehicle_fuel_type</span>
                        <span class='inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2'>$vehicle->vehicle_transmission</span>
                        <span class='inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2'>$vehicle->vehicle_tax_status</span>
                        <span class='inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2'>$vehicle->vehicle_mot_status</span>
                    </div>
                </div>";
            }
        echo "</div>";
        ?>
    <a href="add-vehicle.php" class="self-center bg-secondary-500 rounded-md mt-4 px-2 py-2">Add a new vehicle</a>
</div>

<?php
	include_once 'footer.php';
?>