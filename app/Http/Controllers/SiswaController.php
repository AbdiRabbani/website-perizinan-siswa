<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Siswa;
use App\User;
use Hash;

class SiswaController extends Controller
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
        //
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

        $dataSiswa = [
            'id_user' => $data['id_user'],
            'nisn' => $data['nisn'],
            'nis' => $data['nis'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
        ];

        $dataUser = [
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
        ];

        $validator = Validator::make($dataSiswa,[
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:10240'
        ]);

        $destination_path = 'public/images'; //path tempat penyimpanan (storage/public/images/profile)
        $image = $request -> file('foto'); //mengambil request column foto
        $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
        $path = $request->file('foto')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
        $dataSiswa['foto'] = $image_name; //mengirimkan ke database

        
        $user = User::find(Auth()->user()->id);
        $user ->update($dataUser);
        Siswa::create($dataSiswa);
        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data = $request->all();

        $dataSiswa = [
            'id_user' => $data['id_user'],
            'nisn' => $data['nisn'],
            'nis' => $data['nis'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
        ];

        $dataUser = [
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];


        $validator = Validator::make($dataSiswa,[
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:10240'
        ]);

        if($request->hasFile('foto')) {
            $destination_path = 'public/images'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('foto'); //mengambil request column foto
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('foto')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataSiswa['foto'] = $image_name; //mengirimkan ke database
        }

        $siswa = Siswa::find($id);
        $user = User::find($siswa->id_user);
        $user ->update($dataUser);
        $siswa->update($dataSiswa);
        return redirect('/profile');
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
