<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;
use App\Models\Template;
use App\Models\UserTemplate;
use App\Models\UserUploads;
use Illuminate\Support\Facades\Storage;
use App\User;


use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    public function index()
    {



        $data = Template::all();

        $count = count($data);
        $responseArray = ["data" => []];
        $i = 1;


        foreach ($data as $value) {

            $templateId = $value->id;
            $pathFrontPSD = $value->front_psd_url;
            $pathBackPSD = $value->back_psd_url;
            $frontImg = $value->front;
            $frontBack = $value->back;

            $item = [
                "value" => $i,
                "label" => "Template $i",
                "list" => [
                    [
                        "label" => "Front",
                        "value" => "1-" . ($i + 1),
                        "tempUrl" => $pathFrontPSD,
                        "tempId" => $templateId,
                        "src" =>  $frontImg
                    ],
                    [
                        "label" => "Back",
                        "value" => "1-" . ($i + 1),
                        "tempUrl" => $pathBackPSD,
                        "tempId" => $templateId,
                        "src" =>  $frontBack
                    ]
                ]
            ];

            $responseArray["data"][] = $item;
            $i++;
        }


        // Return the constructed array as a JSON response
        return response()->json($responseArray);
    }
    public function storeUserTemp(Request $request)
    {
        $startTime = microtime(true); // Record start time

        try {
            // $userId = Auth::id();
            $userId = 1;
            $frontImage = $request->input('frontImage');
            $backImage = $request->input('backImage');
            $productId = $request->input('productId');
            $templateWidth = $request->input('templateWidth');
            $templateHeight = $request->input('templateHeight');

            $user = User::where('id', $userId)->first();

            if (!$user) {
                throw new \Exception('User not found.');
            }

            // Validate required fields
            if (!$userId || !$frontImage || !$templateWidth || !$productId || !$templateHeight) {
                throw new \Exception('Required fields are missing.');
            }


            // Generate a unique filename for the JSON file
            $jsonFilename = 'user_' . $userId . '_template_' . time() . '.json';

            // Save the JSON file to the server
            Storage::disk('public')->put($jsonFilename, $frontImage);

            // Get the URL of the JSON file
            $jsonFileUrl = Storage::url($jsonFilename);

            // Create a new instance based on the user role
            $userTemplate = new UserTemplate();
            $userTemplate->user_id = $userId;

            // Assign values to model properties
            $userTemplate->product_Id = $productId;
            $userTemplate->front_psd_url = $jsonFileUrl;
            $userTemplate->back_psd_url = $backImage;
            $userTemplate->template_width = $templateWidth;
            $userTemplate->template_height = $templateHeight;
            // Store the URL of the JSON file

            // Save the template
            $userTemplate->save();

            // Measure response time
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            return response()->json([
                'message' => 'Template stored successfully.',
                'response_time' => $executionTime
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function storeAdminTemp(Request $request)
    {
        $startTime = microtime(true); // Record start time

        try {
            $product_id = $request->input('product_id');
            $front = $request->input('front');
            $back = $request->input('back');

            $product = Product::where('id', $product_id)->first();

            if (!$product) {
                throw new \Exception('Product not found.');
            }

            // Initialize file URLs
            $frontJsonFileUrl = null;
            $backJsonFileUrl = null;

            // Generate a unique filename for the front JSON file and save it
            if ($front) {
                $frontJsonFilename = 'product_' . $product_id . '_front_' . time() . '.json';
                Storage::disk('public')->put($frontJsonFilename, json_encode(['image' => $front]));
                $frontJsonFileUrl = Storage::url($frontJsonFilename);
            }

            // Generate a unique filename for the back JSON file and save it
            if ($back) {
                $backJsonFilename = 'product_' . $product_id . '_back_' . time() . '.json';
                Storage::disk('public')->put($backJsonFilename, json_encode(['image' => $back]));
                $backJsonFileUrl = Storage::url($backJsonFilename);
            }

            // Find the existing template by product_id
            $userTemplate = Template::where('product_id', $product_id)->first();

            if (!$userTemplate) {
                throw new \Exception('Template not found.');
            }

            // Update the existing template with new URLs
            $userTemplate->front = $frontJsonFileUrl;
            $userTemplate->back = $backJsonFileUrl;

            // Save the updated template
            $userTemplate->save();

            // Measure response time
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            return response()->json([
                'message' => 'Template updated successfully.',
                'response_time' => $executionTime
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showTemp($template_id, $user_id)
    {

        $startTime = microtime(true); // Record start time

        $baseUrl = '';
        $localPath = '';

        try {

            $user = User::where('id', $user_id)->first();
            // $rememberToken = $user->rememberToken;
            $role = $user->role;

            $templateApi = Template::where('id', $template_id)->first();

            if (!$templateApi) {
                return response()->json(['message' => 'Object not found.']);
            }

            $responseArray = [];

            $frontData = $templateApi->front;
            $backData = $templateApi->back;
            $templateWidth = $templateApi->template_width;
            $templateHeight = $templateApi->template_height;


            $frontImgUrl = str_replace($localPath, $baseUrl, $templateApi->front_psd_url);
            $backImgUrl = str_replace($localPath, $baseUrl, $templateApi->back_psd_url);




            $responseArray = [
                'userId' => $user_id,
                'front' => $frontData,
                'back' => $backData,
                'frontImgUrl' => $frontImgUrl,
                'backImgUrl' => $backImgUrl,
                'templateWidth' => $templateWidth,
                'templateHeight' => $templateHeight,
                // 'rememberToken' => $rememberToken,
                'role' => $role,
            ];

            // Measure response time
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            return response()->json([
                'data' => $responseArray,
                'response_time' => $executionTime // Include response time in the response
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Adjust error response
        }
    }
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Post updated successfully']);
    }
    public function destroy($id)
    {
        // Find the Template object by its ID
        $templateApi = Template::find($id);

        if (!$templateApi) {
            // If the object is not found, return an appropriate response (e.g., 404 Not Found)
            return response()->json(['message' => 'Object not found'], 404);
        }

        // Delete the found object
        $templateApi->delete();

        // Return a JSON response indicating successful deletion
        return response()->json(['message' => 'Object deleted successfully']);
    }
    public function getFonts()
    {
        $names = [
            "Helvetica",
            "Roboto",
            "Arial",
            "Times New Roman"
        ];

        $fonts = [];

        foreach ($names as $name) {

            $font = [
                "type" => "2",
                "code" => $name,
                "name" => $name,
                "preview" => env('APP_URL') . "/public/fontsSVG/$name.svg",
                "posters" => [
                    "images/font/fangzhengshusong/poster.svg"
                ],
                "born" => "20191225",
                "version" => "",
                "license" => "Business free",
                "auth" => true,
                "source" => '',
                "download" => env('APP_URL') . "/public/fonts/$name.ttf",
                "desc" => ""
            ];

            $fonts[$name] = $font;
        }

        return $fonts;
    }
    public function saveUserTemp(Request $request)
    {
        $startTime = microtime(true); // Record start time
        try {
            $userId = $request->input('userId');
            $front = $request->input('front');
            $frontImage = $request->input('frontImage');
            $back = $request->input('back');
            $backImage = $request->input('backImage');

            // Validate required fields
            if (!$userId || !$front || !$frontImage || !$back || !$backImage) {
                throw new \Exception('Required fields are missing.');
            }

            // Process front image
            $frontImage = str_replace('data:image/png;base64,', '', $frontImage);
            $frontImage = base64_decode($frontImage);
            $frontImgName = 'front' . uniqid() . '.png';
            $frontImgPath = storage_path('app/public/image') . $frontImgName;
            file_put_contents($frontImgPath, $frontImage);

            // Process back image
            $backImage = str_replace('data:image/png;base64,', '', $backImage);
            $backImage = base64_decode($backImage);
            $backImgName = 'back' . uniqid() . '.png';
            $backImgPath = storage_path('app/public/image') . $backImgName;
            file_put_contents($backImgPath, $backImage);

            // Save data to the database
            $userTemplate = new UserTemplate;
            $userTemplate->front = $front;
            $userTemplate->frontImgPath = $frontImgPath;

            $userTemplate->back = $back;
            $userTemplate->backImgPath = $backImgPath;

            $userTemplate->save();
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;
            return response()->json(
                [
                    'message' => 'Template Saved',
                    'response_time' => $executionTime
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Adjust the error code and message as needed
        }
    }
    public function uploadImage(Request $request)
    {

        $fileName = "";

        if ($request->has('image')) {
            $imageData = $request->input('image');
            $userId = $request->input('user_id');

            // Extract the base64 image data (remove data URI scheme and get the base64 string)
            $encodedImageData = substr($imageData, strpos($imageData, ',') + 1);

            // Decode the base64 image data
            $decodedImageData = base64_decode($encodedImageData);

            // Generate a unique filename for the image (you might use a more elaborate method)
            $fileName = 'image_' . time() . '.psd';

            // Define the directory to save the image
            $directory = public_path('user_uploads');

            // Ensure the directory exists, if not, create it
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Save the decoded image data to the directory with the generated filename
            file_put_contents($directory . '/' . $fileName, $decodedImageData);

            // Optionally, you might store the image information in your database
            $UserUploads = new UserUploads();
            $UserUploads->url = env('APP_URL') . '/user_uploads/' . $fileName;
            $UserUploads->user_id = $userId;
            $UserUploads->image_name = $fileName;
            $UserUploads->image = $imageData;
            $UserUploads->save();

            return response()->json(['message' => 'Image uploaded successfully'], 200);
        } else {
            return response()->json(['error' => 'No image uploaded'], 400);
        }
    }
    public function loadUserImages($id)
    {
        $records = UserUploads::where('user_id', $id)->get();
        //dd($records);

        $data = [
            'data' => [
                [
                    'value' => 1,
                    'label' => 'Uploaded Images',
                    'list' => []
                ]
            ]
        ];

        foreach ($records as $record) {
            $data['data'][0]['list'][] = [
                'label' =>  $record->id, //$record->image_name, // Replace with appropriate label field from UserUploads model
                'value' => "1-2", // Replace with appropriate value field from UserUploads model
                'image_id' => $record->id,
                'src' => $record->url // Assuming the URL field in your model is 'url'
            ];
        }

        return response()->json($data);
    }
    public function getImage($id)
    {

        try {
            $record = UserUploads::findOrFail($id);

            $data = [
                'image' => $record->image,
            ];

            return response()->json($data);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Image not found'], 404);
        }
    }
    public function saveExit(Request $request)
    {
        $startTime = microtime(true); // Record start time

        try {

            $userId = $request->input('userId');
            $frontImage = $request->input('frontImage');
            $backImage = $request->input('backImage');
            $templateWidth = $request->input('templateWidth');
            $templateHeight = $request->input('templateHeight');
            $role = $request->input('role');
            $product_id = $request->input('product_id');

            $user = User::where('id', $userId)->first();

            if (!$user) {
                throw new \Exception('User not found.');
            }



            // Validate required fields
            if (!$userId || !$frontImage || !$templateWidth || !$backImage || !$templateHeight) {
                throw new \Exception('Required fields are missing.');
            }

            // Generate unique file names for the images
            $frontName = 'front' . uniqid() . '.svg';
            $backName = 'back' . uniqid() . '.svg';

            // Save the images to storage
            $frontPath = storage_path('app/public/image/') . $frontName;
            $backPath = storage_path('app/public/image/') . $backName;

            // Write the decoded image data to the files
            file_put_contents($frontPath, $frontImage);
            file_put_contents($backPath, $backImage);

            // Create a new instance based on the user role
            if ($role === 'admin') {
                $templateApi = new Template();
            } else {
                $templateApi = new UserTemplate();
                $templateApi->user_id = $userId;
            }

            // Assign values to model properties
            $templateApi->front = $frontImage;
            $templateApi->back = $backImage;
            $templateApi->front_psd_url = $frontPath;
            $templateApi->back_psd_url = $backPath;

            // Save the template
            $templateApi->save();

            // Measure response time
            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            return response()->json([
                'message' => 'Template stored successfully.',
                'response_time' => $executionTime
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
