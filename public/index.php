<?php
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Siakad\Controllers\Mahasiswa as Mahasiswa;
use \Siakad\Controllers\Transaksi as Transaksi;
use \Siakad\Controllers\Siakad as Siakad;
use \Siakad\Controllers\Matakuliah as Matakuliah;

$mahasiswa = new Mahasiswa();
$matakuliah = new Matakuliah();
$transaksi = new Transaksi();
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

$app->get('/matakuliah/delete/{kode}', function(Request $request) use ($app, $matakuliah){
    return $matakuliah->delete(
        $kode=$request->getAttribute("kode")
    );
});

//
// Transaksi
//

$app->get('/transaksi', function () use ($transaksi){
    return $transaksi->index();
});

$app->get('/transaksi/add', function() use ($transaksi){
    return $transaksi->add(
        $kode=$_GET["kode"],
        $jumlah = $_GET["jumlah"]
    );
});

$app->post('/transaksi/add/{kode}', function(Request $request) use ($transaksi){
    $jml=$_POST["jumlah"];
    $makul = array();
    for ($i=1; $i <= $jml; $i++){
        array_push($makul, $_POST["matakuliah".$i]);
    }

    return $transaksi->add(
        $kode=$request->getAttribute("kode"),
        $jumlah=$jml,
        $nim=$_POST["nim"],
        $tahun_akademik=$_POST["tahun_akademik"],
        $semester=$_POST["semester"],
        $matakuliah=$makul,
        $method="POST"
    );
});

$app->get('/transaksi/edit/{kode}', function(Request $request) use ($transaksi){
    return $transaksi->edit(
        $id=$request->getAttribute("kode")
    );
});

$app->post('/transaksi/edit/{kode}', function (Request $request) use ($transaksi){
    $jml=$_POST["jumlah"];
    $makul = array();
    for ($i=1; $i <= $jml; $i++){
        array_push($makul, $_POST["matakuliah".$i]);
    }

    return $transaksi->add(
        $kode=$request->getAttribute("kode"),
        $jumlah=$jml,
        $nim=$_POST["nim"],
        $tahun_akademik=$_POST["tahun_akademik"],
        $semester=$_POST["semester"],
        $matakuliah=$makul,
        $method="POST"
    );
});

$app->get('/transaksi/delete/{kode}', function (Request $request) use ($transaksi){
    return $transaksi->delete(
        $kode=$request->getAttribute("kode")
    );
});


$app->run();