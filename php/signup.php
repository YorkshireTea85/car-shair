<?php 
    include_once 'header.php'; 

    $dateCreated = date('Y-m-d H:i:s');
?>

<section class="flex flex-col justify-center items-center">
    <div class="mt-4 mb-8">
        <h2 >Signup to CarShair and start hiring or renting cars today.</h2>
    </div>
    <form class="m-auto flex flex-col" id="signup-form" action="../includes/signup.inc.php" method="POST" novalidate>
        <div  class="flex flex-col my-1">
            <label class="" for="signup-first">First Name:</label>
            <input id="signup-first" type="text" name="first" placeholder="James" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
            <span id="first-error" class="mt-0 text-red-600"></span>
        </div>
        <div class="flex flex-col my-1">
            <label class="mr-2" for="signup-last">Last Name:</label>
            <input id="signup-last" type="text" name="last" placeholder="Smith" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
            <span id="last-error" class="mt-0 text-red-600"></span>
        </div>
        <div class="flex flex-col my-1">
            <label class="mr-2" for="signup-email">Email Address:</label>
            <input id="signup-email" type="email" name="email" placeholder="email@example.com" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
            <span id="email-error" class="mt-0 text-red-600"></span>
        </div>
        <div class="flex flex-col my-1">
            <label class="mr-2" for="signup-uid">Username:</label>
            <input id="signup-uid" type="text" name="uid" placeholder="Username" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">  
            <span id="uid-error" class="mt-0 text-red-600"></span>
        </div>
        <div class="flex flex-col my-1">
            <label class="mr-2" for="signup-pwd">Password:</label>
            <input id="signup-pwd" type="password" name="pwd" placeholder="Password" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
            <span id="pwd-error" class="mt-0 text-red-600"></span>
        </div>
        <div class="flex flex-col my-1">
            <label class="mr-2" for="signup-pwd2">Retype Password:</label>
            <input id="signup-pwd2" type="password" name="pwd2" placeholder="Password" maxlength="256" required class="w-60 h-8 shadow-sm shadow-current appearance-none border-2 border-solid border-primary-500 rounded-md py-1 px-2 mb-2 text-gray-700 focus:outline-none focus:border-primary-100 focus:ring-primary-100 focus:shadow-md">
            <span id="pwd2-error" class="mt-0 text-red-600"></span>
        </div>
        
        <div class="mt-1">
            <p>Account type:</p>
            <input id="signup-driver" class="mr-2" type="radio" id="driver" name="role" value="driver" required>
            <label for="signup-driver">Driver - I want to hire a car</label><br>
            <input id="signup-owner" class="mr-2" type="radio" id="owner" name="role" value="owner" required>
            <label for="signup-owner">Owner - I want to rent my car</label><br>
            <span id="signup-user-type" class="mt-0 text-red-600"></span>
        </div>

        <input hidden type="text" value="<?php echo $dateCreated; ?>" class="" id="date-created" name="date-created">
        <button class= "bg-primary-500 hover:bg-primary-200 text-secondary-500 font-bold py-2 px-4 rounded mt-8 mb-4" type="submit" name="submit">Sign Up</button>
    </form>
</section>

<?php
	include_once 'footer.php';
?>