<?php

namespace App\Controllers;


class Main extends BaseController
{

    public function index() {
        //echo '<br/>Inside Main()';
        
        $data['title'] = 'OSSB Solutions - Principal'; // Capitalize the first letter
        //
        echo view('templates/header', $data);
        echo view('index/index', $data);
        echo view('templates/footer', $data);
    }    

}
