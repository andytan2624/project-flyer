<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\Http\Requests\FlyerRequest;

use Illuminate\Http\Request;

use App\Http\Controllers\Traits\AuthorizesUsers;

use Illuminate\Http\UploadedFile;

class FlyersController extends Controller
{
    use AuthorizesUsers;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        flash()->overlay('Hello World', 'This is the message');
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {

        Flyer::Create($request->all());

        flash()->success('Welcome Aboard', 'Thank you for signing up.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }

    /**
     * @param $zip
     * @param $street
     * @param Request $request
     */
    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
           'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $flyer = Flyer::locatedAt($zip, $street);

        if (! $this->userCreatedFlyer($request)) {
            return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));

        $flyer->addPhoto($photo);
    }


    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())->move($file);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
