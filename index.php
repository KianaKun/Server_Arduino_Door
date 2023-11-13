<?php
    include 'connectdb.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controlling Arduino</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <!--      Judul Website        -->
            <span class="navbar-brand mb-0 h1">Controlling Smart Door</span> 
        </div>
    </nav>
    
    <!-- Konek DB MYSQL Untuk checking Status -->
    <div class="container">
        <?php
            $sql = mysqli_query($dbconnect, "SELECT * FROM kontrol");
            while($row = mysqli_fetch_array($sql)){
        ?>
            <div class="card text-center mt-5">
                <div class="card-header">
                    Smart Door
                </div>
                <div class="card-body">
                    <h4 class="card-title">
                        <?php 
                            $status = ($row['door'] == '0') ? "OFF" : "ON"; #Kondisi Checking Status ON OFF Pada Bar
                            echo $status; #Inisiasi/Output Status
                        ?>
                    <!--          button action on/off        -->
                    </h4>
                    <a href="action.php?smartdoor=1&status=1" class="btn btn-success">ON</a>
                    <a href="action.php?smartdoor=1&status=0" class="btn btn-danger">OFF</a>
                </div>
            </div>
        <?php
            }
        ?>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-c3lM9buzkYhqoewdjTJaApm8q4ZbDeArI4UBU6pVOpJz5EIGykvx6yzOMstgHwQ" crossorigin="anonymous"></script>
</body>
</html>
