<?php
    if( isset($_GET["errors"]) ){
        foreach($_GET["errors"] as $error) {
            echo "<script>Toast.fire({icon: 'error', title: '$error'})</script>";
        }
    } elseif(isset($_GET["success"])){
            echo "<script>Toast.fire({icon: 'success', title: '".$_GET["success"]."'})</script>";
    }
?>


