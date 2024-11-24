<?php
namespace App\Http\Controllers\Painel;

use App\Models\Transacoes\ArquivosModel;
use App\Models\Transacoes\TransacoesModel;
use App\Models\Transacoes\StatusTransacoesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class TransacaoController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        // Número de itens por página (padrão é 10)
        $perPage = $request->input('per_page', 10);

        // Iniciar a query com os relacionamentos necessários
        $transacoesQuery = TransacoesModel::with(['status']);

        // Aplicar filtros de busca
        if ($request->filled('search')) {
            $search = $request->input('search');
            $transacoesQuery->where(function ($query) use ($search) {
                $query->whereRaw('REPLACE(REPLACE(REPLACE(cpf, ".", ""), "-", ""), " ", "") LIKE ?', ["$search%"])
                    ->orWhere("cpf", "like","$search%");
            });
        }

        // Aplicar filtros avançados

        if ($request->filled('status')) {
            $transacoesQuery->where('status_id', $request->input('status'));
        }

        if ($request->filled('data_inicio') && $request->filled('data_fim')) {
            $dataInicio = Carbon::parse($request->input('data_inicio'))->startOfDay();
            $dataFim = Carbon::parse($request->input('data_fim'))->endOfDay();
            $transacoesQuery->whereBetween('created_at', [$dataInicio, $dataFim]);
        }

        if ($request->filled('valor_min')) {
            $transacoesQuery->where('valor', '>=', (float) $request->input('valor_min'));
        }

        if ($request->filled('valor_max')) {
            $transacoesQuery->where('valor', '<=', (float) $request->input('valor_max'));
        }

        // Usar paginate diretamente na query
        $transacoes = $transacoesQuery->paginate($perPage)->withQueryString();

        $statusTransacoes = StatusTransacoesModel::all();

        // Retornar a view com os dados e os filtros aplicados
        return view('painel.index', compact('transacoes', 'statusTransacoes'))
            ->with([
                'search' => $request->input('search'),
                'status' => $request->input('status'),
                'data_inicio' => $request->input('data_inicio'),
                'data_fim' => $request->input('data_fim'),
                'valor_min' => $request->input('valor_min'),
                'valor_max' => $request->input('valor_max')
            ]);
    }
    
    public function create()
    {       
        // Pega todas as situações e modalidades
        $statusTransacoes = StatusTransacoesModel::all();
            
        // Retorna a view com os dados
        return view('painel.create', compact(['statusTransacoes']));
    }
      
    protected function validateAndSave(Request $request)
    {
        // Validação dos dados de entrada
        $data = $request->validate([
            'status_id' => 'required|exists:status_transacoes,id',
            'cpf' => 'required|string|min:14|max:14',
            'valor' => 'required|regex:/^\d{1,3}(\.\d{3})*(,\d{2})?$/',
            'arquivo' => 'nullable|file|mimes:pdf,jpg,png|max:10240', // Valida um único arquivo
        ], [
            'status_id.required' => 'O campo status é obrigatório.',
            'status_id.exists' => 'O status selecionado é inválido.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma string.',
            'cpf.min' => 'O campo CPF deve ter 14 caracteres.',
            'cpf.max' => 'O campo CPF deve ter 14 caracteres.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.regex' => 'O campo valor deve ser um valor monetário.',
            'arquivo.file' => 'O campo arquivo deve conter um arquivo.',
            'arquivo.mimes' => 'O arquivo deve estar nos formatos PDF, JPG ou PNG.',
            'arquivo.max' => 'O arquivo deve ter no máximo 10MB.',
        ]);
    
        // Formata o valor para salvar corretamente no banco de dados
        $data['valor'] = (double) str_replace(['.', ','], ['', '.'], $data['valor']);
    
        // Adiciona o id do usuário autenticado aos dados
        $data['criado_por_id'] = Auth::id();
    
        // Cria a transação
        $transacao = TransacoesModel::create($data);
    
        // Tratamento do upload do arquivo
        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');
    
            // Cria a pasta no formato "transacao_{id}"
            $folder = "transacao_{$transacao->id}";
    
            // Define o nome do arquivo
            $fileName = "arquivo_" . time() . '.' . $file->getClientOriginalExtension();
    
            // Salva o arquivo na pasta "storage/app/public/transacao_{id}"
            $path = $file->storeAs($folder, $fileName, 'local');
    
            // Cria o arquivo no banco de dados e retorna o modelo
            $arquivo = ArquivosModel::create([
                'transacao_id' => $transacao->id, // Associa o arquivo à transação
                'arquivo' => $path, // Salva o caminho do arquivo
            ]);
    
            // Atualiza o atributo id_arquivo_atual da transação
            $transacao->id_arquivo_atual = $arquivo->id;
            $transacao->save();
        }
    
        return $transacao; // Retorna a transação com o arquivo associado
    }
     
    public function store(Request $request)
    {
        // Chama o método para validação e criação
        $this->validateAndSave($request);
    
        // Redireciona para a página de listagem com uma mensagem de sucesso
        return redirect()->route('painel.index')->with('success', 'Transação cadastrada com sucesso!');
    }
    public function update(Request $request, $id)
    {
        $transacao = TransacoesModel::findOrFail($id);

        // Validação dos dados de entrada
        $data = $request->validate([
            'status_id' => 'required|exists:status_transacoes,id',
            'cpf' => 'required|string|min:14|max:14',
            'valor' => 'required|regex:/^\d{1,3}(\.\d{3})*(,\d{2})?$/',
            'arquivo' => 'nullable|file|mimes:pdf,jpg,png|max:10240',
        ], [
            'status_id.required' => 'O campo status é obrigatório.',
            'status_id.exists' => 'O status selecionado é inválido.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma string.',
            'cpf.min' => 'O campo CPF deve ter 14 caracteres.',
            'cpf.max' => 'O campo CPF deve ter 14 caracteres.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.regex' => 'O campo valor deve ser um valor monetário.',
            'arquivo.file' => 'O campo arquivo deve conter um arquivo.',
            'arquivo.mimes' => 'O arquivo deve estar nos formatos PDF, JPG ou PNG.',
            'arquivo.max' => 'O arquivo deve ter no máximo 10MB.',
        ]);

        // Atualiza os dados principais
        $data['valor'] = (double) str_replace(['.', ','], ['', '.'], $data['valor']);
        $data['criado_por_id'] = Auth::id();

        // Tratamento do upload de arquivo
        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');

            // Cria a pasta no formato "transacao_{id}"
            $folder = "transacao_{$transacao->id}";

            // Define o nome do arquivo
            $fileName = "arquivo_" . time() . '.' . $file->getClientOriginalExtension();

            // Salva o arquivo na pasta "storage/app/private/transacao_{id}"
            $path = $file->storeAs($folder, $fileName, 'local');

            // Verifica se a transação já tem um arquivo associado
            if ($transacao->id_arquivo_atual) {
                // Soft delete no arquivo anterior
                $arquivoAnterior = ArquivosModel::find($transacao->id_arquivo_atual);
                $arquivoAnterior->delete();
            }

            // Cria um novo registro de arquivo
            $arquivo = ArquivosModel::create([
                'transacao_id' => $transacao->id,
                'arquivo' => $path,
            ]);

            // Atualiza o atributo id_arquivo_atual da transação
            $transacao->id_arquivo_atual = $arquivo->id;
        }

        // Atualiza a transação com os novos dados
        $transacao->update($data);

        return redirect()->route('painel.index')->with('success', 'Transação atualizada com sucesso!');
    }

    public function edit($id)
    {
        $statusTransacoes = StatusTransacoesModel::all();
        $transacao = TransacoesModel::findOrFail($id);

        // Retorna a view com os dados, incluindo o usuário
        return view('painel.edit', compact(['transacao', 'statusTransacoes']));
    }

    public function show($id)
    {
        $transacao = TransacoesModel::findOrFail($id);
        // Retorna a view para mostrar todas as informações da licitação
        return view('painel.show', compact('transacao'));
    }
    
    public function destroy($id)
    {
        // Busca a transação pelo ID
        $transacao = TransacoesModel::find($id);

        if (!$transacao) {
            return redirect()->back()->with('error', 'Transação não encontrada.');
        }

        // Realiza o soft delete dos arquivos relacionados
        if ($transacao->arquivos()) {
            $transacao->arquivos()->delete();
        }

        // Realiza o soft delete da transação
        $transacao->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('painel.index')->with('success', 'Transação deletada com sucesso.');
    }

    public function showFile($id)
    {
        $arquivo = ArquivosModel::findOrFail($id);
    
        // Ajuste o caminho do arquivo conforme necessário
        $path = storage_path('app/private/' . $arquivo->arquivo);
    
        // Verifique se o arquivo existe
        if (!file_exists($path)) {
            abort(404); // Se não existir, retorna 404
        }
    
        // Retorne o arquivo
        return response()->file($path);
    }
    
}