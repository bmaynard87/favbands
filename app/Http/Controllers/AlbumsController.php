<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        if( ! is_null($id)) {
            return $this->show($id);
        }

        return Album::orderBy('id', 'asc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new Album;
        $album->name = $request->input('name');
        $album->recorded_date = $request->input('recorded_date') != '0000-00-00' ? date('Y-m-d', strtotime($request->input('recorded_date'))) : null;
        $album->release_date = $request->input('release_date') != '0000-00-00' ? date('Y-m-d', strtotime($request->input('release_date'))) : null;
        $album->number_of_tracks = $request->input('number_of_tracks');
        $album->label = $request->input('label');
        $album->producer = $request->input('producer');
        $album->genre = $request->input('genre');
        $album->band_id = $request->input('band_id');

        $album->save();

        return "{$album->name} added successfully!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Album::find($id);
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
        $album = Album::find($id);
        $album->name = $request->input('name');
        $album->recorded_date = date('Y-m-d', strtotime($request->input('recorded_date')));
        $album->release_date = date('Y-m-d', strtotime($request->input('release_date')));
        $album->number_of_tracks = $request->input('number_of_tracks');
        $album->label = $request->input('label');
        $album->producer = $request->input('producer');
        $album->genre = $request->input('genre');

        $album->save();

        return "{$album->name} updated successfully!";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $album_name = $album->name;

        $album->delete();

        return "$album_name deleted successfully!";
    }

    /**
     * Get albums by band ID
     *
     * @param int $band_id
     * @return \Illuminate\Http\Response
     */
    public function getAlbumsByBandId($band_id)
    {
        return Album::where('band_id', $band_id)->get();
    }
}
