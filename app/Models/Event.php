<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama default (events)
    protected $table = 'tbl_event';
    protected $primaryKey = 'id_event'; // Menentukan primary key
    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'nama',
        'alamat',
        'nohp',
        'sales',
        'sh',
        'brand',
        'hadir'
    ];
}
