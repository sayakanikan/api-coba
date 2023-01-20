<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function index()
    {
        $this->authorize('admin');

        // $data = Laporan::getLaporan();
        $laporan = Laporan::with('user')->get();

        return response()->json([
            'status'    => 200,
            'message'   => 'Data Berhasil Diambil',
            'laporan'   => $laporan
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('user');

        $validasi = $request->validate([
            'user_id'   => '',
            'laporan'   => 'required',
            'status'    => 'required',
            'foto'      => 'required'
        ]);

        $validasi['user_id'] = auth()->user()->id;

        try {
            $response = Laporan::create($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'Data Berhasil Ditambahkan',
                'laporan'   => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $response = Laporan::where('id', $id)->with('user')->get();
        $laporan = Laporan::admin();
        
        try {
            return response()->json([
                'status'    => 200,
                'message'   => 'Data laporan berhasil diambil',
                'laporan'   => $response,
                'admin'     => $laporan
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
            'user_id'   => '',
            'laporan'   => '',
            'status'    => 'required',
            'foto'      => ''
        ]);

        if (auth()->user()->role_id === 0){
            $validasi['user_id'] = auth()->user()->id;
        } else {
            $validasi['admin_id'] = auth()->user()->id;
        }

        try {
            Laporan::where('id', $id)->update($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'Data Berhasil Diupdate',
                'laporan'   => $validasi
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function image(Request $request){
        try {
            $uploadedFileUrl = Cloudinary::upload($request->file('foto')->getRealPath())->getSecurePath();

            return response()->json([
                'status'    => 200,
                'message'   => 'Foto Berhasil Diupload',
                'url'       => $uploadedFileUrl
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function history(){        
        try{
            $user = auth()->user()->id;
            $data = DB::table('laporans')->where('user_id', $user)->get();

            return response()->json([
                'status'    => 200,
                'message'   => 'Data berhasil didapatkan',
                'laporan'   => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    public function historyUser($id){        
        try{
            $data = DB::table('laporans')->where('user_id', $id)->get();

            return response()->json([
                'status'    => 200,
                'message'   => 'Data berhasil didapatkan',
                'laporan'   => $data
            ]);
        }catch(Exception $e){
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }
}
