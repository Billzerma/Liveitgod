<?php

namespace App\Controllers;

use App\Models\CatalogModel;

class Catalog extends BaseController
{
    protected $catalogModel;

    public function __construct()
    {
        $this->catalogModel = new CatalogModel();
    }

    public function home()
    {
        $catalog = $this->catalogModel->getCatalog();
        // dd($catalog);
        $data=[
            'catalog'=>$catalog
        ];
      
        return view('home/catalog', $data);
    }
}
