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

$app->get('/mahasiswa/add', function() use ($app, $mahasiswa){
    return $mahasiswa->add(
        $nim=$_GET["nim"]
    );
});

$app->post('/mahasiswa/add', function() use ($app, $mahasiswa){
    return $mahasiswa->add(
        $nim = $_POST["nim"],
        $nama=$_POST["nama"],
        $alamat=$_POST["alamat"],
        $method = "POST"
    );
});

$app->get('/mahasiswa/edit/{nim}', function(Request $request) use ($app, $mahasiswa){
    return $mahasiswa->edit(
        $nim=$request->getAttribute("nim")
    );
});

$app->post('/mahasiswa/edit/{nim}', function(Request $request) use ($app, $mahasiswa){
    return $mahasiswa->add(
        $nim = $request->getAttribute("nim"),
        $nama=$_POST["nama"],
        $alamat=$_POST["alamat"],
        $method = "POST"
    );
});

$app->get('/mahasiswa/delete/{nim}', function(Request $request) use ($app, $mahasiswa){
    return $mahasiswa->delete(
        $nim=$request->getAttribute("nim")
    );
});

//
// Matakuliah
//

$app->get('/matakuliah', function() use ($matakuliah){
    return $matakuliah->index();
});

$app->get('/matakuliah/add', function() use ($app, $matakuliah){
    return $matakuliah->add(
        $nim=$_GET["kode"]
    );
});

$app->post('/matakuliah/add/{kode}', function(Request $request) use ($app, $matakuliah){
    return $matakuliah->add(
        $kode = $request->getAttribute("kode"),
        $nama=$_POST["nama"],
        $semester=$_POST["semester"],
        $sks=$_POST["sks"],
        $method = "POST"
    );
});

$app->get('/matakuliah/edit/{kode}', function(Request $request) use ($app, $matakuliah){
    return $matakuliah->edit(
        $kode=$request->getAttribute("kode")
    );
});

$app->post('/matakuliah/edit/{kode}', function(Request $request) use ($app, $matakuliah){
    return $matakuliah->add(
        $kode = $request->getAttribute("kode"),
        $nama=$_POST["nama"],
        $semester=$_POST["semester"],
        $sks=$_POST["sks"],
        $method = "POST"
    );
});

$app->get('/matakuliah/delete/{nim}', function(Request $request) use ($app, $mahasiswa){
    return $mahasiswa->delete(
        $nim=$request->getAttribute("nim")
    );
});

$app->run();