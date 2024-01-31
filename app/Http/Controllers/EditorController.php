<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UserTemplate;
use App\Models\TemplateApi;
use Illuminate\Support\Str;
use App\User;

class EditorController extends Controller
{

    public function index($productId)
    {
        $authenticatedUserId = Auth::id();
        $data = [];

        if (auth()->user()->role === 'admin') {
            $usertemplate = TemplateApi::where('product_id', $productId)->first();

            if ($usertemplate) {
                $data = [
                    'userId' => $authenticatedUserId,
                    'product_id' => $productId,
                    'template_height' => $usertemplate->template_height ?? 'null',
                    'template_width' => $usertemplate->template_width ?? 'null',
                    'front_img_url' => $usertemplate->front_img_url ?? 'null',
                    'back_img_url' => $usertemplate->back_img_url ?? 'null',
                    'role' => true,
                ];
            }
        } else {
            $usertemplate = UserTemplate::where('user_id', $authenticatedUserId)->where('product_id', $productId)->first();

            if ($usertemplate) {
                $data = [
                    'userId' => $authenticatedUserId,
                    'product_id' => $productId,
                    'token' => Str::random(60),
                    'template_height' => $usertemplate->template_height ?? 'null',
                    'template_width' => $usertemplate->template_width ?? 'null',
                    'front_img_url' => $usertemplate->front_img_url ?? 'null',
                    'back_img_url' => $usertemplate->back_img_url ?? 'null',
                    'role' => false,
                ];
            } else {
                // If UserTemplate is not found, fallback to TemplateApi
                $templateApi = TemplateApi::where('product_id', $productId)->first();

                if ($templateApi) {
                    $data = [
                        'userId' => $authenticatedUserId,
                        'product_id' => $productId,
                        'template_height' => $templateApi->template_height ?? 'null',
                        'template_width' => $templateApi->template_width ?? 'null',
                        'front_img_url' => $templateApi->front_img_url ?? 'null',
                        'back_img_url' => $templateApi->back_img_url ?? 'null',
                        'role' => false, // or false, depending on your logic
                    ];
                }
            }
        }

        return view('editor.index', ['data' => json_encode($data)]);

    }


}
