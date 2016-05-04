<?php
/**
 * User: faisal
 * Date: 30/04/16
 * Time: 20:08
 *
 * Mahasiswa class for mahasiswa activity
 */

namespace Siakad\Controllers;

class Mahasiswa extends Base{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $dbh = $this->connect(1);
        $dbh2 = $this->connect(2);

        $sql = "SELECT nim, nama, alamat, flag FROM mahasiswa";
        $row = $dbh->query($sql);
        return $this->templates->render('mahasiswa', [
            'mahasiswa' => $row->fetchAll()
        ]);
    }

    function edit($id, $method="GET"){
        if($method == "POST"){
            return "belum";
        } else {
            return $this->templates->render('edit_mahasiswa', ['id' => $id]);
        }
    }

    public function add($nim, $nama="", $alamat="", $method="GET"){

        $dbh = $this->connect($nim[0]);

        if($method == "POST"){
            $stmt = $dbh->prepare("UPDATE mahasiswa SET nama=:nama, alamat=:alamat, flag=0 WHERE nim=:nim");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":nim", $nim);
            $stmt->execute();

            return $this->templates->render('message', ['message' => "Berhasil"]);
        } else {
            // todo check nim sudah di pakai blm

            $stmt = $dbh->prepare("INSERT INTO mahasiswa (nim, flag) VALUES (:nim, 1)");
            $stmt->bindParam(":nim", $nim);
            $stmt->execute();

            return $this->templates->render('edit_mahasiswa', ['nim' => $nim]);
        }
    }
}