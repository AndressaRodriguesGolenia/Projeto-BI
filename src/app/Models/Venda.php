<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'nome_cliente',
        'cidade',
        'estado',
        'rastreio',
        'data_venda',
        'status',
    ];
}
