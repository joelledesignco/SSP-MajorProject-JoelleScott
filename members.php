<?php
require_once("header.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2><?php  
                if(isset($_GET["search"])) {
                    echo "Search Results for: " . $_GET["search"];
                } else {
                    echo "Members";
                }
            ?></h2>
        </div>

        <?php
        $users_query = "    SELECT users.*, images.url AS profile_pic
                            FROM users
                            LEFT JOIN images
                            ON users.profile_pic_id = images.id";
        $search = (isset($_GET["search"])) ? $_GET["search"] : false;
        
        if($search){
            $search_words = explode(" ", $search);

            for($i = 0; $i < count($search_words); $i++) {
                $users_query .= ($i > 0) ? " OR " : " WHERE ";
                $users_query .= "users.first_name LIKE '%".$search_words[$i]."%'";
                $users_query .= " OR users.last_name LIKE '%".$search_words[$i]."%'";
            }
           
        }   
        if($users_result = mysqli_query($conn, $users_query)) {
            while($user_row = mysqli_fetch_array($users_result)) {
                ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                <a href="/profile.php?user_id=<?=$user_row["id"];?>">
                                    <?=$user_row["first_name"]." ".$user_row["last_name"]?>
                                </a>
                            </h5>
                            <img src="<?php echo $user_row["profile_pic"]?>" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo mysqli_error($conn);
        }

        ?>

    </div>
</div>

        <form action="/articles.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i>Search</button>
        </form>

<?php
require_once("footer.php");
?>