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
        

        $data = [
            'userId' => $userId,
            'productId' => $productId,
        ];

        return view('editor.index',$data);
    }
}
