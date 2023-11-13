// File untuk check apakah data request off/on pada website sudah berjalan atau belum menggunakan POSTMAN
<?php
// Check status apakah variabel token sudah diset atau belum
if(isset($_POST['token'])){
    include ('connectdb.php');
    $key = $_POST['token'];
// Jalankan Query SQL dimana token sesuai dengan variable $key, hasil query disimpan di variabel $sql
    $sql = mysqli_query($dbconnect,  "SELECT * FROM kontrol WHERE token='$key'");
    $query = mysqli_num_rows($sql);
// Mengecheck apakah variabel $query ada data atau tidak, jika ada maka akan dimasukan ke variabel $data, jika tidak maka tidak valid.
    if ($query > 0){
        $data = mysqli_fetch_assoc($sql);
    }else{
        $data = ["token"=>"Not validated"];
    }
// Konversi data query menjadi format json
// Alasannya adalah karena mudahnya debugging atau mencari bug pada kode dan struktur data yg dapat lebih jelas dibaca
    $res = json_encode($data);
    echo $res;
}
?>
