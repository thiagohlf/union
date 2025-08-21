<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MergedExport implements FromArray, WithHeadings
{
    protected $data;
    protected $header;

    public function __construct(array $data)
    {
        // O primeiro item do array de dados é o cabeçalho
        $this->header = $data[0] ?? [];
        // Os dados restantes são as linhas do conteúdo
        $this->data = array_slice($data, 1);
    }

    /**
     * Retorna os dados que serão exportados para a planilha.
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * Retorna os cabeçalhos das colunas.
     */
    public function headings(): array
    {
        return $this->header;
    }
}