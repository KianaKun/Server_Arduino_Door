<?php
if(isset($_POST['token'])){
    include ('connectdb.php');
    $key = $_POST['token'];

    $sql = mysqli_query($dbconnect,  "SELECT * FROM kontrol WHERE token='$key'");
    $query = mysqli_num_rows($sql);

    if ($query > 0){
        $data = mysqli_fetch_assoc($sql);
    }else{
        $data = ["token"=>"Not validated"];
    }
    $res = json_encode($data);
    echo $res;
}
?>