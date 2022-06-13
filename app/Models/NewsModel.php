<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';//news = name of table on database


    public function getNews($slug = false)
    {
/*        if ($slug === false) {
            return $this->findAll();
        }*/
        if ($slug === false) {
            $query   = $this->db->query("SELECT * FROM $this->table");
            $results = $query->getResultArray();

            return $results;
        }

        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }


    
}

