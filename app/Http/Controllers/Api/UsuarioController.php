<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    public function update(Request $request, Usuario $user)
    {
        $user->username = $request->input('username');
        $user->password = \bcrypt($request->input('password'));
        $user->type_id = $request->input('type');

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $user)
    {
        try
        {
            $user->delete();
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

    public function getUser ()
    {
        $user = Auth::user();
        $response = \response()->json([$user], 200);

        return $response;
    }

}
