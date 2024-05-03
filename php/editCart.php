<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['act']) && isset($_GET['sku'])) {
		// establece el tipo de acción que se empleará
        $act = $_GET['act'];
        $sku = $_GET['sku'];

        switch ($act) {
            case 'add':
                // Incrementar la cantidad del producto en el carrito
                if (isset($_SESSION['carrito'][$sku])) {
                    $_SESSION['carrito'][$sku]['cantidad']++;
                    $_SESSION['carrito'][$sku]['subtotal'] = $_SESSION['carrito'][$sku]['precio'] * $_SESSION['carrito'][$sku]['cantidad'];
                }
                break;

            case 'substract':
                // Disminuir la cantidad del producto en el carrito
                if (isset($_SESSION['carrito'][$sku])) {
                    $_SESSION['carrito'][$sku]['cantidad']--;
                    if ($_SESSION['carrito'][$sku]['cantidad'] <= 0) {
                        unset($_SESSION['carrito'][$sku]);
                    } else {
                        $_SESSION['carrito'][$sku]['subtotal'] = $_SESSION['carrito'][$sku]['precio'] * $_SESSION['carrito'][$sku]['cantidad'];
                    }
                }
                break;

            case 'delete':
                // Eliminar el producto del carrito
                if (isset($_SESSION['carrito'][$sku])) {
                    unset($_SESSION['carrito'][$sku]);
                }
                break;

            default:
                break;
        }
    }

    header("Location: cart.php");
    exit;
?>