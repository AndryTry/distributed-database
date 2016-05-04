<?php
/**
 * Created by PhpStorm.
 * User: faisal
 * Date: 02/05/16
 * Time: 16:39
 */

namespace Siakad\Controllers;


class Matakuliah extends Base{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $dbh = $this->connect(1);
        $dbh2 = $this->connect(2);

        $sql = "SELECT kode, nama,  semester, sks, flag FROM matakuliah";
        $row = $dbh->query($sql);
        return $this->templates->render('matakuliah', [
            'matakuliah' => $row->fetchAll()
        ]);
    }

    public function add($kode, $nama="", $semester="", $sks="", $method="GET")
    {
        $dbh = $this->connect($kode[0]);

        if($method == "POST"){
            $stmt = $dbh->prepare("UPDATE matakuliah SET nama=:nama, semester=:semester, sks=:sks, flag=0 WHERE kode=:kode");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":semester", $semester);
            $stmt->bindParam(":sks", $sks);
            $stmt->bindParam(":kode", $kode);
            $stmt->execute();

            return $this->templates->render('message', ['message' => "Berhasil disimpan"]);
        } else {
            // check kode sudah di pakai
            $sql = sprintf("SELECT * FROM matakuliah WHERE kode=%s", $kode);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render('message', ['message' => "Kode sudah di pakai"]);
            }

            $stmt = $dbh->prepare("INSERT INTO matakuliah (kode, flag) VALUES (:kode, 1)");
            $stmt->bindParam(":kode", $kode);
            $stmt->execute();

            return $this->templates->render('edit_matakuliah', ['kode' => $kode]);
        }
    }

    public function edit($kode)
    {
        $dbh = $this->connect($kode[0]);
        # check flag
        $sql = sprintf("SELECT * FROM matakuliah WHERE kode=%s AND flag=1", $kode);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
        }

        $stmt = $dbh->prepare("UPDATE matakuliah SET flag=1 WHERE kode=:kode");
        $stmt->bindParam(":kode", $kode);
        $stmt->execute();

        $sql = sprintf("SELECT kode, nama, semester, sks, flag FROM matakuliah WHERE kode=%s", $kode);
        $row = $dbh->query($sql);
        $data = $row->fetch();

        return $this->templates->render('edit_matakuliah', [
            'kode' => $kode,
            'nama' => $data["nama"],
            'semester' => $data["semester"],
            'sks' => $data["sks"],
        ]);
    }

    public function delete($kode)
    {
        $dbh = $this->connect($kode[0]);

        // check flag
        $sql = sprintf("SELECT * FROM matakuliah WHERE kode=%s AND flag=1", $kode);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
        }

        $stmt = $dbh->prepare("DELETE FROM matakuliah WHERE kode=:kode");
        $stmt->bindParam(":kode", $kode);
        $stmt->execute();

        return $this->templates->render('message', ['message' => "Berhasil dihapus"]);
    }
}