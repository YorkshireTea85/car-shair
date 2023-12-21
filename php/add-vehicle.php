<?php
    session_start();
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
    <div>
    <form class="flex flex-col items-center mb-4" id="vrnForm" action="add-vehicle.php" method="POST">
        <label for="vrn_input">Enter Registration:</label>
        <input type="text" id="vrn_input" name="vrn_input" value="<?php echo $dvla_data['registrationNumber']; ?>" autofocus class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
        <?php
        if (isset($dvlaError)) {
            echo "<p class='mb-4 text-red-600'>$dvlaError</p>";
        }
        ?>
        <input class="self-center bg-secondary-500 rounded-md cursor-pointer px-2 py-2" type="submit" name="vrnSubmit" id="vrnSubmit" value="Get vehicle details">
    </form>
    </div>
    <div class="flex flex-col items-center w-full mb-4 <?php if ((!isset($_POST['vrnSubmit'])) || (isset($_POST['vrnSubmit']) && isset($dvlaError))) { echo 'hidden';} ?>">
        <form class="flex flex-col items-center p-2" id="add-vehicle-form" action="../includes/add-vehicle.inc.php" method="POST" enctype="multipart/form-data" novalidate>
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[175px] z-10" >Vehicle Specifications</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-row flex-wrap justify-center">
                <div  class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="" for="registration">Registration:</label>
                    <input type="text" id="registration" name="registration" value="<?php echo $dvla_data['registrationNumber']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="make"></span>Make:</label>
                    <input type="text" id="make" name="make" value="<?php echo mb_convert_case($dvla_data['make'], MB_CASE_TITLE, "UTF-8"); ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="model"><span class="required text-red-600">*</span>Model:</label>
                    <input type="text" id="model" name="model" placeholder="Model" required class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                    <span id="model-error" class="text-red-600"></span>
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="colour"></span>Colour:</label>
                    <input type="text" id="colour" name="colour" placeholder="Colour" value="<?php echo mb_convert_case($dvla_data['colour'], MB_CASE_TITLE, "UTF-8"); ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 w-2/3 mx-12 md:mx-24 sm:w-1/2">
                    <label class="mr-4" for="body"><span class="required text-red-600">*</span>Body Type:</label>
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
                        <option value="4x4">4x4</option>
                    </select>
                    <span id="body-error" class="text-red-600"></span>
                </div>
                <div class="flex flex-col items-center my-1 w-full">
                    <p><span class="required text-red-600">*</span>Transmission type:</p>
                    <div>
                        <div>
                            <input id="trans-manual" class="ml-4 mr-2" type="radio" name="transmission" value="manual" required>
                            <label for="trans-manual">Manual</label><br>
                        </div>
                        <div>
                            <input id="trans-auto" class="ml-4 mr-2" type="radio" name="transmission" value="automatic" required>
                            <label for="trans-auto">Automatic</label><br>
                        </div>
                        <span id="transmission-error" class="text-red-600"></span>
                    </div>
                </div>
                <div class="flex flex-col my-1 ml:10 sm:ml-20 mr-4 w-1/4 sm:w-1/5">
                    <label class="mr-4" for="doors"><span class="required text-red-600">*</span>Doors:</label>
                    <input type="number" id="doors" name="doors" min="3" max="5" placeholder="5" required class="w-1/8 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                    <span id="doors-error" class="text-red-600"></span>
                </div>
                <div class="flex flex-col my-1 ml-4 mr:10 sm:mr-20 w-1/4 sm:w-1/5">
                    <label class="mr-4" for="seats"><span class="required text-red-600">*</span>Seats:</label>
                    <input type="number" id="seats" name="seats" min="1" max="9" placeholder="5" required class="w-1/8 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                    <span id="seats-error" class="text-red-600"></span>
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-2/5">
                    <label class="mr-4" for="fuel-type"></span>Fuel Type:</label>
                    <input type="text" id="fuel-type" name="fuel-type" placeholder="Fuel Type" value="<?php echo mb_convert_case($dvla_data['fuelType'], MB_CASE_TITLE, "UTF-8"); ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-2/5">
                    <label class="mr-4" for="engine-capacity">Engine Capacity (cc):</label>
                    <input type="number" id="engine-capacity" name="engine-capacity" placeholder="Engine Capacity" value="<?php echo $dvla_data['engineCapacity']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-3/5 sm:w-1/2">
                    <label class="mr-4" for="emissions">CO2 Emissions (g/km):</label>
                    <input type="number" id="emissions" name="emissions" placeholder="CO2 Emissions" min="0" value="<?php echo $dvla_data['co2Emissions']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col items-center justify-center my-1 mx-4 w-full">
                    <div class="flex flex-row items-center justify-center">
                        <input type="checkbox" id="ulez" name="ulez" class="rounded">
                        <label class="ml-2" for="ulez">ULEZ Compliant</label><a class="ml-2 px-2 rounded text-primary-200" href="https://tfl.gov.uk/modes/driving/check-your-vehicle/" target="_blank">Check here</a>
                    </div>
                    </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="tax-status">Tax Status:</label>
                    <input type="text" id="tax-status" name="tax-status" placeholder="Tax Status" value="<?php echo $dvla_data['taxStatus']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="tax-due">Tax Due Date:</label>
                    <input type="date" id="tax-due" name="tax-due" placeholder="Tax Due" value="<?php echo $dvla_data['taxDueDate']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="mot-status">MOT Status:</label>
                    <input type="text" id="mot-status" name="mot-status" placeholder="MOT Status" value="<?php echo $dvla_data['motStatus']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                </div>
                <div class="flex flex-col my-1 mx-4 w-1/2 sm:w-1/3">
                    <label class="mr-4" for="mot-expiry">MOT Expiry Date:</label>
                    <input type="date" id="mot-expiry" name="mot-expiry" placeholder="MOT Expiry" value="<?php echo $dvla_data['motExpiryDate']; ?>" readonly class="h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
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
                    echo "<span class='required text-red-600 mr-[5px]'>*</span><select name='address-select' id='address-select' required class='w-5/6 md:w-2/3 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md'>";
                    echo "<option id='address-select-option' value=''>Select vehicle address</option>";
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
                <span id="address-select-error" class="text-red-600 w-full md:w-2/3"></span>
    
                <div class="card-container" id="add-address" hidden>
                    <div class="panel flex flex-wrap justify-center items-start">
                        <div class="flex flex-col items-start mb-2">
                            <div>
                                <span class="required text-red-600 mr-[5px]">*</span><input type="text" placeholder="Address Line 1" name="address-line-1" id="location-input" required class="h-8 mr-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                            </div>
                            <span id="address-line-1-error" class="text-red-600 ml-2"></span>
                        </div>
                        <input type="text" placeholder="Apt, Suite, etc (optional)" name="address-sub-line" class="h-8 mx-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <div class="flex flex-col items-start mb-2">
                            <div>
                                <span class="required text-red-600 mr-[5px]">*</span><input type="text" placeholder="City/Locality" id="locality-input" name="locality" required class="h-8 mr-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                            </div>
                            <span id="address-locality-error" class="text-red-600 ml-2"></span>
                        </div>
                        <div class="flex flex-col items-start mb-2">
                            <div>
                                <span class="required text-red-600 mr-[5px]">*</span><input type="text" placeholder="Zip/Postal code" id="postal_code-input" name="post-code" required class="h-8 mr-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                            </div>
                            <span id="address-post-code-error" class="text-red-600 ml-2"></span>
                        </div>
                        <input type="text" placeholder="State/Province" id="administrative_area_level_1-input" name="admin-area" class="h-8 mx-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <div class="flex flex-col items-start mb-2">
                            <div>
                                <span class="required text-red-600 mr-[5px]">*</span><input type="text" placeholder="Country" id="country-input" name="country" required class="h-8 mr-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                            </div>
                            <span id="address-country-error" class="text-red-600 ml-2"></span>
                        </div>
                        <input type="text" placeholder="Lat" id="latitude" name="latitude" value="" hidden class="h-8 mx-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
                        <input type="text" placeholder="Lng" id="longitude" name="longitude" value="" hidden class="h-8 mx-2 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md"/>
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
                    <div class="w-full flex flex-row flex-wrap justify-center items-start mt-2">
                        <div class="flex flex-col w-1/2">
                            <label for="mileage-allowance">Daily Mileage Allowance:</label>
                            <input type="number" id="mileage-allowance" name="mileage-allowance" min=10 class="w-3/4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                        </div>
                        <div class="flex w-5/6 md:w-1/2">
                            <div class="w-1/2 mx-1">
                                <span class="required text-red-600">*</span><label class="" for="hourly-rate">Hourly Rate:</label>
                                <div>
                                    <span class="mr-1">£</span><input type="number" id="hourly-rate" name="hourly-rate" min=1.00 max=100.00 placeholder="0.00" step=.25 required class="w-5/6 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                                    <span id="hourly-rate-error" class="text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                            <div class="w-1/2 ml-1 mr-2">
                                <span class="required text-red-600">*</span><label class="" for="daily-rate">Daily Rate:</label>
                                <div class="">
                                    <span class="mr-1">£</span><input type="number" id="daily-rate" name="daily-rate" min=5.00 max=1000.00 step=.25 placeholder="00.00" required class="w-5/6 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                                    <span id="daily-rate-error" class="text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-4">Available Days:</h3>
                    <span id="available-days-error" class="text-red-600 w-full md:w-2/3"></span>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="monday-availability" name="monday-availability">
                        <label class="ml-2" for="monday-availability">Monday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="monday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="monday-from" name="monday-from">
                                    <span id="monday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="monday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="monday-to" name="monday-to">
                                    <span id="monday-to-error" class="ml-4 text-red-600 w-full"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="tuesday-availability" name="tuesday-availability">
                        <label class="ml-2" for="tuesday-availability">Tuesday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="tuesday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="tuesday-from" name="tuesday-from">
                                    <span id="tuesday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="tuesday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="tuesday-to" name="tuesday-to">
                                    <span id="tuesday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="wednesday-availability" name="wednesday-availability">
                        <label class="ml-2" for="wednesday-availability">Wednesday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="wednesday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="wednesday-from" name="wednesday-from">
                                    <span id="wednesday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="wednesday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="wednesday-to" name="wednesday-to">
                                    <span id="wednesday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="thursday-availability" name="thursday-availability">
                        <label class="ml-2" for="thursday-availability">Thursday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="thursday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="thursday-from" name="thursday-from">
                                    <span id="thursday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="thursday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="thursday-to" name="thursday-to">
                                    <span id="thursday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="friday-availability" name="friday-availability">
                        <label class="ml-2" for="friday-availability">Friday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="friday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="friday-from" name="friday-from">
                                    <span id="friday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="friday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="friday-to" name="friday-to">
                                    <span id="friday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="saturday-availability" name="saturday-availability">
                        <label class="ml-2" for="saturday-availability">Saturday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="saturday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="08:00" max="21:00" id="saturday-from" name="saturday-from">
                                    <span id="saturday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="saturday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900" min="09:00" max="22:00" id="saturday-to" name="saturday-to">
                                    <span id="saturday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="availability-checkbox ml-4 rounded" type="checkbox" id="sunday-availability" name="sunday-availability">
                        <label class="ml-2" for="sunday-availability">Sunday</label>
                        <div class="availability-time" hidden>
                            <div class="flex justify-around">
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-4" for="sunday-from">From:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900"  min="08:00" max="21:00" id="sunday-from" name="sunday-from">
                                    <span id="sunday-from-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                                <div class="flex flex-col w-1/2">
                                    <label class="ml-2" for="sunday-to">To:</label>
                                    <input class="w-1/2 ml-4 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md" required type="time" step="900"  min="09:00" max="22:00" id="sunday-to" name="sunday-to">
                                    <span id="sunday-to-error" class="ml-4 text-red-600 w-full md:w-2/3"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <fieldset name="available-months" class="mt-4" required>
                        <legend>Available Months:</legend>
                        <span id="available-months-error" class="text-red-600 w-full md:w-2/3"></span>
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
            <p class="pl-2 relative justify-self-start top-[12px] bg-white w-[120px] z-10">Vehicle Image</p>
            <div class="mx-2 p-2 pt-4 border-2 border-primary-500 rounded-md w-full md:w-2/3 lg:w-1/2 flex flex-col items-center flex-wrap justify-center">
                <label class="mr-4" for="add-vehicle-image">Upload Image:</label>
                <input type="file" id="add-vehicle-image" name="vehicle-image" accept="image/*" class="w-3/4 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
                <span id="add-vehicle-image-error" class="text-red-600 w-full md:w-2/3"></span>
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