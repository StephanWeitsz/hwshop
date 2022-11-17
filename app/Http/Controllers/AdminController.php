<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');
    } //public function __construct() {

    public function index() {
        return view('admin.index');
    } //public function index() {
} //class AdminController extends Controller
