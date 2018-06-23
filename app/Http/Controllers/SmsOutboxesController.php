<?php

namespace App\Http\Controllers;

use App\Models\SmsOutbox;
use Illuminate\Http\Request;

class SmsOutboxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function writeOutbox($number, $message, array $options = [])
    {
        $input_data['sms_reciever_number'] = $number;
        $input_data['sms_content'] = $message;
        if (array_key_exists('priority', $options)) {
            $input_data['priority'] = $options['priority'];
        }
        if (array_key_exists('order_type', $options)) {
            $input_data['order_type'] = $options['order_type'];
        }
        if (array_key_exists('order_state', $options)) {
            $input_data['order_state'] = $options['order_state'];
        }

        SmsOutbox::Create($input_data);

    }
}
