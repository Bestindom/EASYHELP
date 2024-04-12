<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Usuario::with(['type' , 'rider'])->get();

        return UsuarioResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Usuario();

        $user->username = $request->input('username');
        $user->password = \bcrypt($request->input('password'));
        $user->type_id = $request->input('type');

        switch ($user->id)
        {
            case '2':
                break;
            case '3':
                insertProvider($user);
                break;
            case '4':
                break;
        }



        try
        {
            $user->save();
            // $request->session()->flash('mensaje', 'Resgistro agg correctamente');
            $response = (new UsuarioResource($user))
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
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $user)
    {
        $user = Usuario::with('type')->find($user->id);
        return new UsuarioResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        try
        {
            $usuario->delete();
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

    public function insertProvider($user)
    {
        $provider = new Provider();

        $provider->user_id = $user->id;
        $provider->menus = 0;
        $provider->street = 'Via Laietana';
        $provider->number = 13;
        $provider->province = 'Barcelona';
        $provider->municipality = 'Barcelona';
        $provider->cp = '08001';


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
}
