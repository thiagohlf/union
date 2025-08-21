<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Unificados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .buttons {
            text-align: center;
            margin-bottom: 20px;
        }
        .buttons a, .buttons button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 5px;
            border: none;
            cursor: pointer;
        }
        .buttons a:hover, .buttons button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
        .error {
            color: #dc3545;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dados Unificados</h1>

        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($mergedData) && count($mergedData) > 1)
            <div class="buttons">
                <a href="{{ route('download') }}">Baixar Arquivo Unificado</a>
                <a href="{{ route('upload.form') }}" style="background-color: #6c757d;">Novo Upload</a>
            </div>

            <table>
                <thead>
                    <tr>
                        @foreach ($header as $heading)
                            <th>{{ $heading }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_slice($mergedData, 1) as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="message">Nenhum dado para exibir. Por favor, envie os arquivos.</p>
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('upload.form') }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Voltar para o Upload</a>
            </div>
        @endif
    </div>
</body>
</html>