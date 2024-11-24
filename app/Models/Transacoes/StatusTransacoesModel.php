<?php

namespace App\Models\Transacoes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class StatusTransacoesModel extends BaseModel
{
    use HasFactory;

    protected $table = "status_transacoes";

    protected $fillable = [
        'nome',
    ];

    protected function casts(){
        return [
            'nome' => 'string',
        ];
    }

    public function transacoes(){
        return $this->hasMany(TransacoesModel::class);
    }
}
