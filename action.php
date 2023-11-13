// File untuk mengupdate status di index.php lewat db
<?php
// Mengecheck apakah ada data variabel smartdoor dan status didalam file index.php
    if(isset($_GET['smartdoor']) && isset($_GET['status'])){
        include ('connectdb.php');
// Memasukan data ke variabel $status dan $smartdoor
        $status=$_GET['status'];
        $smartdoor=$_GET['smartdoor'];
// Kondisi jika variabel smartdoor pada index.php itu 1, maka statusnya akan di update dan datanya diubah sesuai dengan $status yg ditekan di web.
        if($smartdoor=='1'){
            mysqli_query($dbconnect, "UPDATE kontrol SET door='$status'");
        }
        header('location: index.php');
        exit;
    }
?>
