<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kartu_keluarga extends Model
{
    //
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];
    protected $fillable = [ 
        'no_kk',
        'tanggal_dokumen',
        'nama_kepala_keluarga',
        'rt',
        'rw',
        'kodepos',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_pejabat',
        'nip',
    ];
    protected $dates = ['tanggal_dokumen'];
    public function kk_item(){
        return $this->hasMany(Kartu_keluarga_item::class);
    }
}
