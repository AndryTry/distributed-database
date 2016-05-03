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

    function edit($id){
        return $this->templates->render('edit_mahasiswa', ['id' => $id]);
    }
}