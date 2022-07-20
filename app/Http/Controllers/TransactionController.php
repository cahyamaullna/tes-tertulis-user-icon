<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('time', 'DESC')->paginate(5);
        $response = [
            'message' => 'List transaction order by time',
            'data' => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Transaction created',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_CREATED);
        } 
        
        catch(QueryException $e){
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
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
        $transaction = Transaction::findorFail($id);
        $response = [
            'message' => 'Detail of transaction resource',
            'data' => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $transaction = Transaction::findorFail($id);
        $validator = Validator::make($request->all(), [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['required'],
            'password' => ['required']
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{
            $transaction->update($request->all());
            $response = [
                'message' => 'Transaction updated',
                'data' => $transaction
            ];

            return response()->json($response, Response::HTTP_OK);
        } 
        
        catch(QueryException $e){
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
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
        $transaction = Transaction::findorFail($id);

        try{
            $transaction->delete();
            $response = [
                'message' => 'Transaction deleted'
            ];

            return response()->json($response, Response::HTTP_OK);
        } 
        
        catch(QueryException $e){
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
        }
    }
}
