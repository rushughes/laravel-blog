<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index () {
      $photos = Photo::all();

      return view('admin.media.index', compact('photos'));
    }

    public function create () {

      return view('admin.media.create');
    }

    public function store (Request $request) {
      if ($file = $request->file('file')) {
        $name = time() . '-' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $name);
        $photo = Photo::create(['file' => $name]);
      }
    }

    public function destroy($id) {
      $photo = Photo::findOrFail($id);

      if ($photo->delete()) {
        Session::flash('message', 'Photo was successfully deleted!');
      } else {
        Session::flash('message', 'Photo was not deleted!');
      }

      return redirect()->route('media.index');
    }
}
