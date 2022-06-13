<?php
namespace App\Libraries;
//use TMDB_API; // relates to the Autoload.php config
use App\Libraries\MDatabase;

class MModel {

    function __construct()
    {
        //
        echo '<br><h1>Inside Connectio to Database!!!</h1><br>';
        $this->connection();
        echo '<br><h1>Outside from Connectio to Database!!!</h1><br>';
    }

    function connection()
    {
        try {
            $this->myldb = new MDatabase(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
            $this->myldb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->myldb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

}
