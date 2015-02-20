<?php namespace Suitcase\Http\Controllers;

use Suitcase\Http\Requests;
use Suitcase\Http\Controllers\Controller;
use Suitcase\Domain\Models\Listing as Listing;
use Input;
use forceDelete;

use Illuminate\Http\Request;

class ListingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $listings = Listing::paginate(3);
        return response(  $listings,200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $payload = \Input::all();
        $validation = \Validator::make($payload, Listing::$rules);
        if($validation->fails())
        {

            return response([
                "message" => "validation failed",
                "errors" => $validation->errors()
            ],422);

        }


        $listing = new Listing();
        $listing->name = Input::get('name');
        $listing->save();

        return response($listing,201);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $listings = Listing::find($id);

        if( ! $listings){
            return response([
                "mesage"=> "Single list does not exist",
                'error' => [],

            ],404);
        }else{

            return response( $listings,200);
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $listing = Listing::find($id);

        if(!$listing) {
            return response([
                "message"=>"List does not exist!",
                'error' => [],
            ]);
        }
        $listing = new Listing();
        $listing->name = \Input::get('name');
        $listing->save();


        return response($listing,200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $listing = Listing::find($id);

        if(!$listing)
        {
            return response([
                "message"=>"List does not exist! Please check your request and Try again",
                'error' => [],
                ],
                404);
        }

        $listing ->forceDelete();
        return response([], 204);

	}

}
