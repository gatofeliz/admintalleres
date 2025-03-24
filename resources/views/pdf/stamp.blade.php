<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        @page { size: 9.15cm 5.42cm landscape; }
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFFFFF;
            font-size: 11px;
            padding: 10px;
        }

        .stamp-container {
            padding: 0 10px 0 10px;
        }

        .section-content {
            margin-bottom: 4px;
        }

        .section-content p {
            font-size: 10px;
        }
        table {
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }
    </style>
</head>
<body>
<table border="1">
    <tr>
        <td><img src="{{ public_path('/consume-ticket-logo.png') }}" height="30"></td>
        <td><p><strong>Reparación Nº: </strong> {{$data->code}}</p></td>
    </tr>
    <tr>
        <td colspan="2">
            <p><strong>Cliente: </strong> {{$data->customer->name}}</p>
            <p><strong>Teléfono: </strong> {{$data->customer->telephone}}</p>
            <p><strong>Marca:</strong> {{$data->brand->brand}}  {{$data->model->model}}  |  PIN: 
            {{$data->password}}</p>
            <p><strong>Falla:</strong> {{$data->failure}}</p>
            <p><strong>Detalle reparación:</strong> {{$data->diagnosis}} </p>
        </td>
    </tr>
</table>
</body>
</html>
