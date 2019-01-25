<?php

namespace App\Http\Controllers;

use App\Lien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LienController extends Controller
{
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
        return view('lien/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lien = new Lien();
        $lien->title = $request->title;
        $lien->url = $request->url;
        if ($request->code == null) {
            $lien->code = str_random(12);
        } else {
            $lien->code = $request->code;
        }
        if (Auth::check()) {
            $lien->user_id = Auth::id();
        }

        if(Lien::where('code', $request->code)->get()->count() > 0) {
            return redirect('lien/create')->with('message', 'Code déjà pris!');
        }

        $lien->save();

        return redirect('lien/create')->with('message', 'Shortlink created!');
    }

    public function redirection($code)
    {
        $lien = Lien::where('code', $code)->get()->first();

        $data = array(
            'lien' => $lien
        );

        $lien->nb_visit++;
        $lien->update();

        return redirect()->to($lien->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function show(Lien $lien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function edit(Lien $lien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lien $lien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lien  $lien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lien $lien)
    {
        //
    }
}
