@extends('painel.templates.template')

@section('main')
    <div class="mt-5 mx-3 bg-white p-3">

        <h1 class="mt-3">Listagem de Transações</h1>
        

        <!-- Barra de busca -->
        <form method="GET" action="{{ route('painel.index') }}" class="row mb-3">
            <div class="col-md-2">
                <!-- Seletor de quantidade de itens por página -->
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 por página</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 por página</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 por página</option>
                </select>
            </div>
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Buscar pelo cpf"
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <!-- Botão para abrir o modal de filtros -->
                <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#filtrosModal">
                    Filtros
                </button>
            </div>
            <div class="col-md-2">
                <!-- Botão de busca -->
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>

            <!-- Campos ocultos para manter os filtros aplicados -->
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="data_inicio" value="{{ request('data_inicio') }}">
            <input type="hidden" name="data_fim" value="{{ request('data_fim') }}">
            <input type="hidden" name="valor_min" value="{{ request('valor_min') }}">
            <input type="hidden" name="valor_max" value="{{ request('valor_max') }}">
        </form>

    <!-- Modal de filtros -->
    <div class="modal fade" id="filtrosModal" tabindex="-1" aria-labelledby="filtrosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtrosModalLabel">Filtros Avançados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="GET" action="{{ route('painel.index') }}">

                        <!-- Campo Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="">Selecione</option>
                                @foreach($statusTransacoes as $status)
                                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campos de Data -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_inicio" class="form-label">Data Início</label>
                                <input type="date" name="data_inicio" class="form-control" value="{{ request('data_inicio') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data_fim" class="form-label">Data Fim</label>
                                <input type="date" name="data_fim" class="form-control" value="{{ request('data_fim') }}">
                            </div>
                        </div>

                        <!-- Campos de Valor -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="valor_min" class="form-label">Valor Mínimo</label>
                                <input type="number" name="valor_min" class="form-control" placeholder="0.00" step="0.01" value="{{ request('valor_min') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="valor_max" class="form-label">Valor Máximo</label>
                                <input type="number" name="valor_max" class="form-control" placeholder="0.00" step="0.01" value="{{ request('valor_max') }}">
                            </div>
                        </div>

                        <!-- Campos ocultos para manter o valor da busca -->
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 85%;">Dados da Transação</th> <!-- Ocupa 85% -->
                    <th style="width: 15%; text-align: center;">Ações</th> <!-- Ocupa 15% -->
                </tr>
            </thead>
            <tbody>
                @foreach ($transacoes as $transacao)
                <tr>
                    <!-- Coluna de dados -->
                    <td>
                        <a href="{{ route('painel.show', $transacao->id) }}" class="d-block text-decoration-none">
                            R$ {{ number_format($transacao->valor, 2, ',', '.') }} - {{ $transacao->status->nome }} - {{ $transacao->created_at }} 
                        </a>
                    </td>
                    
                    <!-- Coluna de ações -->
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <div class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('painel.show', $transacao->id) }}">Ver</a></li>
                                <li><a class="dropdown-item" href="{{ route('painel.edit', $transacao->id) }}">Editar</a></li>
                                <li>
                                    <form action="{{ route('painel.destroy', $transacao->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Excluir</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Navegação de paginação -->
        <div class="d-flex justify-content-center">
            {{ $transacoes->appends(request()->input())->links('pagination.custom') }}
        </div>
        <div class="mt-3">
            <p>Mostrando de {{ $transacoes->firstItem() ?? 0 }} a {{ $transacoes->lastItem() ?? 0 }} do total de {{ $transacoes->total() ?? 0 }} Transações</p>
        </div>

    </div>
@endsection
