<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <style>
        /* Estilo general de la página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        /* Contenedor principal */
        .main-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Fila de elementos con espaciado reducido */
        .row-spacing {
            margin-bottom: -17px; /* Reducido el espacio entre filas */
        }

        /* Estilo para la cabecera de la orden */
        .order-header {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1px 15px 1px 15px;
            font-size: 20px;
            margin-bottom: 10px; /* Reducido el margen inferior */
            border-radius: 4px;
        }

        /* Estilo para textos centrados */
        .text-center-custom {
            text-align: center;
            font-size: 16px;
        }

        /* Fondo gris claro para el pie de página */
        .footer-box {
            background-color: #f1f1f1;
            text-align: center;
            padding: 8px; /* Reducido el padding */
            margin-top: 15px;
            border-radius: 4px;
        }

        /* Estilo de las celdas de la tabla */
        .info-table {
            font-size: 14px;
        }

        .info-table .col-label {
            font-weight: bold;
        }

        /* Estilo para los botones */
        .button-custom {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .button-custom:hover {
            background-color: #0056b3;
        }

        /* Estilo para la caja de QR */
        .qr-box {
            background-color: #343a40;
            color: white;
            padding: 15px; /* Reducido el padding */
            text-align: center;
            font-size: 16px;
            margin-top: 15px;
            border-radius: 4px;
        }

        /* Estilo de las filas de la tabla */
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0; /* Reducido el padding */
        }

        .info-row .label {
            font-weight: bold;
        }

        /* Estilo para las columnas */
        .col {
            flex: 1; /* Aumentado el valor de flex para mayor espacio en los valores */
            text-align: left; /* Alineación izquierda para los valores */
        }

        /* Estilo para la fila de fecha y hora */
        .date-time-row {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .date-time-row .label {
            width: 80px; /* Establecer un ancho fijo para las etiquetas de fecha y hora */
        }
        .time{
            margin-left:10px;
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="row-spacing">
        <div class="text-center-custom">
            <h4>Luis Figueroa 88 Local 2</h4>
        </div>
    </div>
    <div class="row-spacing">
        <div class="text-center-custom">
            <p><strong>Tel:</strong> 323 235 3707</p>
        </div>
    </div>
    <div class="row-spacing">
        <div class="text-center-custom">
            <p><strong>WhatsApp:</strong> 323 131 8462</p>
        </div>
    </div>
    <div class="row-spacing">
        <div class="text-center-custom">
            <p><strong>Horario:</strong> Lunes a Viernes, 9:00 am - 2:00 pm y 4:00 pm - 7:00 pm</p>
        </div>
    </div>
    <div class="row-spacing">
        <div class="text-center-custom">
            <p><strong>Sábado:</strong> 9:00 am - 2:00 pm</p>
        </div>
    </div>
    <div class="order-header">
        <h5>ORDEN Nº 005942</h5>
    </div>
    <div class="info-table">
        <!-- Fila de Fecha y Hora en la misma línea -->
        <div class="info-row date-time-row">
            <span><strong> FECHA: </strong></span><span>{{$data->created_at}}</span>  | 
            <span class="time"><strong> HORA: </strong></span><span>{{$data->created_at}}</span>
        </div>
        <div class="info-row">
            <span><strong>CLIENTE: </strong> </span><span>{{$data->customer->name}}</span>
        </div>
        <div class="info-row">
            <span><strong>TECNICO RESPONSABLE: </strong> </span><span>{{$data->user->name}}</span>
        </div>
        
    </div>
    <div class="qr-box">
        <h6>Consulta QR Reparación</h6>
    </div>
    <div class="order-header">
        <h5>Datos del equipo</h5>
    </div>
    <div class="info-table">
        <div class="info-row">
            <span><strong>IMEI: </strong> </span><span>xxx</span>
        </div>
        <div class="info-row">
            <span><strong>MARCA: </strong> </span><span>{{$data->brand->brand}}</span>
        </div>
        <div class="info-row">
            <span><strong>MODELO: </strong> </span><span>{{$data->brand->brand}}</span>
        </div>
        <div class="info-row">
            <span><strong>ENCIENDE: </strong> </span><span>{{$data->brand->brand}}</span>
            <span><strong>GOLPES: </strong> </span><span>{{$data->brand->brand}}</span>
        </div>
        <div class="info-row">
            <span><strong>TÁCTIL: </strong> </span><span>PUERTO: </span><span>{{$data->brand->brand}}</span>
        </div>
        <div class="info-row">
            <span><strong>TIPO EQUIPO: </strong></span><span>xx</span>
        </div>
        <div class="info-row">
            <span><strong>PIN: </strong></span><span>xx</span>
        </div>
    </div>
    <div class="order-header">
        <h5>Reporte Técnico</h5>
    </div>
    <div class="info-row">
        <span><strong>FALLA: </strong></span><span>xx</span>
    </div>
    <div class="info-row">
        <span><strong>DETALLE REPARACIÓN: </strong></span><span>xx</span>
    </div>
    <div class="order-header">
        <h5>Costo Reparación</h5>
    </div>
    <div class="order-header">
        <h5>* Políticas de garantía *</h5>
    </div>
    <div class="info-row">
        <span><strong> * No nos hacemos responsables por memorias o
        tarjetas sim dejadas en su equipo. </strong></span>
    </div>
    <div class="info-row">
        <span><strong> * La fecha de entrega es condicional. Puede variar
        según disponibilidad de repuesto. </strong></span>
    </div>
    <div class="info-row">
        <span><strong> * Contará con un plazo de 30 días para recoger el
        equipo una vez haya sido notificado de que el mismo
        está listo. Transcurrido el lapso establecido el equipo
        pasará a ser propiedad de la empresa. </strong></span>
    </div>
    <div class="info-row">
        <span><strong> * Para cualquier consulta es imprescindible citar el
        No. De folio de reparación indicado en esta hoja.</strong></span>
    </div>
    <div class="info-row">
        <span><strong> * En toda reparación de software, desbloqueos,
            liberaciones el equipo tiene riesgo de quedar
            inservible y si esto ocurriera no será responsabilidad
            del taller.
            </strong></span>
    </div>
    <div class="info-row">
        <span><strong> * La garantía de reparación únicamente será válida
cuando se presente la misma falla aquí descrita y no
haya sido abierto el equipo.
            </strong></span>
    </div>
    <div class="info-row">
        <span><strong> * Los equipos de software, mojados y/o húmedos no
        tienen garantía alguna.
            </strong></span>
    </div>
    <div class="info-row">
        <span><strong>* Tiempo de garantía: puede variar de acuerdo a la
        pieza. Válido únicamente presentando ticket. 
            </strong></span>
    </div>
    <div class="order-header">
        <h5>* Firma conformidad *</h5>
    </div>
    <div class="info-row">
        <span><strong>He leído las clausulas del
servicio y acepto:

            </strong></span>
            <span><strong>________________________________
            </strong></span>
    </div>
    <div class="info-row">
        <span>*** ESTIMADO CLIENTE CONSERVE SU TICKET ***
        </span>
    </div>
</div>

</body>
</html>
