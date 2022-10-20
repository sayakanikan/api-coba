<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;

class Laporan extends Model
{
    use HasFactory;
    // protected $table = 'laporans';
    // public $primaryKey = 'id';
    // protected $fillable = [
    //     'user_id','laporan', 'status', 'foto'
    // ];

    protected $guarded = ['id'];

    static function getLaporan(){
        $hasil = DB::table('laporans')
        ->join('users','laporans.user_id','=','users.id');
        return $hasil;
    }
}
