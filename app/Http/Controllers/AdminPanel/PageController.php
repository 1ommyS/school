<?php
namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

class PageController  extends Controller {
    public function index() {
        return view ("pages.panel.index");
    }

}
