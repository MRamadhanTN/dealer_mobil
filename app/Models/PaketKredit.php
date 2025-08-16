<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaketKredit extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'paket_kredit';
    protected $primaryKey = 'kode_paket';

    protected $fillable = ['harga_min', 'harga_max', 'uang_muka', 'jumlah_cicilan', 'bunga'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attributes['kode_paket'])) {
                $model->attributes['kode_paket'] = static::generateId();
            }
        });
    }

    public static function generateId() {
        $prefix = 'paket-';
        $lastId = DB::table('paket_kredit')->orderBy('kode_paket', 'desc')->first();
        $lastNumber = 1;

        if ($lastId) {
            $lastNumber = (int) substr($lastId->kode_paket, strlen($prefix)) + 1;
        }
        return $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
    }
}
