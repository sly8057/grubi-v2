<?php
	include "../connection.php";

	if(isset($_GET['sku'])){
        $sku = $_GET['sku'];
        $sql = mysqli_query($con, "DELETE FROM macetas WHERE sku = '$sku'");
        if($sql){
            header("refresh:0.5; url=admin.php");
        }
    }else{
        echo "No se ha seleccionado un producto";
    }
?>