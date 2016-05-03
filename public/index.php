<?php
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Siakad\Controllers\Mahasiswa as Mahasiswa;
use \Siakad\Controllers\Siakad as Siakad;
use \Siakad\Controllers\Matakuliah as Matakuliah;

$mahasiswa = new Mahasiswa();
$matakuliah = new Matakuliah();
$siakad = new Siakad();
$app = new \Slim\App;

$app->get('/', function () use ($siakad) {
    return $siakad->index();
});

$app->get('/mahasiswa', function () use ($mahasiswa) {
    return $mahasiswa->index();
});

$app->get('/matakuliah', function() use ($matakuliah){
    return $matakuliah->index();
});

$app->get('/mahasiswa/edit/{id}', function(Request $request) use ($mahasiswa){
    return $mahasiswa->edit($request->getAttribute("id"));
});

$app->run();