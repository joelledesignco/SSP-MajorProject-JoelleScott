<?php
require_once("header.php");
?>

<section>
    <div class="container discover">
        <h1 class="text-center my-3">Engage . Educate . Empower</h1>
        <hr class="myhr">
        <h3 class="text-center">Sticks & Stones Blog</h3>
    </div>
</section>


 <!-------------- SINGLE BLOG POST --------------->
<section>
    <div class="container">
        <div class="row mt-5">
        <?php

        if(isset($_GET["id"])) {

            $article_query = "SELECT articles.* , users.first_name, users.last_name, 
                                                    images.url AS featured_image
                                FROM articles 
                                LEFT JOIN users
                                ON articles.author_id = users.id
                                LEFT JOIN images
                                ON articles.image_id = images.id 
                                WHERE articles.id = " . $_GET["id"];
                                // take the articles img id and match it with the images table id
            if($article_result = mysqli_query($conn, $article_query)) {
                while($article_row = mysqli_fetch_array($article_result)) {
                    //print_r($article_row);
            ?>
            <div class="col-12 blurry-bg mx-auto">
                <figure class="col-10 mx-auto pt-5">
                    <img src="<?=$article_row["featured_image"]?>">
                </figure>
                <div class="content p-5 mx-4">
                    <h4><?=$article_row["title"]?></h4>
                    <a href="/profile.php?user_id=<?=$article_row["author_id"];?>">
                        <h6><?="by " .$article_row["first_name"]." ".$article_row["last_name"]?></h6>
                    </a>
                    <small> Published on <?=date("M jS, Y @ hA", strtotime($article_row["date_created"]))?></small> 
                    <p class="pt-3 pb-4"><?php echo $article_row["content"];?></p>
                    <div class="row">
                        <div class="col">
                            <h6>Share this Article</h6>
                            <div class="social-contact py-2">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-square pr-3 icon"></i></a>
                                <a href="https://twitter.com/"><i class="fab fa-twitter pr-3 icon"></i></a>
                                <a href="https://www.instagram.com/"><i class="fab fa-instagram pr-3 icon"></i></a>
                            </div>
                        </div>
                        <div class="col" style="text-align: right;">
                        <?php
                        // if logged in and the post is yours or you are super admin show edit menu
                            if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"] ) {  // if logged in and the post is yours. compare the user_id to author of post
                                echo "  <a class='edit-button' href='edit_post.php?article_id=".$article_row["id"]."'>Edit Article</a>"; 
                            }
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto p-5">
                <a href="/articles.php">
                    <button class="mybutton mx-auto">Back to Blog</button>
                </a>
            </div>
        </div>
    </div>
</section>
            <?php
            } else {
                echo mysqli_error($conn);
            }

    } else { 
    
        // ELSE if no ID set, show ALL articles
        //if query include search
        $search_query = (isset($_GET["search"])) ? $_GET["search"] : false;

        if($search_query) {
            // if search query has any value echo
            echo "<div class='col-12'><h1>Search Results for: $search_query</h1></div>";
        }
        ?>

 <!-------------- B L O G --------------->
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 blurry-bg">
                <div class="row">
                    <div class="col-12 pl-5 mt-5 pt-3 ml-5">
                        <form action="/articles.php" class="form-inline">
                            <button class="mybutton" type="submit"><i class="fa fa-search"></i></button>    
                            <input class="form-control" name="search" id="search_field" type="search" aria-label="Search" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
                        </form>
                    </div>
                </div>

            
        <?php
        //output all articles
        $articles_query = "SELECT articles.title, articles.description, images.url AS featured_image, 
                                    articles.author_id, users.first_name, users.last_name, articles.date_created, articles.id
                            FROM articles
                            LEFT JOIN images
                            ON articles.image_id = images.id
                            LEFT JOIN users
                            ON articles.author_id = users.id";
        $art_where_search = "";
        if($search_query)  {          
            $art_where_search =  "   WHERE articles.title LIKE '%$search_query%'
                                    OR articles.content LIKE '%$search_query%'";
            $articles_query .= $art_where_search;
        }

        $current_page = (isset($_GET["page"])) ? $_GET["page"] : 1;
        $limit = 5;
        $offset = $limit * ($current_page - 1);

        $articles_query .=  "   ORDER BY articles.date_modified DESC 
                                LIMIT $limit OFFSET $offset";

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
                                    <a href="/profile.php?user_id=<?=$article_row["author_id"];?>">
                                        <h6><?="by " .$article_row["first_name"]." ".$article_row["last_name"]?></h6>
                                    </a>
                                    <p><?=$article_row["description"]?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php

            } // end of while

            $pagi_query="SELECT COUNT(*) AS total FROM articles";
            if($search_query) {
                $pagi_query .= $art_where_search;
            }
            $pagi_result = mysqli_query($conn, $pagi_query);
            $pagi_row = mysqli_fetch_array($pagi_result);
            $total_articles = $pagi_row["total"];

            $page_count = ceil($total_articles / $limit); 
        
            echo "<nav class='pl-4 ml-2' aria-label='Page navigation'><ul class='pagination p-5'>";

            $get_search = ($search_query) ? "&search=".$search_query : "";

            if($current_page > 1) {
                echo "<li class='page-item'><a class='page-link' href='/articles.php?page=".( $current_page - 1)."$get_search'>Previous</a></li>";
            }

            for($i = 1; $i <= $page_count; $i ++) {
                echo "<li class='page-item";
                if($current_page == $i) echo "active";
                echo "'><a class='page-link' href='/articles.php?page=$i".$get_search."'>$i</a></li>";
            }

            if($current_page < $page_count) {
                echo "<li class='page-item'><a class='page-link' href='/articles.php?page=".($current_page + 1)."$get_search'>Next</a></li>";
            }
            echo '</ul></nav>';

        } else {
            echo mysqli_error($conn);
        }
        }
        ?>
                </div>
            </div>
        </div>
    </div>
</section> 

<?php
require_once("footer.php");
?>