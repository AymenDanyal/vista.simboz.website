<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserTemplate;
use App\Models\Template;
use App\Models\Product;
use Illuminate\Support\Str;
use App\User;

class EditorController extends Controller
{

    public function index($productId)
    {
        $authenticatedUserId = Auth::id();
        $api_token = Auth::user()->api_token;
        
        $data = [];

        if (auth()->user()->role === 'admin') {
            $usertemplate = Template::where('product_id', $productId)->first();
           
            if ($usertemplate) {
                    
                $data = [
                    'userId' => $authenticatedUserId,
                    'product_id' => $productId,
                    'front' => $usertemplate->front ?? 'null',
                    'back' => $usertemplate->back ?? 'null',
                    'template_height' => $usertemplate->template_height ?? 'null',
                    'template_width' => $usertemplate->template_width ?? 'null',
                    'front_psd_url' => $usertemplate->front_psd_url ?? 'null',
                    'back_psd_url' => $usertemplate->back_psd_url ?? 'null',
                    'role' => false,
                    'api_token' => $api_token,
                ];
            }
        } else {
            $usertemplate = UserTemplate::where('user_id', $authenticatedUserId)->where('product_id', $productId)->first();

            if ($usertemplate) {
                $data = [
                    'userId' => $authenticatedUserId,
                    'product_id' => $productId,
                    'token' => Str::random(60),
                    'front' => $usertemplate->front ?? 'null',
                    'back' => $usertemplate->back ?? 'null',
                    'template_height' => $usertemplate->template_height ?? 'null',
                    'template_width' => $usertemplate->template_width ?? 'null',
                    'front_psd_url' => $usertemplate->front_psd_url ?? 'null',
                    'back_psd_url' => $usertemplate->back_psd_url ?? 'null',
                    'role' => true,
                    "back"=>false,
                    'api_token' => $api_token,
                ];
            } else {
                // If UserTemplate is not found, fallback to Template
                $templateApi = Template::where('product_id', $productId)->first();

                if ($templateApi) {
                    $data = [
                        'userId' => $authenticatedUserId,
                        'product_id' => $productId,
                        'front' => $usertemplate->front ?? 'null',
                        'back' => $usertemplate->back ?? 'null',
                        'template_height' => $templateApi->template_height ?? 'null',
                        'template_width' => $templateApi->template_width ?? 'null',
                        'front_psd_url' => $templateApi->front_psd_url ?? 'null',
                        'back_psd_url' => $templateApi->back_psd_url ?? 'null',
                        'role' => false, // or false, depending on your logic
                        "back"=>false,
                        'api_token' => $api_token,
                    ];
                }
            }
        }
       // dd($data ); 
        //'{"userId":1,"product_id":"30","template_height":72,"template_width":36,"front_psd_url":"null","back":false,"role":false}';
  
        return view('editor.index', ['data' => json_encode($data)]);

    }
   


}
