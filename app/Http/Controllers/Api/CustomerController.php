<?php

namespace App\Http\Controllers\Api;

use App\Clases\Utilitat;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $customer->amount = $request->input('amount');
        $customer->latitud = $request->input('latitud');
        $customer->longitud = $request->input('longitud');

        try
        {
            $customer->save();
            $response = $response = response()->json($customer, 201);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()
                        ->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try
        {
            $customer->delete();
            $response = \response()
                        ->json(['mensaje' => 'Resgistro eliminado correctamente'], 200);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()
                        ->json(['error' => $mensaje], 400);
        }

        return $response;
    }
}
