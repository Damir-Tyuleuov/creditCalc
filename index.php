<?php
include 'autoLoader.php';

use controllers\IndexController;


$controller = new IndexController();
$controller->actionIndex();

?>