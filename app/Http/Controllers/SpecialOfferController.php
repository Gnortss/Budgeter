<?php

namespace App\Http\Controllers;

use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpecialOffer::all();
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
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else {
            $offer = SpecialOffer::create($request->all());

            return response()->json([
                'message' => "Your special offer has been submitted successfully",
                'special_offer'=> $offer
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SpecialOffer::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else {
            $specialOffer = SpecialOffer::findOrFail($id);
            $specialOffer->update($request->all());

            return response()->json([
                'message' => "Your special offer has been updated successfully",
                'special_offer'=> $specialOffer
            ], 201);
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
        $offer = SpecialOffer::findOrFail($id);
        if($offer) {
            $offer->delete();
            return response()->json([
                'message' => "Your special offer has been deleted successfully"
            ], 200);
        }
        else {
            return response()->json([
                'message' => "Error after deleting"
            ], 502);
        }
    }
}
