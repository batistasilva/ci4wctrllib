<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Pages extends Controller
{
    public function index()
    {
        print_r('Inside Pages::Index().....!!!');

        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        print_r('Inside Pages::View().....!!!' .$page);

        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php')) {
              // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
    }    
}
