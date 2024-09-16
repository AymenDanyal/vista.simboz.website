<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterValue;
use App\Models\Brand;
use App\Models\FilterParameter;
use App\Models\PriceRange;
use App\Models\Template;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::getAllProduct();
        // return $products;

        return view('backend.product.index')->with('products', $products);
    }



    public function create()
    {

        $brand = Brand::get();
        $categories = Category::with('filters.parameters')->get();
        $filters = Filter::with('parameters')->get();
        $filters = $filters->toArray();

        $categoryGroup = $this->groupParametersByFilterName($filters, $categories);


        //dd($categoryGroup);

        return view('backend.product.create')
            ->with('categories', $categories)
            ->with('categoryGroup', $categoryGroup)
            ->with('filters', $filters)
            ->with('brands', $brand);
    }

    public function groupParametersByFilterName($filters, $categories)
    {
        $categoryGroup = [];

        foreach ($categories as $category) {
            $categoryGroup[$category->id] = [
                'title' => $category->title,
                'filters' => []
            ];

            foreach ($category->filters as $filter) {
                $categoryGroup[$category->id]['filters'][$filter->filter_id] = [
                    'filter_name' => $filter->filter_name,
                    'parameters' => $filter->parameters->pluck('param_value')->toArray()
                ];
            }
        }
        return ($categoryGroup);
    }
    public function store(Request $request)
    {
        // Validate the request data
        //dd($request->all());
        $validatedData = $request->validate([
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable|array',
            'size.*' => 'string',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'discount' => 'nullable|numeric',
            'front' => 'string|nullable',
            'template_width' => 'numeric|nullable',
            'template_height' => 'numeric|nullable',
            'parameters' => 'required|array',
            'parameters.*' => 'array',
            'parameters.*.*' => 'integer',
            'prices' => 'required|array',
            'prices.*' => 'numeric|min:0',
            'min_ranges' => 'required|array',
            'min_ranges.*' => 'numeric|min:0',
            'max_ranges' => 'required|array',
            'max_ranges.*' => 'numeric|min:0|gt:min_ranges.*',
        ]);
    
        // Process the data
        $data = $validatedData;
        
        // Generate a unique slug
        $slug = Str::slug($data['title']);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $data['is_featured'] ?? 0;
        
        // Handle size field
        $data['size'] = isset($data['size']) ? implode(',', $data['size']) : '';
    
        // Create the product
        $product = Product::create($data);
        $productId = $product->id;
    
        // Store parameters
        $parameters = $data['parameters'];
        foreach ($parameters as $filterId => $paramIds) {
            foreach ($paramIds as $paramId) {
                FilterValue::create([
                    'product_id' => $productId,
                    'filter_id' => $filterId,
                    'param_id' => $paramId,
                ]);
            }
        }
    
        // Store template information
        if ($product) {
            Template::create([
                'product_id' => $productId,
                'front_psd_url' => $data['front'] ?? null,
                'template_height' => $data['template_height'] ?? null,
                'template_width' => $data['template_width'] ?? null,
            ]);
    
        // Store price ranges
            $prices = $data['prices'];
            $minRanges = $data['min_ranges'];
            $maxRanges = $data['max_ranges'];
            
            foreach ($prices as $index => $price) {
                $minRange = $minRanges[$index] ?? null;
                $maxRange = $maxRanges[$index] ?? null;
            
                if ($price !== null && $minRange !== null && $maxRange !== null) {
                    
                    PriceRange::create([
                        'product_id' => $productId,
                        'price' => $price,
                        'min_range' => $minRange,
                        'max_range' => $maxRange,
                    ]);
                }
            }

    
            // Flash success message and redirect
            request()->session()->flash('success', 'Product successfully added');
        } else {
            // Flash error message
            request()->session()->flash('error', 'Please try again!');
        }
    
        return redirect()->route('product.index');
    }
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $productDetails = $product->getProductDetails();
        $priceRange = $product->priceRange()->orderBy('min_range', 'asc')->get();
        
        $categories = Category::with('filters.parameters')->get()->keyBy('id')->toArray();
        
        $filters = Filter::with('parameters')->get()->keyBy('filter_id')->toArray();
        
        $brands = Brand::all();
    
        $rearrangedProductDetails = [];
        foreach ($productDetails['filter_values'] as $filterValue) {
            $filter = Filter::find($filterValue['filter_id']);
            $parameter = FilterParameter::find($filterValue['param_id']);
            
            if (!isset($rearrangedProductDetails[$filterValue['filter_id']])) {
                $rearrangedProductDetails[$filterValue['filter_id']] = [
                    'filter_name' => $filter->filter_name,
                    'filter_id' => $filter->filter_id,
                    'parameters' => []
                ];
            }
    
            $rearrangedProductDetails[$filterValue['filter_id']]['parameters'][] = [
                'param_id' => $filterValue['param_id'],
                'param_value' => $parameter->param_value 
            ];
        }
        $productDetails['filter_applied'] = $rearrangedProductDetails;
        //dd($priceRange->toArray());
        // Return view with all necessary data
        return view('backend.product.edit')
            ->with('brands', $brands)
            ->with('categories', $categories)
            ->with('filters', $filters)
            ->with('productDetails', $productDetails)
            ->with('priceRange', $priceRange);
    }
    


    public function update(Request $request, $id)
    {
       // dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable|array',
            'size.*' => 'string',
            'stock' => 'required|numeric',
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|boolean',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'discount' => 'nullable|numeric',
            'front' => 'string|nullable',
            'template_width' => 'numeric|nullable',
            'template_height' => 'numeric|nullable',
            'parameters' => 'required|array',
            'parameters.*' => 'array',
            'parameters.*.*' => 'integer',
            'prices' => 'required|array',
            'prices.*' => 'numeric|min:0',
            'min_ranges' => 'required|array',
            'min_ranges.*' => 'numeric|min:0',
            'max_ranges' => 'required|array',
            'max_ranges.*' => 'numeric|min:0|gt:min_ranges.*',
        ]);

        DB::beginTransaction();

        try {
            // Retrieve the product
            $product = Product::findOrFail($id);

            // Update filter values
            foreach ($request->parameters as $filterId => $paramIds) {
                FilterValue::where('product_id', $product->id)
                    ->where('filter_id', $filterId)
                    ->delete();

                foreach ($paramIds as $paramId) {
                    FilterValue::create([
                        'product_id' => $product->id,
                        'filter_id' => $filterId,
                        'param_id' => $paramId,
                    ]);
                }
            }
            foreach ($request->parameters as $filterId => $paramIds) {
                FilterValue::where('product_id', $product->id)
                    ->where('filter_id', $filterId)
                    ->delete();

                foreach ($paramIds as $paramId) {
                    FilterValue::create([
                        'product_id' => $product->id,
                        'filter_id' => $filterId,
                        'param_id' => $paramId,
                    ]);
                }
            }
            
            // Store price ranges
            $prices = $request->prices;
            $minRanges = $request->min_ranges;
            $maxRanges = $request->max_ranges;
            
            foreach ($prices as $index => $price) {
                $minRange = $minRanges[$index] ?? null;
                $maxRange = $maxRanges[$index] ?? null;
            
                if ($price !== null && $minRange !== null && $maxRange !== null) {
                    
                    PriceRange::create([
                        'product_id' => $id,
                        'price' => $price,
                        'min_range' => $minRange,
                        'max_range' => $maxRange,
                    ]);
                }
            }

            

            // Prepare data for product update
            $data = $validatedData;
            $data['is_featured'] = $request->input('is_featured', 0);
            $data['size'] = implode(',', $request->input('size', []));

            // Update the product
            $product->fill($data)->save();

            // Update template information
            $template = Template::where('product_id', $product->id)->first();
            if ($template) {
                $template->update([
                    'template_height' => $request->input('template_height'),
                    'template_width' => $request->input('template_width'),
                    'front' => $request->input('template'),
                ]);
            }

            // Update price ranges
            foreach ($data['prices'] as $index => $price) {
                $minRange = $data['min_ranges'][$index] ?? null;
                $maxRange = $data['max_ranges'][$index] ?? null;

                if ($price !== null && $minRange !== null && $maxRange !== null) {
                    PriceRange::updateOrCreate(
                        ['product_id' => $product->id, 'min_range' => $minRange],
                        ['price' => $price, 'max_range' => $maxRange]
                    );
                }
            }

            // Commit the transaction
            DB::commit();
            $request->session()->flash('success', 'Product successfully updated');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            dd( $e);
            $request->session()->flash('error', 'An error occurred while updating the product. Please try again.');
        }

        return redirect()->route('product.index');
    }

    public function destroy($product_id)
    {
        // Delete associated filter values
        $filterValues = FilterValue::where('product_id', $product_id)->get();
        foreach ($filterValues as $filterValue) {
            $filterValue->delete();
        }
    
        // Delete associated template (assuming there's only one template per product)
        $template = Template::where('product_id', $product_id)->first();
        if ($template) {
            $template->delete();
        }
    
        // Delete the product itself
        $product = Product::findOrFail($product_id);
        if ($product->delete()) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
    
        return redirect()->route('product.index');
    }
    
}
