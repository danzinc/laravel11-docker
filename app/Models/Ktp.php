<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ktp extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];
    protected $fillable = [
        'ktp_no',
        'nama',
        'alamat',
        'rt',
        'rw',
        'kodepos',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'golongan_darah',
        'foto',
        'foto_ttd',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan',
        'pekerjaan',
        'jenis_pendidikan',
        'status_perkawinan',
        'kewarganegaraan',
        'no_passport',
        'no_kitap',
        'nama_ayah',
        'nama_ibu'
    ];
    protected $dates = ['tanggal_lahir'];
    public function kk_item(){
        return $this->hasMany(Kartu_keluarga_item::class);
    }
}
