<?php
require_once("conn.php");
?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">

    <title>Hello, world!</title>
  </head>
  <body>

<section>

<?php

if(isset($_POST["action"]) && $_POST["action"] == "add_item"){
    $new_item = $_POST["input_item"];
    if($new_item != ""){
        $new_item_query = "INSERT INTO shopping_list (item) VALUES ('$new_item')";
        if(!mysqli_query($conn, $new_item_query)){
            echo mysqli_error($conn);
        } 
    } else {
        echo "Cannot be blank";
    }
} elseif(isset($_GET["action"]) && $_GET["action"] == "delete") {
    $item_id = $_GET["id"];
    $delete_query = "DELETE FROM shopping_list WHERE id = $item_id";
    if(mysqli_query($conn, $delete_query)){}

} elseif(isset($_POST["action"]) && $_POST["action"] == "update_item"){
    print_r($_POST);

    $item_id = $_POST["item_id"];
    $new_item_value = $_POST["$input_item"];
    $update_query = "UPDATE shopping_list SET item = '$new_item_value' WHERE id = $item_id";
    mysqli_query($conn, $update_query);
}

?>

    <div class="container mt-5 p-5">
        <h1>SSP Drill 2</h1>
        <?php
        $shopping_list_query = "SELECT * FROM shopping_list";
        if($results =mysqli_query($conn, $shopping_list_query)){
            echo "<ul>";
            while($shopping_list_row = mysqli_fetch_array($results)){
                echo "<li>".$shopping_list_row["item"]. "
                        <a href='action=delete&id=".$shopping_list_row["id"]."'>x</a>
                        <a href='action=edit&id=".$shopping_list_row["id"]."'>edit</a>
                    </li>";
            }
            echo "<ul>";
        } else {
            echo mysqli_error($conn);
        }
        ?>
        <form action="drill2.php" method="POST" class="form-group pt-5">
            <div class="input-group">
                <?php
                //if action is edit select the item from database and fill input field with item text. If action is not set, leave field blank 
                $item_value = '';
                $button_value = 'add_item';
                $button_text = 'Add Item';
                if(isset($_GET["action"]) && $_GET["action"] == "edit") {
                    $item_id = $_GET["id"];
                    ?>

                    <input type="hidden" name="item_id" value="<?=$item_id?>">

                    <?
    
                    $edit_query = "SELECT * FROM shopping_list WHERE id = $item_id";
                    if($edit_results = mysqli_query($conn, $edit_query)){
                        $button_value = "update_item";
                        $button_text = "Update Item";
                        while($item_row = mysqli_fetch_array($edit_results)){
                            $item_value = $item_row["item"];
                        }
                    }
                }
                ?>
                <input type="text" name="input_item" value="<?=$item_value?>" class="form-control">
                <div class="input-group-append">
                    <button class="mybutton" name="action" value="<?=$button_value?>"><?=$button_text?></button>
                </div>
            </div>
        </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="/scripts.js"></script>

</body>
</html>