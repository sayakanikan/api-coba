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
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    
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

    public function register(Request $request)
    {
        $validasi = $request->validate([
            'name'      => 'required',
            'username'  => 'required|min:5',
            'email'     => 'required|email:dns',
            'password'  => 'required|min:5',
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

    public function login(Request $request){
        $login = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if (! $token = auth()->attempt($login)) {
            return response()->json([
                'status'    => 'Err',
                'message'   => 'Username / Password salah'
            ], 401);
        }

        try {
            return $this->respondWithToken($token);
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
        auth()->logout();

        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Berhasil Logout'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'role'  => auth()->user()->role_id
        ]);
    }   

    public function getUser(){
        $this->authorize('admin');

        $data = User::where('role_id', 0)->with('laporan')->get();

        return response()->json([
            'status'    => 200,
            'message'   => 'Data Akun Berhasil Diambil',
            'data'      => $data
        ]);
    }

    public function showUser($id){
        $response = User::where('id', $id)->get();
        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Data akun berhasil diambil',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'name'      => '',
            'username'  => '',
            'email'     => 'email:dns',
            'password'  => '',
            'role_id'   => ''
        ]);

        if(!$validasi['password']){
            $data = \Illuminate\Support\Facades\DB::table('users')->where('id', $id)->get('password');
            $validasi['password'] = $data[0]->password;
        }else if ($validasi['password']) {
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

    public function destroy($id){
        User::destroy($id);
        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Akun Berhasil Dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function getAdmin(){
        $this->authorize('admin');

        $data = User::where('role_id', 1)->get();
        $laporan = User::with('laporanAdmin');

        return response()->json([
            'status'    => 200,
            'message'   => 'Data Akun Berhasil Diambil',
            'data'      => $data,
            'laporan'   => $laporan
        ]);
    }

    public function showAdmin($id){
        $response = User::where('id', $id)->get();
        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Data akun berhasil diambil',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }
}