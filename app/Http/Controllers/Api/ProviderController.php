<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Resources\ProviderResource;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $providers = Provider::with(['user', 'orders'])->get();
        $providers = Provider::with(['user'])->get();

        return ProviderResource::collection($providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Usuario $usuario)
    {
        $provider = new Provider();

        $provider->user_id = $request->input('id');
        $provider->menus = 0;
        $provider->name = $request->input('username');
        $provider->street = 'Via Laietana';
<<<<<<< Updated upstream
=======
        $provider->img = 'img/negocios/negocio1.png';
>>>>>>> Stashed changes


        try
        {
            $provider->save();
            // $request->session()->flash('mensaje', 'Resgistro agg correctamente');
            $response = (new ProviderResource($provider))
                        ->response()
                        ->setStatusCode(201);
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
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        $provider = Provider::find($provider->user_id);
        return new ProviderResource($provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $provider->menus = $request->input('menus');

        try
        {
            $provider->save();
            // $request->session()->flash('mensaje', 'Resgistro agg correctamente');
            $response = (new ProviderResource($provider))
                        ->response()
                        ->setStatusCode(201);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
