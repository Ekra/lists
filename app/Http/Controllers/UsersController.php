<?php namespace Suitcase\Http\Controllers;

use Suitcase\Domain\Models\User as User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Psy\Util\Json;
use Suitcase\Http\Requests;
use Suitcase\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;


class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


       $users = User::paginate(3);
       return response($users,200);


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


        $payload = Input::all();
        $validation = Validator::make($payload, User::$rules);
        if($validation->fails())
        {

            return response([
                "message" => "validation failed",
                "errors" => $validation->errors()
            ],422);

        }
        $user = new User;
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->save();

         return response($user,201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $users = User::find($id);

        if( !$users ){
            return response([
                "message"=>"Single user does not exist",
                'error' => [],
            ],404);
        }else{

            return response($users->toArray(),200);
	}
  }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::find($id);

        return response($user,200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = User::find($id);

        if(!$user) {
            return response([
                "message"=>"User does not exist!",
                'error' => [],
            ]);

        $user = new User;
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->save();

         return response($user,200);

    }
  }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

        $user = User::find($id);
        if(!$user)
        {
            return response([
                    "message"=>"User does not exist! Please check your request and Try again",
                    'error' => [],
                ],
                404);
        }
        $user->forceDelete();
        return response([],204);
	}

}
