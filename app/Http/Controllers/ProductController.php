<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterValue;
use App\Models\Brand;
use App\Models\FilterParameter;
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
        $filters=$filters->toArray();

        $categoryGroup = $this->groupParametersByFilterName($filters,$categories);

       
        //dd($categoryGroup);

        return view('backend.product.create')
        ->with('categories', $categories)
        ->with('categoryGroup', $categoryGroup)
        ->with('filters', $filters)
        ->with('brands', $brand);
    }

    public function groupParametersByFilterName($filters,$categories){
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
        return($categoryGroup);
        
    }
    public function store(Request $request)
    {
        
        //dd($request->all());
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'template' => 'string',
            'template_width' => 'numeric',
            'template_height' => 'numeric',
            'parameters' => 'required|array',
            'parameters.*' => 'array',
            'parameters.*.*' => 'integer',
        ]);

        $data = $request->all();
    
        // Remove the 'template' field from the data array

        $slug = Str::slug($request->title);
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }
        $data['slug'] = $slug;
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        // return $size;
        // return $data;
        $product = Product::create($data);
        //dd($product->id);
        $productId = $product->id;

        $template = $request->input('template');
        $template_height = $request->input('template_height');
        $template_width = $request->input('template_width');
        

        $parameters = $request->parameters;

        foreach ($parameters as $key => $parameterArray) {
            foreach ($parameterArray as $paramId) {
                $FilterValue = FilterValue::create([
                    'product_id' => $product->id,
                    'filter_id' => $key,
                    'param_id' => $paramId,
                ]);
            }
        }


        if ($product) {
            $status1 = Template::create([
                'product_id' => $productId,
                'front' => $template,
                'template_height' => $template_height,
                'template_width' => $template_width,

            ]);


            request()->session()->flash('success', 'Product Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }
 
    public function edit($id)
    {   $product = Product::find($id);
        $productDetails = $product->getProductDetails();
        $categories =      Category::get()->toArray();
        $filters =          Filter::get()->toArray();
        $brand =            Brand::get();
        $items =             Product::where('id', $id)->get();
        
        return view('backend.product.edit')
            ->with('brands', $brand)
            ->with('categories', $categories)
            ->with('filters', $filters)
            ->with('productDetails', $productDetails)
            ->with('items', $items);
    }


    public function update(Request $request, $id)
    {
       //dd($request->all(), $id);
        $product = Product::findOrFail($id);
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'photo' => 'string|required',
            'size' => 'nullable',
            'stock' => "required|numeric",
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'sometimes|in:1',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'condition' => 'required|in:default,new,hot',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'template' => 'string',
            'template_width' => 'numeric',
            'template_height' => 'numeric',
        ]);
        $filter=$request->filters;
        //dd($filter);
        foreach ($filter as $filter) {

            FilterValue::create([
                'product_id' => $product->id,]);
        }
        $data = $request->all();
        $data['is_featured'] = $request->input('is_featured', 0);
        $size = $request->input('size');
        if ($size) {
            $data['size'] = implode(',', $size);
        } else {
            $data['size'] = '';
        }
        // return $data;
        $status = $product->fill($data)->save();
        if ($status) {
            $template = Template::where([
                'product_id' => $product->id,
            ])->first();

            $template->template_height = $request->input('template_height');
            $template->template_width = $request->input('template_width');
            $template->front = $request->input('template');
            $template->save();

            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }


    public function destroy($product_id)
    {



        $template = Template::where('product_id', $product_id)->first();
        $status1 = $template->delete();


        $product = Product::findOrFail($product_id);
        $status = $product->delete();



        if ($status) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
