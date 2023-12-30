<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function process(Request $request)
    {
        // session_start();
        session(['key' => 'value']);

        // Redirect back to the index
        return redirect()->route('index');
    }
    public function logout()
    {
        // Clear the session
        session()->forget('key');

        // Redirect to the login page or any other page as needed
        return redirect()->route('index');
    }
}
