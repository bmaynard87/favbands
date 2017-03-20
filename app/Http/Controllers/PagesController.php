<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Band;
use App\Album;

class PagesController extends Controller
{

	public function index()
	{
		return $this->bands();
	}

	public function bands()
	{
		return view('pages.bands', [
			'page' => 'bands'
		]);
	}

	public function showBand($id)
	{
		$band = Band::findOrFail($id);

		return view('pages.band', [
			'page' => 'band',
			'band' => $band
		]);
	}

	public function showAlbum($id)
	{
		$album = Album::findOrFail($id);

		return view('pages.album', [
			'page' => 'album',
			'album' => $album
		]);
	}

	public function albums()
	{
		return view('pages.albums', [
			'page' => 'albums'
		]);
	}

}
