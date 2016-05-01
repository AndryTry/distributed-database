<?php
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Siakad\Controllers\Mahasiswa as Mahasiswa;
use \Siakad\Controllers\Siakad as Siakad;

$mahasiswa = new Mahasiswa();
$siakad = new Siakad();
$app = new \Slim\App;

$app->get('/', function () use ($siakad) {
    return $siakad->index();
});

$app->get('/mahasiswa', function () use ($mahasiswa) {
    return $mahasiswa->index();
});

$app->run();