<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\FilterParameter;
use App\Models\FilterValue;
use App\Models\FilterCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all filters
        $filters = Filter::with('parameters', 'categories')->get();

        // Group parameters by filter name
        $groupedParameters = Filter::groupParametersByFilterName($filters);
        //dd('filter:',$filters,'grouped paramerter:',$groupedParameters);

        return view('backend.filter.index', compact('filters', 'groupedParameters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->pluck('title', 'id');
        //dd($categories);
        return view('backend.filter.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'filter_name' => 'string|required',
            'parameters.*' => 'string|required',
            'filter_cat' => 'integer|required',
            'param_price' => 'integer|nullable'
        ]);
    
        $parameters = $request->input('parameters');
        $category = $request->input('filter_cat');
    
        // Create Filter
        $filter = Filter::create([
            'filter_name' => $request->input('filter_name'),
        ]);
    
        // Create FilterCategory
        $filterCategory = FilterCategory::create([
            'cat_id' => $category,
            'filter_id' => $filter->filter_id,
        ]);
    
        // Create FilterParameters
        foreach ($parameters as $parameter) {
            FilterParameter::create([
                'filter_id' => $filter->filter_id,
                'param_value' => $parameter,
                'param_price' => $request->param_price,
            ]);
        }
    
        // Flash success message
        request()->session()->flash('success', 'Filter successfully added');
    
        // Redirect to index route
        return redirect()->route('filter.index');
    }
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filter_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($filter_id)
    {


        $categories = Category::get()->pluck('title', 'id');
        $filters = Filter::where('filter_id', $filter_id)->with('parameters', 'categories')->get();

        // Group parameters by filter name
        $groupedParameters = Filter::groupParametersByFilterName($filters);
        //dd($filters,$groupedParameters);
        return view('backend.filter.edit', compact('groupedParameters', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd($request->all());
        try {
            // Validate the incoming request data
            $this->validate($request, [
                'filter_name' => 'string|required',
                'filter_id' => 'integer|required',
                'filter_cat' => 'string|required',
                'param_value' => 'integer|required',
                'parameters' => 'array',
                'parameters.*' => 'string',
            ]);

            // Update the FilterCategory
            $category = FilterCategory::where('filter_id', $request->input('filter_id'))->first();
            $category->cat_id = $request->input('filter_cat');
            $category->save();

            // Update the Filter
            $filter = Filter::findOrFail($request->filter_id);
            $filter->filter_name = $request->filter_name;
            $filter->save();

            // Update or create FilterParameters
            foreach ($request->parameters as $paramId => $paramValue) {
                if ($paramValue == "empty") {
                    continue;
                } else {
                    $filterParameter = FilterParameter::where('param_id', $paramId)->first();

                    if ($filterParameter) {
                        $filterParameter->param_value = $paramValue;
                        $filterParameter->param_price =$request->param_price;
                        $filterParameter->save();
                    } else {
                        FilterParameter::create([
                            'filter_id' => $request->filter_id,
                            'param_value' => $paramValue,
                            'param_price' =>$request->param_price,
                        ]);
                    }
                }
            }

            // If everything was successful, flash success message
            request()->session()->flash('success', 'Filter successfully updated');
        } catch (\Exception $e) {
            dd($e);
            // If an exception occurs, flash error message
            request()->session()->flash('error', 'Failed to update filter. Please try again.');
            // Optionally log the exception for debugging
            // logger()->error('Error updating filter: ' . $e->getMessage());
        }

        // Redirect back to index page
        return redirect()->route('filter.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function destroy($id)
    {
        try {
            // Find the filter by 'filter_id' column
            $filter = Filter::where('filter_id', $id)->firstOrFail();

            // Delete related records in the correct order
            $filterParameters = FilterParameter::where('filter_id', $id)->get();

            foreach ($filterParameters as $filterParameter) {
                // Delete related filter values
                FilterValue::where('param_id', $filterParameter->param_id)->delete();
                // Delete the filter parameter
                $filterParameter->delete();
            }

            // Delete related filter categories
            FilterCategory::where('filter_id', $id)->delete();

            // Delete the filter
            $filter->delete();

            // Flash success message
            session()->flash('success', 'Filter successfully deleted');
        } catch (\Exception $e) {
            // Flash error message if any exception occurs
            session()->flash('error', 'Error deleting filter: ' . $e->getMessage());

            // Optionally log the exception for debugging
            // logger()->error('Error deleting filter: ' . $e->getMessage());
        }

        return redirect()->route('filter.index');
    }

    public function deleteParam(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'paramId' => 'required|integer',
            ]);

            // Find the parameter and delete it
            $param = FilterParameter::where('param_id', $request->paramId)->firstOrFail();
            $param->delete();

            // Return success response
            return response()->json(['success' => 'Parameter deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where the parameter is not found
            return response()->json(['error' => 'Parameter not found'], 404);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json(['error' => 'An error occurred while deleting the parameter'], 500);
        }
    }
}
