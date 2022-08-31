<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function accueil()
    {

        return view('vitrine.index');
    }

    public function article()
    {
        return view('vitrine.article');
    }
}
