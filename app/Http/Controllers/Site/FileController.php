<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Exibe o formulário de upload.
     */
    public function showUploadForm()
    {
        return view('merged.upload');
    }

    /**
     * Processa o upload dos arquivos e os unifica.
     */
    public function mergeFiles(Request $request)
    {
        // Valida se os arquivos foram enviados e se são do tipo .xlsx ou .csv
        $request->validate([
            'files.*' => 'required|mimes:xlsx,csv'
        ]);

        // Se nenhum arquivo foi enviado, redireciona de volta com erro
        if (!$request->hasFile('files')) {
            return back()->with('error', 'Nenhum arquivo enviado.');
        }

        // Array para armazenar os dados de todos os arquivos
        $mergedData = [];
        $header = null; // Para armazenar o cabeçalho das colunas

        // Processa cada arquivo enviado
        foreach ($request->file('files') as $file) {
            // Lê os dados do arquivo
            $data = Excel::toCollection(null, $file);

            // O Excel::toCollection retorna uma coleção, então pegamos o primeiro item que é a nossa planilha
            if ($data->isNotEmpty() && $data->first()->isNotEmpty()) {
                $sheetData = $data->first();

                // Se for o primeiro arquivo, salvamos o cabeçalho
                if ($header === null) {
                    $header = $sheetData->first();
                    // Adiciona o cabeçalho aos dados unificados
                    $mergedData[] = $header->toArray();
                }

                // Pula a primeira linha (cabeçalho) e adiciona o resto dos dados
                foreach ($sheetData->slice(1) as $row) {
                    $mergedData[] = $row->toArray();
                }
            }
        }

        // Verifica se há dados para exibir
        if (empty($mergedData)) {
            return back()->with('error', 'Não foi possível ler os dados dos arquivos.');
        }

        // Armazena os dados na sessão para o download
        $request->session()->put('merged_data', $mergedData);

        // Retorna a view com os dados unificados e o cabeçalho
        return view('merged.merged', [
            'mergedData' => $mergedData,
            'header' => $header ? $header->toArray() : []
        ]);
    }

    /**
     * Faz o download do arquivo unificado.
     */
    public function downloadMergedFile(Request $request)
    {
        // Pega os dados da sessão
        $dataToDownload = session('merged_data');

        // Se não houver dados, retorna com erro
        if (!$dataToDownload) {
            return back()->with('error', 'Nenhum dado para baixar.');
        }

        // Cria um novo arquivo Excel com os dados unificados
        return Excel::download(new \App\Exports\MergedExport($dataToDownload), 'arquivos_unificados.xlsx');
    }

}
