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

        $sql = "SELECT kode, nama,  semester, sks, flag FROM mata_kuliah";
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

        return $this->templates->render('matakuliah', [
            'matakuliah' => $data
        ]);
    }

    public function add($kode, $nama="", $semester="", $sks="", $method="GET")
    {
        if($kode[0] != "1" && $kode[0] != "2"){
            var_dump($kode[0] == "1");
            return $this->templates->render('message', ['message' => "Kode harus diawali 1 atau 2"]);
        }

        $dbh = $this->connect($kode[0]);

        if($method == "POST"){
            $stmt = $dbh->prepare("UPDATE mata_kuliah SET nama=:nama, semester=:semester, sks=:sks, flag=0 WHERE kode=:kode");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":semester", $semester);
            $stmt->bindParam(":sks", $sks);
            $stmt->bindParam(":kode", $kode);
            $stmt->execute();

            return $this->templates->render('message', ['message' => "Berhasil disimpan"]);
        } else {
            // check kode sudah di pakai
            $sql = sprintf("SELECT * FROM mata_kuliah WHERE kode=%s", $kode);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render('message', ['message' => "Kode sudah di pakai"]);
            }

            $stmt = $dbh->prepare("INSERT INTO mata_kuliah (kode, flag) VALUES (:kode, 1)");
            $stmt->bindParam(":kode", $kode);
            $stmt->execute();

            return $this->templates->render('edit_matakuliah', ['kode' => $kode]);
        }
    }

    public function edit($kode)
    {
        $dbh = $this->connect($kode[0]);
        # check flag
        $sql = sprintf("SELECT * FROM mata_kuliah WHERE kode=%s AND flag=1", $kode);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
        }

        $stmt = $dbh->prepare("UPDATE mata_kuliah SET flag=1 WHERE kode=:kode");
        $stmt->bindParam(":kode", $kode);
        $stmt->execute();

        $sql = sprintf("SELECT kode, nama, semester, sks, flag FROM mata_kuliah WHERE kode=%s", $kode);
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
        $sql = sprintf("SELECT * FROM mata_kuliah WHERE kode=%s AND flag=1", $kode);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render('message', ['message' => "Data sedang di pakai"]);
        }

        $stmt = $dbh->prepare("DELETE FROM mata_kuliah WHERE kode=:kode");
        $stmt->bindParam(":kode", $kode);
        $stmt->execute();

        return $this->templates->render('message', ['message' => "Berhasil dihapus"]);
    }

    public function get($server, $kode)
    {
        $dbh = $this->connect($server);
        $sql = sprintf("SELECT * FROM mata_kuliah WHERE kode=%s", $kode);
        $row = $dbh->query($sql);
        $data = $row->fetch();
        if ( $data == false){
            return json_encode(array());
        }

        return json_encode($data);
    }

    public function flag($server, $kode){
        $dbh = $this->connect($server);
        $sql = sprintf("UPDATE mata_kuliah SET flag=1 WHERE kode=%s", $kode);
        $dbh->query($sql);

        return "Flag success ".$kode;
    }

    public function unflag($server, $kode){
        $dbh = $this->connect($server);
        $sql = sprintf("UPDATE mata_kuliah SET flag=0 WHERE kode=%s", $kode);
        $dbh->query($sql);

        return "Unflag success ".$kode;
    }

}
