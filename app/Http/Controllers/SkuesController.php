<?php

namespace App\Http\Controllers;

use App\Models\Skue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Auth;
class SkuesController extends Controller
{

    /**
     * Display a listing of the skues.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $skues = Skue::paginate(25);

        return view('skues.index', compact('skues'));
    }

    /**
     * Show the form for creating a new skue.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('skues.create');
    }

    /**
     * Store a new skue in the storage.
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
            Skue::create($data);

            return redirect()->route('skues.skue.index')
                             ->with('success_message', 'Skue was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified skue.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $skue = Skue::findOrFail($id);

        return view('skues.show', compact('skue'));
    }

    /**
     * Show the form for editing the specified skue.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $skue = Skue::findOrFail($id);
        

        return view('skues.edit', compact('skue'));
    }

    /**
     * Update the specified skue in the storage.
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
            $skue = Skue::findOrFail($id);
            $skue->update($data);

            return redirect()->route('skues.skue.index')
                             ->with('success_message', 'Skue was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified skue from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $skue = Skue::findOrFail($id);
            $skue->delete();

            return redirect()->route('skues.skue.index')
                             ->with('success_message', 'Skue was successfully deleted!');

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
            'sku_name' => 'required|string|min:1|max:255',
            'short_name' => 'nullable|string|min:0|max:255',
            'description' => 'nullable',
            'is_active' => 'nullable|boolean',
     
        ];
        
        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }

}