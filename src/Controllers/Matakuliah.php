<?php
/**
 * Created by PhpStorm.
 * User: faisal
 * Date: 02/05/16
 * Time: 16:39
 */

namespace Siakad\Controllers;


class Matakuliah {

    function __construct(){
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../templates');
    }

    function index(){
        return $this->templates->render('matakuliah');
    }
}