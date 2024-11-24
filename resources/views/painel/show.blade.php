@extends('painel.templates.template')  <!-- Altere para o layout que você está usando -->

@section('main')
<div class="container mt-5">
    <h1>Detalhes da Transação</h1>

    <div class="card">
        <div class="card-header">
            <p><strong>ID: </strong>{{ $transacao->id }}</p>
        </div>
        <div class="card-body">
            <h5 class="card-title">Informações Gerais</h5>
            <p><strong>Data:</strong> {{ $transacao->created_at }}</p>
            <p><strong>Status:</strong> {{ $transacao->status->nome }}</p>
            <p><strong>CPF:</strong> {{ $transacao->cpf }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($transacao->valor, 2, ',', '.') }}</p>
            <p><strong>Criada por:</strong> {{ $transacao->usuario->email ?? 'Não disponível' }}</p>
            <p><strong>Comprovante:</strong>
                <a href="{{ route('painel.files.show', $transacao->id_arquivo_atual) }}" target="_blank" class="btn btn-link">
                Clique para ver
                </a>
            </p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('painel.index') }}" class="btn btn-secondary">Voltar para a lista</a>
    </div>
</div>
@endsection
