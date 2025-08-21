<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unificador de Arquivos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 500px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="file"] {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #dc3545;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Unificador de Arquivos</h1>
        <p>Selecione os arquivos .xlsx e .csv que deseja unificar.</p>

        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('merge') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="files[]" multiple required>
            <button type="submit">Unificar Arquivos</button>
        </form>
    </div>
</body>
</html>