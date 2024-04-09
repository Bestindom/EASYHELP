<?php

namespace App\Http\Controllers\Api;

use App\Models\Point;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use Illuminate\Database\QueryException;


class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = Point::all();

        return PointResource::collection($points);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $point = new Point();

        $point->latitud = $request->input('latitud');
        $point->longitud = $request->input('longitud');


        try
        {
            $point->save();
            // $request->session()->flash('mensaje', 'Resgistro agg correctamente');
            $response = (new PointResource($point))
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
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        try
        {
            $point->delete();
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
