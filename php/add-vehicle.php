<?php 
    include_once 'header.php';

    $dvla_data = null;

    if (isset($_POST['vrnSubmit'])) {
        require '../includes/dvla.inc.php';
    }
?>

<section class="flex flex-col justify-center items-center">
    <h2>Add Vehicle</h2>
    <div class="block flex justify-start">
    <form id="vrnForm" action="add-vehicle.php" method="POST">
        <label for="vrn_input">Enter Registration:</label>
        <input type="text" id="vrn_input" name="vrn_input"><br><br>
        <input class="bg-secondary-500 p-2 rounded-md cursor-pointer" type="submit" name="vrnSubmit" id="vrnSubmit">
    </form>
    </div>
    <div class="block flex justify-start">
        <form class="add-vehicle-form flex flex-col" action="add-vehicle.php" method="POST">
            <div>
                <label class="mr-4" for="make">Make:</label>
                <input type="text" id="make" name="make" placeholder="Make" value="<?php echo $dvla_data['make']; ?>">
            </div>
            <div>
                <label class="mr-4" for="colour">Colour:</label>
                <input type="text" id="colour" name="colour" placeholder="Colour" value="<?php echo $dvla_data['colour']; ?>">
            </div>
            <div>
                <label class="mr-4" for="fuelType">Fuel Type:</label>
                <input type="text" id="fuelType" name="fuelType" placeholder="Fuel Type" value="<?php echo $dvla_data['fuelType']; ?>">
            </div>
            <div>
                <label class="mr-4" for="tax-status">Tax Status:</label>
                <input type="text" id="tax-status" name="tax-status" placeholder="Tax Status" value="<?php echo $dvla_data['taxStatus']; ?>">
            </div>
            <div>
                <label class="mr-4" for="tax-due">Tax Due Date::</label>
                <input type="date" id="tax-due" name="tax-due" placeholder="Tax Due" value="<?php echo $dvla_data['taxDueDate']; ?>">
            </div>
        </form>
    </div>
</section>

<?php
	include_once 'footer.php';
?>