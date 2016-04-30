<?php
/**
 * User: faisal
 * Date: 30/04/16
 * Time: 20:08
 *
 * Mahasiswa class for mahasiswa activity
 */

namespace Siakad\Controllers;

class Mahasiswa {

    function __construct(){
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../templates');
    }

    function add(){
        return $this->templates->render('profile', ['name' => 'Jonathan']);
    }
}