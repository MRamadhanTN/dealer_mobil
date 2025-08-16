<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'pembeli';
    protected $primaryKey = 'ktp';

    protected $fillable = ['ktp', 'nama', 'alamat', 'telp'];
}
