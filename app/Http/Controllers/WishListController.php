<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function query(){
        return view('wishlist.manage');
    }
}
