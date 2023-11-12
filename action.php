<?php
    if(isset($_GET['smartdoor']) && isset($_GET['status'])){
        include ('connectdb.php');
        $status=$_GET['status'];
        $smartdoor=$_GET['smartdoor'];

        if($smartdoor=='1'){
            mysqli_query($dbconnect, "UPDATE kontrol SET door='$status'");
        }
        header('location: index.php');
        exit;
    }
?>