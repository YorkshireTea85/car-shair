<?php 
    include_once 'header.php';

    $dvla_data = null;

    if (isset($_POST['vrnSubmit'])) {
        require '../includes/dvla.inc.php';
    }

    include '../includes/dbh.inc.php';
    
    if (isset($_SESSION["u_id"])) {
        $uid = $_SESSION["u_id"];
        $sql = "SELECT COUNT(*) FROM address WHERE address_user_id='$uid'";
            $statement = $pdo->query($sql);
            $addressCount = $statement->fetch();
            if ($addressCount["COUNT(*)"] > 0) {
                $sql2 = "SELECT * FROM address WHERE address_user_id='$uid'";
                $statement = $pdo->query($sql2);
                $addresses = $statement->fetchAll();
            }
    }
?>

<section class="flex flex-col justify-center items-center">
    <h2 class="mb-4">Add Vehicle</h2>
    <div class="block">
    <form class="m-aut- flex flex-col mb-8" id="vrnForm" action="add-vehicle.php" method="POST">
        <label for="vrn_input">Enter Registration:</label>
        <input type="text" id="vrn_input" name="vrn_input" value="<?php echo $dvla_data['registrationNumber']; ?>" class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
        <input class="self-center bg-secondary-500 rounded-md cursor-pointer w-24 py-2" type="submit" name="vrnSubmit" id="vrnSubmit">
    </form>
    </div>
    <div class="m-auto flex flex-col items-center w-full mb-4">
        <form class="flex flex-col items-center p-2" id="add-vehicle-form" action="../includes/add-vehicle.inc.php" method="POST" novalidate>
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[175px] z-10" >Vehicle Specifications</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-row flex-wrap justify-center">
                <div  class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="" for="registration">Registration:</label>
                    <input type="text" id="registration" name="registration" value="<?php echo $dvla_data['registrationNumber']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                    <span id="registration-error" class="mt-0 text-red-600"></span>
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="make">Make:</label>
                    <input type="text" id="make" name="make" placeholder="Make" value="<?php echo $dvla_data['make']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="model">Model:</label>
                    <input type="text" id="model" name="model" placeholder="Model" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="colour">Colour:</label>
                    <input type="text" id="colour" name="colour" placeholder="Colour" value="<?php echo $dvla_data['colour']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 w-2/3 mx-12 md:mx-24 sm:w-1/2">
                    <label class="mr-4" for="body">Body Type:</label>
                    <select id="body" name="body" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                        <option value="">Please select</option>
                        <option value="convertible">Convertible</option>
                        <option value="coupe">Coupe</option>
                        <option value="estate">Estate</option>
                        <option value="hatchback">Hatchback</option>
                        <option value="mpv">Multi Purpose Vehicle (MPV)</option>
                        <option value="saloon">Saloon</option>
                        <option value="sports">Sports</option>
                        <option value="suv">Sports Utility Vehicle (SUV)</option>
                    </select>
                </div>
                <div class="flex flex-col items-center my-1 w-full">
                    <p>Transmission type:</p>
                    <div>
                        <div>
                            <input id="trans-manual" class="ml-4 mr-2" type="radio" id="trans-manual" name="transmission" value="manual" required>
                            <label for="trans-manual">Manual</label><br>
                        </div>
                        <div>
                            <input id="trans-auto" class="ml-4 mr-2" type="radio" id="trqans-auto" name="transmission" value="automatic" required>
                            <label for="trans-auto">Automatic</label><br>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col my-1 ml:10 sm:ml-20 mr-4 w-1/4 sm:w-1/5">
                    <label class="mr-4" for="doors">Doors:</label>
                    <input type="number" id="doors" name="doors" min="3" max="5" placeholder="5" value="5" required class="w-1/8 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 ml-4 mr:10 sm:mr-20 w-1/4 sm:w-1/5">
                    <label class="mr-4" for="seats">Seats:</label>
                    <input type="number" id="seats" name="seats" min="1" max="9" placeholder="5" value="5" required class="w-1/8 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="fuelType">Fuel Type:</label>
                    <input type="text" id="fuelType" name="fuel-type" placeholder="Fuel Type" value="<?php echo $dvla_data['fuelType']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="engine-capacity">Engine Capacity (cc):</label>
                    <input type="number" id="engine-capacity" name="engine-capacity" placeholder="Engine Capacity" value="<?php echo $dvla_data['engineCapacity']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/2">
                    <label class="mr-4" for="co2-emissions">CO2 Emmissions (g/km):</label>
                    <input type="number" id="co2-emissions" name="co2-emissions" placeholder="CO2 Emissions" value="<?php echo $dvla_data['co2Emissions']; ?>" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-row items-center justify-center my-1 mx-4 w-full">
                    <input type="checkbox" id="ulez" name="ulez" class="rounded">
                    <label class="ml-2" for="ulez">ULEZ Compliant</label><a class="ml-2 px-2 rounded text-primary-200" href="https://tfl.gov.uk/modes/driving/check-your-vehicle/" target="_blank">Check here</a>
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="tax-status">Tax Status:</label>
                    <input type="text" id="tax-status" name="tax-status" placeholder="Tax Status" value="<?php echo $dvla_data['taxStatus']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="tax-due">Tax Due Date:</label>
                    <input type="date" id="tax-due" name="tax-due" placeholder="Tax Due" value="<?php echo $dvla_data['taxDueDate']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="mot-status">MOT Status:</label>
                    <input type="text" id="mot-status" name="mot-status" placeholder="MOT Status" value="<?php echo $dvla_data['motStatus']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="mot-expiry">MOT Expiry Date:</label>
                    <input type="date" id="mot-expiry" name="mot-expiry" placeholder="MOT Expiry" value="<?php echo $dvla_data['motExpiryDate']; ?>" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
            </div>
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[160px] z-10" >Additional Features</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-row flex-wrap justify-center">
                <div class="flex flex-col justify-center">
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="aircon" name="aircon">
                        <label class="ml-2" for="aircon">Air Conditioning</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="heated-seats" name="heated-seats">
                        <label class="ml-2" for="heated-seats">Heated Seats</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="satnav" name="satnav">
                        <label class="ml-2" for="satnav">Satnav</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="smartphone" name="smartphone">
                        <label class="ml-2" for="smartphone">Smartphone Integration System</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="radio" name="radio">
                        <label class="ml-2" for="radio">Radio</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="cd-player" name="cd-player">
                        <label class="ml-2" for="cd-player">CD Player</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="bluetooth" name="bluetooth">
                        <label class="ml-2" for="bluetooth">Bluetooth</label>
                    </div>
                    <div class="w-full">
                        <input class="ml-4 rounded" type="checkbox" id="isofix" name="isofix">
                        <label class="ml-2" for="isofix">Isofix</label>
                    </div>
                </div>
            </div>
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[130px] z-10" >Vehicle Address</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-row flex-wrap justify-center">
                <!-- Show address list if user has added an address previously -->
                <?php
                    echo '<select name="address-select" id="address-select" "required" class="w-full md:w-2/3 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">';
                    echo "<option value=''>Select address where vehicle is located</option>";
                        if ($addressCount["COUNT(*)"] > 0) {
                                foreach ($addresses as $address) {
                                    $addressId = $address['address_id'];
                                    $addressLine1 = $address['address_line_1'];
                                    $addressCountry = $address['address_country'];
    
                                    echo "<option value='$addressId'>$addressLine1, $addressCountry</option>";
                                };
                            }
                        echo "<option value='add-new'>Add new address</option>";
                    echo '</select>';
                ?>
                
    
                <div class="card-container" id="add-address" hidden>
                    <div class="panel">
                        <input type="text" placeholder="Address Line 1" name="address-line-1" id="location-input" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Apt, Suite, etc (optional)" name="address-sub-line" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="City" id="locality-input" name="city" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Zip/Postal code" id="postal_code-input" name="post-code" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="State/Province" id="administrative_area_level_1-input" name="admin-area" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Country" id="country-input" name="country" class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Lat" id="latitude" name="latitude" value="" hidden class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Lng" id="longitude" name="longitude" value="" hidden class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                    </div>
                </div>
            </div>
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[140px] z-10">Hire Preferences</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-col items-center flex-wrap justify-center">
                    <div class="w-full flex flex-col justify-center items-center">
                        <div class="w-1/2">
                            <input class="rounded" type="checkbox" id="smoking" name="smoking">
                            <label class="" for="smoking">Smoking/Vaping Permitted</label>
                        </div>
                        <div class="w-1/2">
                            <input class="rounded" type="checkbox" id="pets" name="pets">
                            <label class="" for="pets">Pets Permitted</label>
                        </div>
                    </div>
                <div class="flex flex-col">
                    <div class="w-full flex flex-row flex-wrap justify-center items-center mt-2">
                        <div class="flex flex-col w-1/2">
                            <label for="mileage-allowance">Daily Mileage Allowance:</label>
                            <input type="number" id="mileage-allowance" name="mileage-allowance" min=10 class="w-3/4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                        </div>
                        <div class="flex w-2/3 md:w-1/2">
                            <div class="w-1/2 mx-1">
                                <label class="ml-4" for="hourly-rate">Hourly Rate:</label>
                                <div>
                                    <span class="mr-1">£</span><input type="number" id="hourly-rate" name="hourly-rate" min=0.00 placeholder="5.50" step=.10 required class="w-5/6 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                                </div>
                            </div>
                            <div class="w-1/2 ml-1 mr-2">
                                <label class="ml-4" for="daily-rate">Daily Rate:</label>
                                <div class="">
                                    <span class="mr-1">£</span><input type="number" id="daily-rate" name="daily-rate" min=0.00 step=.10 placeholder="55.00"required class="w-5/6 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-4">Available Days:</h3>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="monday-availability" name="monday-availability">
                        <label class="ml-2" for="monday-availability">Monday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="monday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="monday-from" name="monday-from">
                            <label class="ml-2" for="monday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="monday-to" name="monday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="tuesday-availability" name="tuesday-availability">
                        <label class="ml-2" for="tuesday-availability">Tuesday</label>
                        <div class="availability-time" hidden>
                        <label class="ml-4" for="tuesday-from">From:</label>
                        <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="tuesday-from" name="tuesday-from">
                        <label class="ml-2" for="tuesday-to">To:</label>
                        <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="tuesday-to" name="tuesday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="wednesday-availability" name="wednesday-availability">
                        <label class="ml-2" for="wednesday-availability">Wednesday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="wednesday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="wednesday-from" name="wednesday-from">
                            <label class="ml-2" for="wednesday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="wednesday-to" name="wednesday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="thursday-availability" name="thursday-availability">
                        <label class="ml-2" for="thursday-availability">Thursday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="thursday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="thursday-from" name="thursday-from">
                            <label class="ml-2" for="thursday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="thursday-to" name="thursday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="friday-availability" name="friday-availability">
                        <label class="ml-2" for="friday-availability">Friday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="friday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="friday-from" name="friday-from">
                            <label class="ml-2" for="friday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="friday-to" name="friday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="saturday-availability" name="saturday-availability">
                        <label class="ml-2" for="saturday-availability">Saturday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="saturday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="saturday-from" name="saturday-from">
                            <label class="ml-2" for="saturday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="saturday-to" name="saturday-to">
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="sunday-availability" name="sunday-availability">
                        <label class="ml-2" for="sunday-availability">Sunday</label>
                        <div class="availability-time" hidden>
                            <label class="ml-4" for="sunday-from">From:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="sunday-from" name="sunday-from">
                            <label class="ml-2" for="sunday-to">To:</label>
                            <input class="ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" type="time" step="900" id="sunday-to" name="sunday-to">
                        </div>
                    </div>
                    <fieldset name="available-months" class="mt-4" required>
                        <legend>Available Months:</legend>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="january-availability" name="january-availability">
                            <label class="ml-2" for="january-availability">January</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="february-availability" name="february-availability">
                            <label class="ml-2" for="february-availability">February</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="march-availability" name="march-availability">
                            <label class="ml-2" for="march-availability">March</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="april-availability" name="april-availability">
                            <label class="ml-2" for="april-availability">April</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="may-availability" name="may-availability">
                            <label class="ml-2" for="may-availability">May</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="june-availability" name="june-availability">
                            <label class="ml-2" for="june-availability">June</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="july-availability" name="july-availability">
                            <label class="ml-2" for="july-availability">July</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="august-availability" name="august-availability">
                            <label class="ml-2" for="august-availability">August</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="september-availability" name="september-availability">
                            <label class="ml-2" for="september-availability">September</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="october-availability" name="october-availability">
                            <label class="ml-2" for="october-availability">October</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="november-availability" name="november-availability">
                            <label class="ml-2" for="november-availability">November</label>
                        </div>
                        <div>
                            <input class="ml-4 rounded" type="checkbox" id="december-availability" name="december-availability">
                            <label class="ml-2" for="december-availability">December</label>
                        </div>
                    </fieldset>
                    </div>
                </div>
                <button class="bg-secondary-500 ml-2 mb-4 rounded-md cursor-pointer w-28 py-2 mt-2" type="submit" name="add-vehicle-submit" id="add-vehicle-submit">Add Vehicle</button>
            </form>
        </div>
    
    <script src="/scripts/google_address_finder.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClic2YN5sAkhh5Ok-APGg7ivwpHtjN7oA&libraries=places,marker&callback=initMap&solution_channel=GMP_QB_addressselection_v2_cA" async defer></script>
</section>

<?php
	include_once 'footer.php';
?>