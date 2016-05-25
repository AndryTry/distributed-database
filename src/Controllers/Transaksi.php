<?php
/**
 * User: faisal
 * Date: 19/05/16
 * Time: 22:57
 */

namespace Siakad\Controllers;


class Transaksi extends Base {

    function __construct(){
        parent::__construct();
    }

    function index(){
        $dbh = $this->connect(1);
        $dbh2 = $this->connect(2);

        $sql = "SELECT kode, nim, tahun_akademik, semester FROM transaksi";

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


        return $this->templates->render('transaksi', [
            "transaksi" => $data
        ]);
    }

    function edit($kode, $method="GET"){
        $dbh = $this->connect($kode[0]);

        if ($method == "POST"){
//            todo sql
            $stmt = $dbh->prepare("");
            $stmt->execute();

            return $this->templates->render("message", ["message" => "Berhasil disimpan"]);
        } else {
            # check flag
            $sql = sprintf("SELECT * FROM transaksi WHERE kode=%s AND flag=1", $kode);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render("message", ["message" => "Data sedang di pakai"]);
            }


            $sql = sprintf("UPDATE transaksi SET flag=1 WHERE kode=%s", $kode);
            $stmt = $dbh->prepare($sql);
            $stmt->execute();


            $sql = sprintf("SELECT kode, nim, tahun_akademik, semester FROM transaksi WHERE kode=%s", $kode);
            $row = $dbh->query($sql);
            $transaksi = $row->fetch();

            $sql = sprintf("SELECT kode_matakuliah FROM detail_transaksi WHERE kode_transaksi=%s", $kode);
            $row = $dbh->query($sql);
            $detail_transaksi = $row->fetchAll();

            return $this->templates->render('edit_transaksi', [
                'kode' => $kode,
                'jumlah' => count($detail_transaksi),
                'nim' => $transaksi["nim"],
                'tahun_akademik', $transaksi["tahun_akademik"],
                'semester' => $transaksi["semester"],
                'transaksi' => $transaksi,
                'matakuliah' => $detail_transaksi
            ]);

        }
    }

    function add($kode, $jumlah=0, $nim="", $tahun_akademik="", $semester=0, $matakuliah=array(), $method="GET"){

        $dbh = $this->connect($kode[0]);

        if ($method == "POST"){
            # update transaksi
            $sql = "UPDATE transaksi SET nim=:nim, tahun_akademik=:tahun_akademik, semester=:semester, flag=0 WHERE kode=:kode";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":nim", $nim);
            $stmt->bindParam(":tahun_akademik", $tahun_akademik);
            $stmt->bindParam(":semester", $semester);
            $stmt->bindParam(":kode", $kode);
            $stmt->execute();

            # save detail transaksi
            foreach ($matakuliah as $makul){
                $sql = "INSERT INTO detail_transaksi (kode_transaksi, kode_matakuliah) VALUES (:kode_transaksi, :kode_matakuliah)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(":kode_transaksi", $kode);
                $stmt->bindParam(":kode_matakuliah", $makul);
                $stmt->execute();
            }

            return $this->templates->render("message", ["message" => "Berhasil disimpan"]);
        } else {
            # check kode sudah di pakai
            $sql = sprintf("SELECT * FROM transaksi WHERE kode=%s", $kode);
            $row = $dbh->query($sql);
            if ($row->fetch() != false){
                return $this->templates->render("message", ["message" => "Id sudah dipakai"]);
            }

            $sql = sprintf("INSERT INTO transaksi (kode, flag) VALUES (%s, 1)", $kode);
            $stt = $dbh->prepare($sql);
            $stt->execute();

            $sql = sprintf("INSERT INTO detail_transaksi (kode_transaksi, flag) VALUES (%s, 1)", $kode);
            $sta = $dbh->prepare($sql);
            $sta->execute();

            return $this->templates->render('edit_transaksi', ["kode" => $kode, "jumlah" => $jumlah]);
        }
    }

    function delete($kode){
        $dbh = $this->connect($kode[0]);

        # check flag
        $sql = sprintf("SELECT * FROM transaksi WHERE kode=%s AND flag=1", $kode);
        $row = $dbh->query($sql);
        if ($row->fetch() != false){
            return $this->templates->render("message", ["message" => "Data sedang di pakai"]);
        }

        $sql = sprintf("DELETE from transaksi WHERE kode=%s", $kode);
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        return $this->templates->render('message', ['message' => "Berhasil di hapus"]);
    }
}