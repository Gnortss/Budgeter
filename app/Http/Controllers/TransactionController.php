<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = auth()->user()->id;
        return Transaction::where('user_id', $uid)->get();
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
            'category_id' => 'required',
            'amount' => 'required',
            'expense' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        else {
            $transaction = new Transaction;
            $transaction->user_id = $request->user()->id;
            $transaction->category_id = $request->category_id;
            $transaction->amount = $request->amount;
            $transaction->expense = $request->expense;
            $transaction->description = $request->description;
            $transaction->save();

            return response()->json([
                'message' => "Your transaction has been submitted successfully",
                'transaction'=> $transaction
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
        return Transaction::where('user_id', $uid)->findOrFail($id);
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
        $transaction = Transaction::where('user_id', $uid)->findOrFail($id);
        if($transaction) {
            $transaction->delete();
            return response()->json([
                'message' => "Your transaction has been deleted successfully"
            ], 200);
        }
        else {
            return response()->json([
                'message' => "Error after deleting"
            ], 502);
        }
    }
}
