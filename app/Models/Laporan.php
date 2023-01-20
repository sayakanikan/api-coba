<?php

namespace App\Models;

use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model implements JWTSubject
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
        ->join('users','laporans.user_id','=','users.id')->get();
        return $hasil;
    }

    static function admin(){
        $hasil = DB::table('laporans')
        ->join('users','laporans.admin_id','=','users.id')->select('users.name')->first();
        return $hasil;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
