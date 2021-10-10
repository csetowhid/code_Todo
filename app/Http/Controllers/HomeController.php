<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $data['blogs'] = Todo::with('Categories')
        ->where('is_complete', true)
        ->latest()
        ->paginate(2);
        return view('welcome', $data);
    }
}
