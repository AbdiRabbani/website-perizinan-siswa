<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Departement;
use App\Izin;

class PermitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permit = Izin::where('id_user', Auth()->user()->id)->get()->all();
        $mydept = Departement::where('id_user', Auth()->user()->id)->get()->all();
        $departement = Departement::all();
        $spermit = Izin::where('status', 'menunggu')->get()->all();
        return view('permit.index', compact('departement', 'permit','mydept', 'spermit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $destination_path = 'public/images';
        $image = $request -> file('bukti');
        $image_name = $image->getClientOriginalName();
        $path = $request->file('bukti')->storeAs($destination_path, $image_name);
        $data['bukti'] = $image_name;

        Izin::create($data);
        return redirect("/permit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permit = Izin::find($id);
        return view('permit.detail', compact('permit'));
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
        Izin::find($id)->update($request->all());
        return back();
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Izin::find($id)->delete();
        return redirect('/permit');
    }
}
