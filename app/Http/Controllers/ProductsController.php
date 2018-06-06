<?php

namespace App\Http\Controllers;

use App\Models\Skue;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;



class ProductsController extends Controller
{

    /**
     * Display a listing of the products.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('brand','skue')->paginate(25);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $brands = Brand::pluck('brand_name','id')->all();
$skues = Skue::pluck('sku_name','id')->all();
        
        return view('products.create', compact('brands','skues'));
    }

    /**
     * Store a new product in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            Product::create($data);

            return redirect()->route('products.product.index')
                             ->with('success_message', 'Product was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::with('brand','skue')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::pluck('brand_name','id')->all();
$skues = Skue::pluck('sku_name','id')->all();

        return view('products.edit', compact('product','brands','skues'));
    }

    /**
     * Update the specified product in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['updated_by'] = Auth::Id();
            $product = Product::findOrFail($id);
            $product->update($data);

            return redirect()->route('products.product.index')
                             ->with('success_message', 'Product was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified product from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.product.index')
                             ->with('success_message', 'Product was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'key_word' => 'nullable|string|min:0|max:255',
            'brands_id' => 'required',
            'skues_id' => 'required',
            'price' => 'nullable|numeric|min:-999999999.99|max:999999999.99',
            'quantity' => 'nullable|numeric|min:-999999999.99|max:999999999.99',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
     
        ];
        
        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }

}
