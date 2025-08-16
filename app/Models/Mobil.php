<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mobil extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'mobil';
    protected $primaryKey = 'kode_mobil';

    protected $fillable = ['merk', 'type', 'warna', 'harga', 'gambar'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attributes['kode_mobil'])) {
                $model->attributes['kode_mobil'] = static::generateKodeMobil();
            }
        });
    }

    public static function generateKodeMobil() {
        $prefix = 'mobil-';
        $lastId = DB::table('mobil')->orderBy('kode_mobil', 'desc')->first();
        $lastNumber = 1;

        if ($lastId) {
            $lastNumber = (int) substr($lastId->kode_mobil, strlen($prefix)) + 1;
        }
        return $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
    }
}