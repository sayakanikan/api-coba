<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');

        $data = User::all();

        return response()->json([
            'status'    => 200,
            'message'   => 'Data Akun Berhasil Diambil',
            'data'      => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email:dns',
            'password'  => 'required',
            'role_id'   => ''
        ]);

        $validasi['password'] = bcrypt($validasi['password']);
        
        if ($validasi['role_id'] == 1){
            $validasi['role_id'] = 1;
        }else{
            $validasi['role_id'] = 0;
        }

        try {
            $response = User::create($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil Register',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
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
        $validasi = $request->validate([
            'name'      => '',
            'email'     => 'email:dns',
            'password'  => ''
        ]);

        if ($validasi['password']) {
            $validasi['password'] = bcrypt($validasi['password']);
        }

        try {
            $response = User::where('id', $id)->update($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'Akun Berhasil Diupdate',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request){
        $login = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if (!Auth::attempt($login)){
            return response()->json([
                'status'    => 'Err',
                'message'   => 'Username / Password salah'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24);

        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil Login'
            ])->withCookie($cookie);

        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function getLogin(){
        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil dapat data login',
                'data'      => Auth::user()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }        
    }

    public function logout(){
        $cookie = Cookie::forget('jwt');

        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil Logout'
            ])->withCookie($cookie);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }
}