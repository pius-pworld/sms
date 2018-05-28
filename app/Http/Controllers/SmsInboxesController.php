<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Sms_inbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;

class SmsInboxesController extends Controller
{

    /**
     * Display a listing of the sms inboxes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $smsInboxes = Sms_inbox::paginate(25);

        return view('sms_inboxes.index', compact('smsInboxes'));
    }

    /**
     * Show the form for creating a new sms inbox.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $creators = User::pluck('name','id')->all();
$updaters = User::pluck('name','id')->all();
        
        return view('sms_inboxes.create', compact('creators','updaters'));
    }

    /**
     * Store a new sms inbox in the storage.
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
            Sms_inbox::create($data);

            return redirect()->route('sms_inboxes.sms_inbox.index')
                             ->with('success_message', 'Sms Inbox was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified sms inbox.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $smsInbox = Sms_inbox::with('creator','updater')->findOrFail($id);

        return view('sms_inboxes.show', compact('smsInbox'));
    }

    /**
     * Show the form for editing the specified sms inbox.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $smsInbox = Sms_inbox::findOrFail($id);
        $creators = User::pluck('name','id')->all();
$updaters = User::pluck('name','id')->all();

        return view('sms_inboxes.edit', compact('smsInbox','creators','updaters'));
    }

    /**
     * Update the specified sms inbox in the storage.
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
            $smsInbox = Sms_inbox::findOrFail($id);
            $smsInbox->update($data);

            return redirect()->route('sms_inboxes.sms_inbox.index')
                             ->with('success_message', 'Sms Inbox was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified sms inbox from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $smsInbox = Sms_inbox::findOrFail($id);
            $smsInbox->delete();

            return redirect()->route('sms_inboxes.sms_inbox.index')
                             ->with('success_message', 'Sms Inbox was successfully deleted!');

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
            'sms_inbox_name' => 'nullable|string|min:0|max:100',
            'transactionId' => 'nullable|string|min:0|max:30',
            'sms_sender_number' => 'required|numeric|string|min:1|max:15',
            'sms_content' => 'required',
            'sms_received' => 'nullable|string|min:0',
            'created_by' => 'nullable',
            'created' => 'nullable|date_format:j/n/Y g:i A',
            'replied_datetime' => 'nullable|string|min:0',
            'status' => 'nullable',
            'updated' => 'nullable|date_format:j/n/Y g:i A',
            'updated_by' => 'nullable',
            'sms_status' => 'nullable|string|min:0|max:100',
     
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
