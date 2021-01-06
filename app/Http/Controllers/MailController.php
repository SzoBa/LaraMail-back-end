<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    /*There could be any kind of methods, named in the route.
    */


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mails =  Mail::all();
        return response($mails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = ['id_user_from' => 'required|numeric', 'id_user_to' =>'required|numeric',
            'subject' => 'required|min:3', 'message' => 'required|min:3'];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response($validation->errors(), 400);
        }
        return response(Mail::create($request->all()), 201);
        //this could be with arrow function too, like ->json(data, status)
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $mail = Mail::find($id);
        if(is_null($mail)) {
            return response(['message'=>'Mail not found'], 404);
        }
        return Mail::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): ?Response
    {
        $mail = Mail::find($id);
        if (is_null($mail)) {
            return response(["message" =>"Id doesn't exist in database!"], 404);
        }
        $mail->update($request->all());
        return response($mail, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $deletedRows = Mail::destroy($id);
        //number of deleted rows
        return $deletedRows === 0 ? response(["message"=>"No deletion executed!"], 404) :
            response(["message"=> "Record deleted!"], 204);
    }
}
