<?php

namespace App\Http\Controllers;

use App\Models\SmsInbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms;
use Illuminate\Support\Facades\Auth;
use Exception;

class SmsInboxesController extends Controller
{
    private $sms;
    function __construct()
    {
        $this->sms = new Sms();
    }

    /**
     * Display a listing of the sms inboxes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $smsInboxes = SmsInbox::paginate(25);

        return view('sms_inboxes.index', compact('smsInboxes'));
    }

    /**
     * Show the form for creating a new sms inbox.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('sms_inboxes.create');
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
            SmsInbox::create($data);

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
        $smsInbox = SmsInbox::findOrFail($id);

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
        $smsInbox = SmsInbox::findOrFail($id);
        

        return view('sms_inboxes.edit', compact('smsInbox'));
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
            $smsInbox = SmsInbox::findOrFail($id);
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
            $smsInbox = SmsInbox::findOrFail($id);
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
            'sender' => 'required|string|min:1|max:15',
            'sms_content' => 'required',
            'sms_status' => 'nullable',
            'is_active' => 'nullable|boolean',
     
        ];
        
        $data = $request->validate($rules);

        $data['is_active'] = $request->has('is_active');

        return $data;
    }


    public function process($id){
        $this->sms->parseSms($id);
    }

}
