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
        return $this->templates->render('matakuliah');
    }
}