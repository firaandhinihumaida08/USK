<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $fillable = ['nama_asesor', 'no_registrasi', 'keahlian'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
