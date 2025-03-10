<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        @page { size: 7.31cm 5cm portrait; }
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
    </style>
</head>
<body>
<div class="stamp-container">
    <div class="section-content">
        <p><strong>Reparación Nº: </strong> {{$data->code}}</p>
        <p><strong>Cliente: </strong> {{$data->customer->name}}</p>
        <p><strong>Teléfono: </strong> {{$data->customer->name}}</p>
        <p><strong>Marca:</strong> {{$data->brand->brand}}</p>
        <p><strong>Pin:</strong> {{$data->pin}}</p>
        <p><strong>Falla:</strong> {{$data->failure}}</p>
        <p><strong>Detalle reparación:</strong> {{$data->diagnosis}} </p>
    </div>
</div>
</body>
</html>
