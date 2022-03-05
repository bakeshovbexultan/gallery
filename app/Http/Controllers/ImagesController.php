<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class ImagesController extends Controller
{
    private $images;

    public function __construct(ImageService $imageService) {
        $this->images = $imageService;
    }

    function index() {
        $images = $this->images->all();
        return view('welcome', ['imagesInView' => $images]);
    }

    function create() {
        return view('create');
    }

    function store(Request $request) {
        $image = $request->file('image');
        $this->images->add($image);

        return redirect('/');
    }

    function show($id) {
        $myImage = $this->images->one($id);
        return view('show', ['imageInView' => $myImage->image]);
    }

    function edit($id) {
        $image = $this->images->one($id);

        return view('edit', ['imageInView' => $image]);
    }

    function update(Request $request, $id) {
        $this->images->update($id, $request->image);

        return redirect('/');
    }

    function delete($id) {
        $this->images->delete($id);
        return redirect('/');
    }
}
