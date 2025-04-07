<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        @page { size: 7.15cm 3.42cm landscape; }
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #FFFFFF;
            font-size: 7px;
            padding: 10px;
        }

        .stamp-container {
            padding: 0 10px 0 10px;
        }

        .section-content {
            margin-bottom: 4px;
        }

        .section-content p {
            font-size: 6px;
        }
        table {
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }
        #no-reparacion{
            font-size: 10px;
        }
    </style>
</head>
<body>
<table border="1">
    <tr>
        <td><img src="{{ public_path('/consume-ticket-logo.png') }}" height="15"></td>
        <td><p><strong>Reparación Nº: </strong><span id="no-reparacion"> {{$data->id}}</span></p></td>
    </tr>
    <tr>
        <td colspan="2">
            <p><strong>Cliente: </strong> {{$data->customer->name}}</p>
            <p><strong>Teléfono: </strong> {{$data->customer->telephone}}</p>
            <p><strong>Marca:</strong> {{$data->brand->brand}}</p>
            <p><strong>Modelo:</strong> {{$data->model->model}}</p>
            <p><strong>PIN:</strong> {{$data->password}}</p>
            <p><strong>Falla:</strong> {{$data->failure}}</p>
        </td>
    </tr>
</table>
</body>
</html>
