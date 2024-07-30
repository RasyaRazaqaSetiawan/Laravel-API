<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;
    public $fillable = ['nama_pemain', 'foto', 'tgl_lahir', 'harga_pasar', 'posisi', 'negara', 'id_klub'];

    public function Klub()
    {
        return $this->belongsTo(Klub::class, 'id_klub');
    }
}
