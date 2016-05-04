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
        $row2 = $dbh2->query($sql);

        $data = array();

        foreach ($row->fetchAll() as $r){
            $r["server"] = 1;
            array_push($data, $r);
        }

        foreach ($row2->fetchAll() as $r){
            $r["server"] = 2;
            array_push($data, $r);
        }

        return $this->templates->render('mahasiswa', [
            'mahasiswa' => $data
        ]);
    }

    function edit($nim, $method="GET"){
        $dbh = $this->connect($nim[0]);

        if($method == "POST"){
            $stmt = $dbh->prepare("UPDATE mahasiswa SET nama=:nama, alamat=:alamat, flag=0 WHERE nim=:nim");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":nim", $nim);
            $stmt->execute();

            return $this->templates->render('message', ['message' => "Berhasil disimpan"]);
        } else {
            # check flag
            $sql = sprintf("SELECT * FROM mahasiswa WHERE nim=%s AND flag=1", $nim);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
            }

            $stmt = $dbh->prepare("UPDATE mahasiswa SET flag=1 WHERE nim=:nim");
            $stmt->bindParam(":nim", $nim);
            $stmt->execute();

            $sql = sprintf("SELECT nim, nama, alamat, flag FROM mahasiswa WHERE nim=%s", $nim);
            $row = $dbh->query($sql);
            $data = $row->fetch();

            return $this->templates->render('edit_mahasiswa', [
                'nim' => $nim,
                'nama' => $data["nama"],
                'alamat' => $data["alamat"]
            ]);
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

            return $this->templates->render('message', ['message' => "Berhasil disimpan"]);
        } else {
            // check nim sudah di pakai
            $sql = sprintf("SELECT * FROM mahasiswa WHERE nim=%s", $nim);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render('message', ['message' => "Nim sudah di pakai"]);
            }

            $stmt = $dbh->prepare("INSERT INTO mahasiswa (nim, flag) VALUES (:nim, 1)");
            $stmt->bindParam(":nim", $nim);
            $stmt->execute();

            return $this->templates->render('edit_mahasiswa', ['nim' => $nim]);
        }
    }

    public function delete($nim){

        $dbh = $this->connect($nim[0]);

        // check flag
        $sql = sprintf("SELECT * FROM mahasiswa WHERE nim=%s AND flag=1", $nim);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
        }

        $stmt = $dbh->prepare("DELETE FROM mahasiswa WHERE nim=:nim");
        $stmt->bindParam(":nim", $nim);
        $stmt->execute();

        return $this->templates->render('message', ['message' => "Berhasil dihapus"]);
    }
}