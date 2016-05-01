<?php
/**
 * Created by PhpStorm.
 * User: faisal
 * Date: 01/05/16
 * Time: 22:12
 */

namespace Siakad\Controllers;


class Siakad {

    function __construct(){
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../templates');
    }

    function index(){
        return $this->templates->render('index');
    }
}