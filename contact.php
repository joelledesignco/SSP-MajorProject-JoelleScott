<?php
require_once("header.php");
?>

<section>
    <div class="container discover">
        <h1 class="text-center my-3">Contact Us</h1>
        <hr class="myhr">
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-7 blurry-bg mx-auto p-5 mb-5">
            <h2 class="text-center mt-4">We'd love to hear from you!</h2>
            <hr class="myhr mb-5">
            <form>
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
                <div class="form-group">
                    <label for="email">Message</label>
                    <textarea class="form-control" rows="10"></textarea>
                </div>
                <div class="form-group pt-3">
                    <button class="mybutton mx-auto">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <h2 class="text-center pt-5">Follow Sticks & Stones</h2>
    <hr class="myhr">
    <div class="row pb-3">
        <div class="col-md-12">
            <div class="social-contact mb-5 text-center">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-square px-5 icon"></i></a>
                <a href="https://twitter.com/"><i class="fab fa-twitter px-5 icon"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram px-5 icon"></i></a>
            </div>
        </div>
    </div>
</div>


<?php
require_once("footer.php");
?>