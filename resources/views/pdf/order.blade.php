<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
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

        .order-container {
            padding: 10px;
            text-align: center;
        }

        #order-body {
            margin-top: 40px;
        }

        #order-header .column {
            float: left;
            width: 33%;
        }

        #order-status .column {
            text-align: center;
            display:block;
            float: left;
            width: 50%;
            border: 1px solid black;
            height: 130px;
            padding-top: 30px;
        }

        .status-box {
            display: "table-cell";
            vertical-align: middle;
            height: 120px;
        }

        .clear {
            clear: left;
        }

        #order-body {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 5px;
        }

        table th {
            background-color: rgb(204, 204, 204);
        }

        #order-payment {
            margin-bottom: 10px;
        }

        #order-terms {
            margin-bottom: 40px;
        }

        #order-payment p {
            text-align: right;
        }

        #sign {
            margin-bottom: 30px;
        }

        .eye-pick {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="order-container">
    <div id="order-header">
        <div class="column" id="logo">
            <img src="{{ public_path('/consume-ticket-logo.png') }}" height="50">
        </div>
        <div class="column" id="contact">
            <p><strong>CONSUME</strong></p>
            <p>Luis Figueroa 88 Local 2</p>
            <p>Tel: 323 235 3707</p>
            <p>WhatsApp: 323 131 8462</p>
            <p>Lunes a Viernes</p>
            <p>9:00 am - 2:00 pm y 4:00 pm - 7:00 pm</p>
            <p>Sábado: 9:00 am - 2:00 pm</p>
        </div>
        <div class="column" id="order-id">
            <p class="eye-pick">ORDEN Nº <br> {{ $data->code }}</p><br />
            <p>FECHA: {{$data->created_at->format('d-m-Y')}}</p>
            <p>HORA: {{$data->created_at->format('h:i:s')}}</p>
        </div>
    </div>
    <div class="clear"></div>
    <div id="order-body">
        <table>
            <tr>
                <th>Cliente</th>
                <th>Técnico / Responsable</th>
            </tr>
            <tr>
                <td>
                    Nombre: {{ $data->customer->name}}<br />
                    Teléfono: {{$data->customer->telephone}}
                </td>
                <td>Nombre: {{$data->tech}}</td>
            </tr>
            <tr>
                <th colspan="2">Datos del Equipo</th>
            </tr>
            <tr>
                <td>
                    Equipo: {{ $data->customer->name}}<br />
                    Marca: {{$data->customer->telephone}}<br />
                    PIN: MISSING<br />
                    Enciende: {{$data->turn_on}}<br />
                    Golpes: {{$data->blows}}<br />
                    Batería: {{$data->cargo_port}}
                </td>
                <td>
                    Modelo: {{$data->model->model}}<br />
                    Serie: MISSING<br />
                    Estado: MISSING
                </td>
            </tr>
            <tr>
                <th colspan="2">Diagnóstico del Equipo</th>
            </tr>
            <tr>
                <td colspan="2">
                    Descripción Falla: {{$data->failure}}<br />
                    Descripción reparación: {{$data->diagnosis}}
                </td>
            </tr>
            <tr>
                <th colspan="2">Refacción utilizada en la reparación</th>
            </tr>
            <tr>
                <td colspan="2">-- Cantidad:</td>
            </tr>
        </table>
    </div>
    <div id="order-payment">
        <p><strong>Costo Reparación:</strong> ${{$data->budget}}</p>
        <p><strong>Repuesto:</strong> ${{$data->repair}}</p>
        <p><strong>Abono:</strong> ${{$data->advance}}</p>
        <p><strong>Total a pagar:</strong> ${{$data->total}}</p>
    </div>
    <div id="order-terms">
        <table>
            <tr>
                <th>TERMINOS Y CONDICIONES</th>
            </tr>
            <tr>
                <td>
                1.- Después de 30 días de cualquier reparación no nos hacemos responsables de los equipos.<br />
                2.- No se responde por daños ocasionados por alto voltaje, golpes, humedad y otras causas de un mal manejo del equipo.<br />
                3.- El departamento técnico no se hace responsable por la perdida de información o datos, para tal fin el usuario debe realizar sus propias copias de seguridad.<br />
                4.- No se responde por un sim card y memorias dejadas en los equipos.<br />
                5.- En la reparación del equipo descrito en ésta nota acepto que tiene riesgo de ya no encender o de algún otro daño en alguno de sus componentes, razón por la cual estoy de acuerdo en que se realice y deslindo de cualquier responsabilidad civil, mercantil o judicial a CONSUME y/o cualquier personal de dicha empresa por el daño permanente en el equipo y no realizará ninguna acción legal en su contra.<br />
                6.- No hay garantía en equipos mojados.<br />
                </td>
            </tr>
            <tr>
                <th>Al firmar usted acepta las clausulas especificadas por nuestra empresa</th>
            </tr>
        </table>
    </div>

    <div id="sign"">
        <p>________________________________</p>
        <p>Firma Cliente</p>
    </div>
    <div id="order-status">
        <div class="column">
            <div class="status-box">
                <p>Para consultar el estado de su reparación escanee el codigo QR con su móvil y sera redireccionado a la página donde podrá ver los datos de su orden de servicio.</p>
            </div>
        </div>
        <div class="column">
            <div class="status-box">
                <img src="{{ $qrPath }}" height="100">
            </div>
        </div>
    </div>
</div>
</body>
