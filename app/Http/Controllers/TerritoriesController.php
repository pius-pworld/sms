<?php

namespace App\Http\Controllers;

use App\Models\Territory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Auth;

class TerritoriesController extends Controller
{

    /**
     * Display a listing of the territories.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $territories = Territory::paginate(25);

        return view('territories.index', compact('territories'));
    }

    /**
     * Show the form for creating a new territory.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('territories.create');
    }

    /**
     * Store a new territory in the storage.
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
            Territory::create($data);

            return redirect()->route('territories.territory.index')
                             ->with('success_message', 'Territory was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified territory.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $territory = Territory::findOrFail($id);

        return view('territories.show', compact('territory'));
    }

    /**
     * Show the form for editing the specified territory.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $territory = Territory::findOrFail($id);
        

        return view('territories.edit', compact('territory'));
    }

    /**
     * Update the specified territory in the storage.
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
            $territory = Territory::findOrFail($id);
            $territory->update($data);

            return redirect()->route('territories.territory.index')
                             ->with('success_message', 'Territory was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified territory from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $territory = Territory::findOrFail($id);
            $territory->delete();

            return redirect()->route('territories.territory.index')
                             ->with('success_message', 'Territory was successfully deleted!');

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
            'territory_name' => 'required|string|min:1|max:255',
     
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
