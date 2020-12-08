<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Coupon::all();
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
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else {
            $coupon = new Coupon;
            $coupon->user_id = $request->user()->id;
            $coupon->description = $request->description;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->save();

            return response()->json([
                'message' => "Your coupon has been submitted successfully",
                'coupon'=> $coupon
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon   $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return $coupon;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = \Validator::make($request->all(), [
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else {
            $coupon->update($request->all());

            return response()->json([
                'message' => "Your coupon has been updated successfully",
                'coupon'=> $coupon
            ], 200);
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
        $coupon = Coupon::findOrFail($id);
        if($coupon) {
            $coupon->delete();
            return response()->json([
                'message' => "Your coupon has been deleted successfully"
            ], 200);
        }
        else {
            return response()->json([
                'message' => "Error after deleting"
            ], 502);
        }
    }
}
