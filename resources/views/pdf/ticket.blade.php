<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        @page { size: 7.31cm 29.71cm portrait; }
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

        .ticket-container {
            padding: 0 10px 0 10px;
        }

        .contact {
            text-align: center;
        }
        
        .section {
            background-color: #000000;
            text-align: center;
            color: white;
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 13px;
        }

        .section-content {
            margin-bottom: 4px;
        }

        .section-content p {
            font-size: 10px;
        }

        .section-content:after {
            content: "";
            display: table;
            clear: both;
        }

        .section-content .section-col {
            float: left;
            width: 50%;
        }

        .section-col div {
            text-align: center;
        }

        #qr {
            text-align: center;
        }

        #order {
            font-size: 17px;
        }

        #status {
            text-align: center;
        }

        #payment {
            text-align: right;
        }

        #warranty p {
            text-align: justify;
            font-weight: bold;
        }

        #terms p {
            text-align: center;
        }
        
        #read {
            margin-bottom: 40px;
        }

        .logo {
            text-align: center;
        }
        
        #last-message p {
            margin-top: 5px;
            font-size: 8px;
            font-weight: bold;
            text-align: center;
        }
        .stronger {
            font-weight: bold;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="ticket-container">
    <div class="logo">
        <img src="{{ public_path('/consume-ticket-logo.png') }}" height="50">
    </div>
    <div class="contact">
        <p>Luis Figueroa 88 Local 2</p>
        <p class="stronger">Tel: 323 235 3707</p>
        <p class="stronger">WhatsApp: 323 131 8462</p>
        <p>Lunes a Viernes</p>
        <p>9:00 am - 2:00 pm y 4:00 pm - 7:00 pm</p>
        <p><strong>Sábado:</strong> 9:00 am - 2:00 pm</p>
    </div>
    <div id="order" class="section">
        <p>ORDEN Nº {{ $data->code }}</p>
    </div>
    <div class="section-content">
        <p><strong>FECHA:</strong> {{$data->created_at->format('d-m-Y')}} | <strong>HORA:</strong> {{$data->created_at->format('h:i:s A')}}</p>
        <p><strong>CLIENTE: </strong> {{$data->customer->name}}</p>
        <p><strong>TECNICO RESPONSABLE:</strong> {{$data->tech}}</p>
    </div>
    <div class="section">
        <p>Consulta QR Reparación</p>
    </div>
    <div id="qr" class="section-content">
        <img src="{{ $qrPath }}" height="100">
    </div>
    <div id="status" class="section-content">
        <p>Escanee con el móvil para consultar status de la reparación</p>
    </div>
    <div class="section">
        <p>Datos del equipo</p>
    </div>
    <div class="section-content">
        <div class="section-col">
            <p><strong>IMEI:</strong> {{$data->imei}}</p>
            <p><strong>MARCA:</strong> {{$data->brand->brand}}</p>
            <p><strong>MODELO:</strong> {{$data->model->model}}</p>
            <p><strong>ENCIENDE:</strong> {{$data->turn_on}}</p>
            <p><strong>GOLPES:</strong> {{$data->blows}}</p>
            <p><strong>TÁCTIL:</strong> {{$data->tactile}}</p>
            <p><strong>PUERTO:</strong> {{$data->cargo_port}}</p>
            <p><strong>TIPO EQUIPO:</strong>{{$data->typeEquipment->type_of_equipment}}</p>
            <p><strong>PIN:</strong>{{$data->password}}</p>
        </div>
        <div class="section-col">
            <div>
                <img src="{{ public_path('./patron.png') }}" height="50">
            </div>
        </div>
    </div>
    <div class="section">
        <p>Reporte Técnico</p>
    </div>
    <div class="section-content">
        <p><strong>FALLA:</strong> {{$data->failure}}</p>
        <p><strong>DETALLE REPARACIÓN:</strong> {{$data->diagnosis}} </p>
    </div>
    <div class="section">
        <p>Costo Reparación</p>
    </div>
    <div id="payment" class="section-content">
        <p><strong>TOTAL REPARACIÓN: $</strong> {{$data->budget}}</p>
        <p><strong>REFACCIÓN: $</strong> {{$data->repair}}</p>
        <p><strong>ABONO: $</strong> {{$data->advance}}</p>
        <p><strong>PENDIENTE DE PAGO: $</strong> {{$data->budget - $data->advance}}</p>
    </div>
    <div class="section">
        <p>* Políticas de garantía *</p>
    </div>
    <div id="warranty" class="section-content">
        <p> * No nos hacemos responsables por memorias o tarjetas sim dejadas en su equipo.</p>
        <p> * La fecha de entrega es condicional. Puede variar según disponibilidad de repuesto.</p>
        <p> * Contará con un plazo de 30 días para recoger el equipo una vez haya sido notificado de que el mismo está listo. Transcurrido el lapso establecido el equipo pasará a ser propiedad de la empresa.</p>
        <p> * Para cualquier consulta es imprescindible citar el No. De folio de reparación indicado en esta hoja.</p>
        <p> * En toda reparación de software, desbloqueos, liberaciones el equipo tiene riesgo de quedar inservible y si esto ocurriera no será responsabilidad del taller.</p>
        <p> * La garantía de reparación únicamente será válida cuando se presente la misma falla aquí descrita y no haya sido abierto el equipo.</p>
        <p> * Los equipos de software, mojados y/o húmedos no tienen garantía alguna.</p>
        <p>* Tiempo de garantía: puede variar de acuerdo a la pieza. Válido únicamente presentando ticket.</p>
    </div>
    <div class="section">
        <p>Firma Conformidad</p>
    </div>
    <div id="terms" class="section-content">
        <p id="read">He leído las clausulas del servicio y acepto:</p>
        <p>________________________________</p>
        <p>Firma Cliente</p>
    </div>
    <div class="section-content">
    </div>
    <div id="last-message" class="section-content">
        <p>*** ESTIMADO CLIENTE CONSERVE SU TICKET ***</p>
    </div>
</div>
</body>
</html>
