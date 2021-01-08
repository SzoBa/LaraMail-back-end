<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    /*There could be any kind of methods, named in the route.
    */


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
//        This is the way of multiple filtering with or
//        $mails =  DB::table('mails')->where('id_user_from', $request->user()->id)
//        ->orWhere('id_user_to', $request->user()->id)->get();
//          or see example beneath
//        $mails = Mail::all()
//            ->where('id_user_to', $request->user()->id)->sortBy('sent');
        $mails = DB::table('mails')->join('users', 'mails.id_user_from', '=', 'users.id')
            ->select('mails.*', 'users.name')
            ->where('mails.id_user_to', '=', $request->user()->id)
            ->get();
        return response($mails, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = ['name' =>'required',
            'subject' => 'required|min:3', 'message' => 'required|min:3'];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response($validation->errors(), 400);
        }
        $destinationUser = User::where('name', $request->get('name'))->first();
        if ($destinationUser) {
            Mail::create(['id_user_from' =>$request->user()->id,
                'id_user_to' => $destinationUser->id,
                'subject' => $request->get('subject'),
                'message' => $request->get('message'),
            ]);
            return response(['message'=> 'Send Successful!'], 201);
            //this could be with arrow function too, like ->json(data, status)
        }
        return response(['message'=> 'Username doesn\'t exist in database!'], 404);


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
        return response(Mail::find($id), 200);
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

    public function sent(Request $request): Response
    {

//        Mail::all()->where('id_user_from', $request->user()->id)->sortByDesc('sent');
//        $mails = Mail::with('user')->get();
        $mails = DB::table('mails')->join('users', 'mails.id_user_to', '=', 'users.id')
        ->select('mails.*', 'users.name')
        ->where('mails.id_user_from', '=', $request->user()->id)
        ->get();
        return response($mails, 200);
    }
}
