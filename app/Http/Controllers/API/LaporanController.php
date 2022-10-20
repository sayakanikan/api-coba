<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laporan::all();

        return response()->json([
            'status'    => 200,
            'message'   => 'data berhasil diambil',
            'data'      => $data
        ]);
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
        $validasi = $request->validate([
            'user_id'   => 'required',
            'laporan'   => 'required',
            'status'    => 'required',
            'foto'      => 'file|mimes:png,jpg'
        ]);

        try {
            $fileName = time().$request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('uploads/laporans', $fileName);
            $validasi['foto'] = $path;
            $response = Laporan::create($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'data berhasil ditambahkan',
                'data'      => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
        // $validasi['user_id'] = auth()->user()->id;

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $validasi = $request->validate([
            'user_id'   => '',
            'laporan'   => '',
            'status'    => 'required',
            'foto'      => ''
        ]);

        // $validasi['user_id'] = auth()->user()->id;

        try {
            if ($request->file['foto']){
                $fileName = time().$request->file('foto')->getClientOriginalName();
                $path = $request->file('foto')->storeAs('uploads/laporans', $fileName);
                $validasi['foto'] = $path;
            }
            $response = Laporan::where('id', $id)
            ->update($validasi);

            return response()->json([
                'status'    => 200,
                'message'   => 'data berhasil diupdate',
                'data'      => $response
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }


        // TRY CATCH
        // $validasi = $request->validate([
        //     'user_id'   => 'required',
        //     'laporan'   => 'required',
        //     'status'    => 'required|numeric',
        //     'foto'      => 'file'
        // ]);

        // try {
        //     if ($request->file['foto']){
        //         $fileName = time().$request->file('foto')->getClientOriginalName();
        //         $path = $request->file('foto')->storeAs('uploads/laporans', $fileName);
        //         $validasi['foto'] = $path;
        //     }
        //     $response = Laporan::where('id', $id)->update($validasi);

        //     return response()->json([
        //         'status'    => 200,
        //         'message'   => 'data berhasil diupdate',
        //         'data'      => $response
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'errors'   => $e->getMessage()
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Laporan::destroy($id);

            return response()->json([
                'status'    => 200,
                'message'   => 'data berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'   => 'Err',
                'errors'   => $e->getMessage()
            ]);
        }
    }

    // public function cari(Request $request){
    //     $keyword = $request->keyword;
    //     $data = DB::table('laporans')->where('laporan','like','%'.$keyword.'%')->get();

    // }
}
