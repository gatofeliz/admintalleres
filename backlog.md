# Backlog

## A realizar

- Instalar filament lint
- Cambiar etiquetas
- Cambiar página de inicio

## Realizadas

- Crear un seeder para tener ejemplo real de ticket en la base de datos
    + Crear factories para los modelos
- Arreglar iframe Vista previa de impresión
- Establecer el tamaño de la hoja para el ticket

1 inch = 72 point
1 inch = 2.54 cm
7.31cm = 7.31/2.54*72 = 207.2125984252
29.71cm = 29.71/2.54*72 = 842.1732283465

- Se decidío seguir usando HTML/CSS para el ticket ya que es más sencillo
- Se maquetó el ticket siguiendo el ejemplo
- Se instaló simplesoftwareio/simple-qrcode
- Se creo el qr code sin la ruta de estatus porque aún no existe
- Se necesita el módulo imagemagick
- Se construyo el documento de la orden de servicio
- Se creo la ruta para el estatus de la orden de servicio
- Se agregó el campo estatus y la funcionalidad para actualizarlo directo en la lista de servicios
- Se mejoraron los estilos del PDF del documento
- Se instaló spatie para manejar roles y permisos
