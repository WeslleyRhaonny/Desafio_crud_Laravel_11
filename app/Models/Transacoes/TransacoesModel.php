<?php

namespace App\Models\Transacoes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;
use App\Models\User;

class TransacoesModel extends BaseModel
{
    use HasFactory, SoftDeletes;
    protected $table = "transacoes";

    protected $fillable = [
        'status_id',
        'cpf',
        'valor',
        'arquivo_id',
        'criado_por_id',
    ];

    protected function casts(){
        return [
            'status_id'=> 'integer',
            'cpf'=> 'string',
            'valor'=> 'float',
            'criado_por_id'=> 'integer',
            'id_arquivo_atual'=> 'integer',
        ];
    }

    public function status(){
        return $this->belongsTo(StatusTransacoesModel::class,'status_id');
    }

    public function arquivos(){
        return $this->hasMany(ArquivosModel::class, 'transacao_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'criado_por_id');
    }
}
