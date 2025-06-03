<?php
require_once './checksesion.php';

require_once '../db/connect.php';
require_once '../models/mhistFacturas.php';
$facturas = getFacturasOf($_SESSION['userid']);

require_once '../views/vfacturasFecha.php';
