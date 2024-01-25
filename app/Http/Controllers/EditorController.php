<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function index($productId,$userId){
        $authenticatedUserId = Auth::id();

        if ($authenticatedUserId != $userId) {
            // Handle unauthorized access, redirect, or show an error
            return abort(403, 'Unauthorized access.');
        }
        $data = ['message' => 'Hello from Laravel!',
        'messag1' => 'Hello from Laravel!',
        'message2' => 'Hello from Laravel!']; 
        return view('editor.index', ['data' => json_encode($data)]);
    }
}
