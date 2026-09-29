<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {
    use HasFactory;
    protected $fillable = ['nim', 'nama_lengkap', 'program_studi', 'email', 'no_hp', 'skema_id'];

    public function skema() {
        return $this->belongsTo(Skema::class);
    }
}