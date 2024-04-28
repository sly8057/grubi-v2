<?php
session_start();
session_destroy();
$msg = "Sesion destruida ";
header("refresh:1; url=form.html");
            echo '<div>'.$msg.'</div>';
            echo '<p>Serás redirigido al índice en 5 segundos.</p>';
?>