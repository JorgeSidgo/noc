<?php 

require_once 'dAutoload.php';

$exec = new Exec();

$controller = $exec->getController();
$method = $exec->getMethod();

$exec->callMethod($controller, $method);