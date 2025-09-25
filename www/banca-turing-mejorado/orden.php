<?php

// orden por defecto
$order = 'dni';

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];

}

return $order;
