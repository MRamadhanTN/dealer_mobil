<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kode_transaksi';

    protected $fillable = ['ktp', 'kode_mobil', 'kode_paket', 'type_pembayaran', 'total_harga', 'total_pembayaran', 'tanggal_bayar', 'fotokopi_ktp', 'fotokopi_kk', 'fotokopi_slip_gaji'];

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->attributes['kode_transaksi'])) {
                $model->attributes['kode_transaksi'] = 'TRX-'.strtotime('now');
            }
        });
    }

    public function pembeli() {
        return $this->belongsTo(Pembeli::class, 'ktp', 'ktp');
    }

    public function mobil() {
        return $this->belongsTo(Mobil::class, 'kode_mobil', 'kode_mobil');
    }

    public function paket_kredit() {
        return $this->belongsTo(PaketKredit::class, 'kode_paket', 'kode_paket');
    }

    public function cicilan() {
        return $this->hasMany(Cicilan::class, 'kode_transaksi', 'kode_transaksi');
    }
}
