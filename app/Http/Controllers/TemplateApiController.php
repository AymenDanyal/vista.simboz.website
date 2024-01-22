<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TemplateApi;
use App\Models\UserTemplate;
use App\Models\UserUploads;


use TCPDF;


use Illuminate\Support\Facades\File;

class TemplateApiController extends Controller
{
   public function index()
    {
        $data = TemplateApi::all();
        $count = count($data);
        $responseArray = ["data" => []];
        $i = 1;
        
            
        foreach ($data as $value) {
          
            $pathFront = $value->front_img_url;
            $positionFront = strpos($pathFront, 'vista.simboz.website');
            // Get the substring starting from 'vista.simboz.website'
            $resultFront = "https://".substr($pathFront, $positionFront);
            
            $pathBack = $value->back_img_url;
            $positionBack = strpos($pathBack, 'vista.simboz.website');
            $resultBack = "https://".substr($pathBack, $positionBack);
        
           
            
            $item = [
                "value" => $i,
                "label" => "Template $i",
                "list" => [
                    [
                        "label" => "Front",
                        "value" => "1-" . ($i + 1),
                        "tempUrl" => "https://vista.simboz.website/api/template/showTemp/" . $value->id."/front",
                        "src" =>  $resultFront 
                    ],
                    [
                        "label" => "Back",
                        "value" => "1-" . ($i + 1),
                        "tempUrl" => "https://vista.simboz.website/api/template/showTemp/" . $value->id."/back",
                        "src" =>  $resultBack 
                    ]
                ]
            ];
    
            $responseArray["data"][] = $item;
            $i++;
            }
    

        // Return the constructed array as a JSON response
        return response()->json($responseArray);
    }

   public function storeTemp(Request $request)
    {   
        $pdf = new TCPDF();
        $pdf->SetCreator('Your Application');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('HTML to PDF/X Example');
        $pdf->SetSubject('HTML to PDF/X');
        
        // Add a page
        $pdf->AddPage();
    
        // Your HTML content
        $html = $frontJson = $request->input('frontJsonData');
    
        // Convert HTML to PDF
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Output the PDF
        $pdfPath = storage_path('app/public/') . 'html_to_pdf_x.pdf';
        $pdf->Output($pdfPath, 'F');
    
        return response()->json(['message' => 'PDF/X generated successfully', 'pdf_path' => $pdfPath]);
    
    /*
        // Validate required fields
        if (!$userId || !$front || !$frontImage || !$back || !$backImage) {
            throw new \Exception('Required fields are missing.');
        }
                
        //$frontJson = $request->input('frontJsonData');
        //$backJson  = $request->input('backJsonData');
  
  
        // Generate a unique file name for the image
        $frontName = 'front'.uniqid() . '.svg'; // You can adjust the file extension based on your requirements
        $backName  = 'back'.uniqid() . '.svg';
            
        // Save the image to storage (assuming 'images' is the directory in the public disk)
        $frontPath = storage_path('app/public/image/') . $frontName;
        $backPath  = storage_path('app/public/image/') . $backName;
    
        
        // Write the decoded image data to the file
        file_put_contents($frontPath, $frontImage);
        file_put_contents($backPath, $backImage);
            
        // Create a new TemplateApi instance
        $templateApi = new TemplateApi();
    
        // Assign the JSON data to the 'object' column/property in your model

        $templateApi->front = $frontImage;
        $templateApi->back = $backImage;
    
        // Assign the image path to the 'image' column/property in your model
        $templateApi->front_img_url = $frontPath;
        $templateApi->back_img_url  = $backPath;
            
        $templateApi->save();
        
   
            
        
      */  
        
    }

   public function show($id,$position)
    {   
        $startTime = microtime(true); // Record start time
        
        $baseUrl = 'https://';
        $localPath = '/home/simbumrj/';
    
        
        
        try {
            $templateApi = TemplateApi::find($id);
    
            if (!$templateApi) {
                return response()->json(['message' => 'Object not found.']);
            }
    
            $responseArray = [];
            
            $frontData = $templateApi->front;
           
            $backData = $templateApi->back;
           
            
            $frontImgUrl = str_replace($localPath, $baseUrl, $templateApi->front_img_url);
            $backImgUrl = str_replace($localPath, $baseUrl, $templateApi->back_img_url);
    
            
                
            $responseArray = [
                'front' => $frontData,
                'back' => $backData,
                'frontImgUrl' => $frontImgUrl,
                'backImgUrl' => $backImgUrl,
                'position' => $position,
                
                
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
        // Find the TemplateApi object by its ID
        $templateApi = TemplateApi::find($id);
        
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
                    "preview" => "https://vista.simboz.website/public/fontsSVG/$name.svg",
                    "posters" => [
                        "images/font/fangzhengshusong/poster.svg"
                    ],
                    "born" => "20191225",
                    "version" => "",
                    "license" => "Business free",
                    "auth" => true,
                    "source" => '',
                    "download" => "https://vista.simboz.website/public/fonts/$name.ttf",
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
            ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500); // Adjust the error code and message as needed
    }
}



    public function uploadImage(Request $request)
    {       
            // dd($request->all());
            $fileName = "";
            
            if ($request->has('image')) {
            $imageData = $request->input('image');
            $userId = $request->input('user_id');
            
            // Extract the base64 image data (remove data URI scheme and get the base64 string)
            $encodedImageData = substr($imageData, strpos($imageData, ',') + 1);
    
            // Decode the base64 image data
            $decodedImageData = base64_decode($encodedImageData);
    
            // Generate a unique filename for the image (you might use a more elaborate method)
            $fileName = 'image_' . time() . '.png';
    
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
            $UserUploads->url = 'https://vista.simboz.website/public/' . 'user_uploads/' .$fileName;
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
                'label' =>  $record->id,//$record->image_name, // Replace with appropriate label field from UserUploads model
                'value' => "1-2", // Replace with appropriate value field from UserUploads model
                'image_id' => $record->id,
                'src' => $record->url // Assuming the URL field in your model is 'url'
            ];
        }
    
        return response()->json($data);
    }
    
      public function getImage($id) {
        try {
            $record = UserUploads::findOrFail($id); // Assuming you're fetching a single record by ID
    
            $data = [
                'image' => $record->image,
                // Add more fields if needed
            ];
    
            return response()->json($data);
        } catch (\Exception $e) {
            // Handle exceptions, such as model not found or other errors
            return response()->json(['error' => 'Image not found'], 404);
        }
    }
    
        
    
    
    
    }

        