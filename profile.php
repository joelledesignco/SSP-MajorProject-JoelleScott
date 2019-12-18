<?php
require_once("header.php");

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = " SELECT users.*, provinces.name AS province_name, images.url AS profile_pic
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id
                LEFT JOIN images
                ON users.profile_pic_id = images.id 
                WHERE users.id = " . $user_id;
      
if($user_request = mysqli_query($conn, $user_query) ):
    while ($user_row = mysqli_fetch_array($user_request)) :
?>

<div class="container prof">
    <div class="row">
        <div class="col-9 blurry-bg mx-auto mb-5">
            <div class="row proff">
                <div class="col-5 pink-bg3 text-white shadow-lg">
                    <div class="my-5">
                        <figure class="mx-auto prof-figure">
                            <img id="prof-pic" src="<?php echo $user_row["profile_pic"]?>" alt="">
                        </figure>
                        <?php
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                        ?>
                        <div class="mx-auto text-center">
                            <h2><?php echo $user_row["first_name"] ." ". $user_row["last_name"]; ?></h2>
                            <hr class="myhr2 mx-auto">  
                            <p>
                                <?=$user_row["city"] . ", " . $user_row["province_name"];?>
                            </p>
                            <small>Member since <?=date("M jS, Y", strtotime($user_row["date_created"]))?></small> 
                        </div>
                        <?php
                        if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1):
                        ?>
                        <a href="/edit_profile.php?user_id=<?=$user_row["id"];?>">
                            <button class="mybutton3 mx-auto my-5">Edit Profile</button>
                        </a>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-7 bio-details mt-5 mb-5">
                    <h2>Bio</h2>
                    <hr class="myhr">
                    <div class="pt-3">
                        <p class="text-center"><?php echo $user_row["bio"];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="my-blog" class="pt-5">
    <div class="container">
        <div class="row my-5">
            <div class="col-12 blurry-bg py-5">
                <h2><?php echo $user_row["first_name"]?>'s Blog Articles</h2>
                <hr class="myhr mb-5">
        
        <?php
        //output all articles
        $articles_query = "SELECT articles.title, articles.description, images.url AS featured_image, 
                                    articles.author_id, users.first_name, users.last_name, articles.date_created, articles.id
                            FROM articles
                            LEFT JOIN images
                            ON articles.image_id = images.id
                            LEFT JOIN users
                            ON articles.author_id = users.id
                            WHERE articles.author_id = $user_id";


        if($article_result = mysqli_query($conn, $articles_query)) {
            while($article_row = mysqli_fetch_array($article_result)) {        
            ?>
                <div class="row">
                    <div class="mycard col-10 mx-auto mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="/articles.php?id=<?=$article_row["id"]?>">
                                    <img src="<?=$article_row["featured_image"]?>" class="card-img pb-3">
                                </a>
                                <small class="text-muted"><?=date("M jS, Y", strtotime($article_row["date_created"]))?></small> 
                            </div>
                            <div class="col-sm-8">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                        <a class="pb-1 title-article" href="/articles.php?id=<?=$article_row["id"]?>"><?=$article_row["title"]?></a>
                                    </h5>
                                    <h6><?="by " .$article_row["first_name"]." ".$article_row["last_name"]?></h6>
                                    <p><?=$article_row["description"]?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } // end of while
            ?>
            </div>
        </div>
    </div>
</div>
</section>

<?php
    
    } else {
        echo mysqli_error($conn);
    }
    endwhile;

else :
    echo mysqli_error($conn);
endif;

require_once("footer.php");
?>