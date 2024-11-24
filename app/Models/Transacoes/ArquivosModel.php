<?php

namespace App\Models\Transacoes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;
use App\Models\User;

class ArquivosModel extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = "arquivos";

    protected $fillable = [
        'contrato_id',
        'arquivo',
        'transacao_id',
    ];

    protected function casts(){
        return [
            'contrato_id' => 'integer',
            'arquivo' => 'string',
            'transacao_id'=> 'integer',
        ];
    }

    public function transacao(){
        return $this->belongsTo(TransacoesModel::class, 'transacao_id');
    }

}
