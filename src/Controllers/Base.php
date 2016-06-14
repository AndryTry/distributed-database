<?php
/**
 * Created by PhpStorm.
 * User: faisal
 * Date: 03/05/16
 * Time: 06:48
 */

namespace Siakad\Controllers;

use League\Plates\Engine;
use PDO;

class Base {

    function __construct(){
        $this->templates = new Engine(__DIR__ . '/../templates');
        $this->templates->addData(["base_url" => "http://localhost:5000"]);
    }

    function connect($server_id){
        $server_config = array(
            1 => array(
                "dbhost" => getenv("dbhost1"),
                "dbuser" => getenv("dbuser1"),
                "dbpass" => getenv("dbpass1"),
                "dbname" => getenv("dbname1")
            ),

            2 => array(
                "dbhost" => getenv("dbhost2"),
                "dbuser" => getenv("dbuser2"),
                "dbpass" => getenv("dbpass2"),
                "dbname" => getenv("dbname2")
            )
        );

        $dbhost = $server_config[$server_id]['dbhost'];
        $dbuser = $server_config[$server_id]['dbuser'];
        $dbpass = $server_config[$server_id]['dbpass'];
        $dbname = $server_config[$server_id]['dbname'];

        $dsn = sprintf('mysql:host=%s;dbname=%s', $dbhost, $dbname);
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        $dbh = new PDO($dsn, $dbuser, $dbpass, $options);

        return $dbh;
    }
}
