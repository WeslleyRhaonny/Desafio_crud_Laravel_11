@extends('painel.templates.template')

@section('main')

    <div class="mt-5 mx-3 bg-white p-3">
        
        <h1>Cadastrar Nova transação</h1>

        <form action="{{ route('painel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="modalidade" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status_id" required>
                        <option value="">Selecione um Status</option>
                        @foreach($statusTransacoes as $status)
                            <option value="{{ $status->id }}">{{ $status->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="cpf" 
                        name="cpf" 
                        minlength="14" 
                        maxlength="14" 
                        required 
                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
                        title="O CPF deve estar no formato 000.000.000-00."
                    >
                    <div class="invalid-feedback">
                        Por favor, insira um CPF válido no formato 000.000.000-00.
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="valor" class="form-label">Valor</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="text" class="form-control" id="valor" name="valor" step="0.01" required>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mb-3">
                <label for="arquivo" class="form-label">Anexar Comprovante</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="arquivo" name="arquivo" required>
                </div>
                <small class="form-text text-muted">
                    Formatos permitidos: PDF, JPG ou PNG. Tamanho máximo: 10MB.
                </small>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
@endsection

@section('scripts')


    <script>
        $(document).ready(function() {
            // Máscara para o CPF (formato XXX.XXX.XXX-XX)
            $('#cpf').mask('000.000.000-00');
            
            // Máscara para valor monetário com o formato R$ XXX.XXX,00
            $('#valor').mask('000.000.000.000,00', {reverse: true});
        });
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            // Evita o envio se o formulário for inválido
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            // Adiciona a classe de validação Bootstrap
            this.classList.add('was-validated');
        }, false);
    </script>

@endsection