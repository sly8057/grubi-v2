<?php
    $server = "localhost";
    $data = "grubi-v2";
    $user = "root";
    $pass = "";

    $con = mysqli_connect($server, $user, $pass, $data);
    if(!$con) {
        die("Falla en la conexión".mysqli_connect_error());
    // } else {
    //     echo "Conexión exitosa";
    }
?>

<?php
// class Connection {
//     public static function connect() {

//         $con = new PDO(
//             "mysql:host=localhost;dbname=grubi-v2",
//             "root",
//             "",
//             array(
//                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//                 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
//             )
//         );

//         return $con;
//     }
// }
?>