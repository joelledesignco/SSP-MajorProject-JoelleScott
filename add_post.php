<?php

//is user logged in, and do they have rights
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("Location: http://".$_SERVER["SERVER_NAME"]."/login.php");
}

require_once("header.php");
?>

<section>
    <div class="container" id="create-blog">
        <h1 class="mt-5 text-center">Create Blog Post</h1>
        <hr class="myhr mx-auto">
        <div class="row pt-5 mt-5">
            <div class="col-9 blurry-bg mx-auto py-5">
                <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php"); ?>
                <form action="/actions/create_post_action.php" enctype="multipart/form-data" method="post" class="col-12">
                    <div class="form-row">
                        <div class="col-4 pink-bg text-white shadow-lg">
                            <div class="mt-5 pt-2">
                                <h5 class="text-center">Add Featured Image</h5>
                                <hr class="myhr2 mx-auto">
                            </div>
                            <div class="mx-auto text-center my-5" style="color: black;">
                                <i class="fas fa-file-image add-img"></i>
                            </div>
                            <div class="form-group mx-auto p-3">
                                <img src="<?php echo $user_row["featured_image"]?>" alt="" class="w-100">
                                <input type="file" class="mb-5" name="featured_image" id="featured_image" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-8 post-details">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="10"></textarea>
                            </div>
                            <button class="mybutton" name="action" value="publish">Publish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once("footer.php");
?>