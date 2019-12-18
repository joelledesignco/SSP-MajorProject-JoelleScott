<?php
require_once("header.php");

?>

<section>
    <div class="container discover">
        <h1 class="text-center my-3">Welcome to Sticks & Stones</h1>
        <hr class="myhr">
    </div>
</section>

<section class="py-5">
    <div class="jumbotron jumbotron-fluid" id="jumbo">
        <div class="container">
            <div class="row">
                <div class="col-md-9 mx-auto mt-4">
                    <h2 class="my-3">Who We Are</h2>
                    <hr class="mx-auto myhr2">
                    <p class="text-center">Sticks and Stones is an outdoor media platform created by inspiring women in the Canadian Rockies. We are committed to creating a space where women’s voices are amplified so we can empower each other through adventure. Sign up today and become a member of our outdoor community!</p>
                    <a href="/signup.php">
                        <button type="submit" name="action" value="signup" class="mybutton3 mx-auto my-4 mb-5">Signup Today</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 mt-5">
    <div class="container blurry-bg p-5 mt-5 pb-5">
        <h2 class="my-2 mt-5">Featured Blog Posts</h2>
        <hr class="myhr mb-5">
        <div class="card-deck p-5">
            <div class="col-4 p-3">
                <a href="/articles.php?id=18">
                    <img src="/images/sawtooth.jpg" class="blog-pic shadow" alt="">
                    <div class="overlay p-3">
                        <div class="overlay-text mx-auto">
                            <h5>8 Tips for Backpacking in the Sawtooth Mountains</h5>
                            <hr class="myhr">
                            <h6>By Mindy Lamoureux</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 p-3">
                <a href="/articles.php?id=15">
                    <img src="/images/hike2.png" class="blog-pic shadow" alt="">
                    <div class="overlay p-3">
                        <div class="overlay-text mx-auto">
                            <h5>An Exclusive Guide to Mount Assiniboine</h5>
                            <hr class="myhr">
                            <h6>By Joelle Scott</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 p-3">
                <a href="/articles.php?id=19">  
                    <img src="/images/rockbound.jpg" class="blog-pic shadow" alt="">
                    <div class="overlay p-3">
                        <div class="overlay-text mx-auto">
                            <h5>Hiking Boots VS Trail Runners</h5>
                            <hr class="myhr">
                            <h6>By Sherry Cheriton</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <a href="/articles.php">
            <button type="submit" name="action" value="signup" class="mybutton mx-auto my-5 mb-5">View Blog</button>
        </a>
    </div>
</section>

<section>
    <div class="container pt-5">
        <h2 class="text-center my-3 pt-5">Follow Sticks & Stones</h2>
        <hr class="myhr py-2">
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
</section>



<?php
require_once("footer.php");
?>