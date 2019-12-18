<?php
require_once("header.php");
?>

<div class="container my-5">
    <form action="/actions/login.php" class="col-6 mx-auto blurry-bg p-5" method="post">
        <div class="row p-5 mx-auto">
            <div class="col">
                <a href="/user_login.php" class="px-4 login-link pb-2">Login</a>
            </div>
            <div class="col">
                <a href="/signup.php" class="on px-4 login-link pb-2">Signup</a>
            </div>  
        </div>
        <?php
        include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
        ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="inputEmail4" name="first_name">
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="inputPassword4" name="last_name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="password2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="inputCity">
            </div>
            <div class="form-group col-md-6">
                <label for="province">Province</label>
                <select id="province" name="province_id" class="form-control">
                    <option selected disabled>Choose...</option>
                    <?php
                    $provinces = [
                        "British Columbia", "Alberta", "Saskatchewan", "Manitoba", "Ontario", "Quebec", "Nova Scotia", "New Brunswick", "Prince Edward Island", "Nunavut", "Labradour", "Yukon", "Northwest Territories"
                    ];
                    for($i = 0; $i < count($provinces); $i++){
                        echo "<option value='".($i + i)."'>$provinces[$i]</option>";
                    }
                    ?>
                </select>
            </div>
        <div class="form-group col-md-12">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>
        <div class="form-row">
            <div class="form-group ml-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="agree_terms" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        I have read and agree to the Privacy Policy and Terms and Conditions.
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group mx-auto mt-3">
            <a href="">
                <button type="submit" name="action" value="signup" class="mybutton">Signup</button>
            </a>
        </div>        
    </form>
</div>
</div>

<?php
require_once("footer.php");
?>
