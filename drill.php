<?php
require_once("header.php");
?>


<section>
    <div class="container mt-5 p-5">
        <h1>SSP Drill 1</h1>
        <ul>
            

<?php

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = " SELECT users.*, provinces.name AS province_name
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id";

if($user_request = mysqli_query($conn, $user_query) ):
    while ($user_row = mysqli_fetch_array($user_request)) :
?>

            <li>
                <?php echo $user_row["first_name"] ." ". $user_row["last_name"]?> lives in <?php echo $user_row["province_name"]?> and started on <?php echo date("l \of F Y");?>
            </li>
<?php

endwhile;

else :
    echo mysqli_error($conn);
endif;
?>


        </ul>
    </div>
</section>

<?php
require_once("footer.php");
?>