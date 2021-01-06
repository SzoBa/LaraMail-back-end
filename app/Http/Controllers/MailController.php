<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails =  Mail::all();
        return response($mails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
            ['id_user_from' => 'required|numeric', 'id_user_to' =>'required|numeric',
                'subject' => 'required', 'message' => 'required']);
        if ($validation->fails()) {
            return response('Wrong data inserted!', 400);
        }
        return Mail::create($request->all());

//        try {
//                $mail = Mail::create($request->all());
//                return response($mail, 201);
//            } catch (QueryException $error) {
//                return response('Wrong data inserted!', 400);}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Mail::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $mail = Mail::find($id);
            if ($mail === null) {
                return response("Id doesn't exist in database!", 400);
            }
            $mail->update($request->all());
            return $mail;
        } catch (QueryException $error) {
            return response("Wrong data insert attempt!", 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = Mail::destroy($id);
        //number of deleted rows
        return $deletedRows === 0 ? response("No deletion executed!", 400) :
            response("Record deleted!", 200);
    }
}
