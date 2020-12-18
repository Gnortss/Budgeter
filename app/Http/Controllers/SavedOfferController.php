<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedOffer;

class SavedOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = auth()->user()->id;
        return SavedOffer::where('user_id', $uid)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'special_offer_id' => 'required'
        ]);

        if($validator->fails())
            return response()->json($validator->errors(), 422);
        else {
            $savedOffer = new SavedOffer;
            $savedOffer->user_id = $request->user()->id;
            $savedOffer->special_offer_id = $request->special_offer_id;
            $savedOffer->save();

            return response()->json([
                'message' => "You've saved the offer"
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $uid = auth()->user()->id;
        return SavedOffer::where(['user_id' => $uid, 'special_offer_id' => $id])->get();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uid = auth()->user()->id;
        $savedOffer = SavedOffer::where(['user_id' => $uid, 'special_offer_id' => $id]);
        if($savedOffer) {
            $savedOffer->delete();
            return response()->json([
                'message' => "Your saved offer was successfully removed"
            ], 200);
        }
        else {
            return response()->json([
                'message' => "Error after deleting"
            ], 502);
        }

    }
}
