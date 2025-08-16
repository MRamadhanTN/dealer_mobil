<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cicilan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kode_cicilan';

    protected $fillable = ['kode_transaksi', 'status_cicilan', 'jatuh_tempo', 'total_bayar', 'cicilan_ke'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attributes['kode_cicilan'])) {
                $model->attributes['kode_cicilan'] = static::generateId();
            }
        });
    }

    public static function generateId() {
        $prefix = 'cicilan-';
        $lastId = DB::table('cicilans')->orderBy('kode_cicilan', 'desc')->first();
        $lastNumber = 1;

        if ($lastId) {
            $lastNumber = (int) substr($lastId->kode_cicilan, strlen($prefix)) + 1;
        }
        return $prefix . str_pad($lastNumber, 5, '0', STR_PAD_LEFT);
    }

    public function transaksi() {
        return $this->belongsTo(Order::class, 'kode_transaksi', 'kode_transaksi');
    }

}
