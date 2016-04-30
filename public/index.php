<?php
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Siakad\Controllers\Mahasiswa as Mahasiswa;

$mahasiswa = new Mahasiswa();
$app = new \Slim\App;

$app->get('/hello/{name}', function (Request $request, Response $response) use ($mahasiswa) {
    return $mahasiswa->add();
});
$app->run();