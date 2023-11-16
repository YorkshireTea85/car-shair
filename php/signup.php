<?php 
    include_once 'header.php'; 

    $dateCreated = date('Y-m-d H:i:s');
?>

<section class="flex flex-col justify-center items-center">
    <h2>Signup</h2>
    <div class="block flex justify-start">
        <form class="signup-form" action="../includes/signup.inc.php" method="POST">
            <input type="text" name="first" placeholder="Firstname">
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <p>Account type:</p>
                <input type="radio" id="driver" name="role" value="driver">
                <label for="driver">Driver - I want to hire a car</label><br>
                <input type="radio" id="owner" name="role" value="owner">
                <label for="owner">Owner - I want to rent my car</label><br>
            <button type="submit" name="submit">Sign Up</button>
            <input type="text" value="<?php echo $dateCreated; ?>" class="form-control" id="date-created" name="date-created">
            </form>
    </div>
</section>

<?php
	include_once 'footer.php';
?>