<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model {
    use HasFactory;
    protected $fillable = ['kode_skema', 'nama_skema', 'jenis'];

    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class);
    }
}