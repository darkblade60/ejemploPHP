<?php

//Recojo NOMBRE Y APELLIDO (he tratado nombre y apellido como clave, en un entorno real debería fijarse una clave en la BD para evitar duplicidades)

$data = file_get_contents("contactos.json");
$contactos = json_decode($data, true);
$vNombre = $_GET['nombre'];
$vApellido = $_GET['apellido'];
$ntelf = 0;
?>

<html>
    <body>
    <h1>Detalles de <?php echo($vNombre); ?> </h1>
 
    <?php
    //Recorremos los contactos del array
    foreach ($contactos as $contacto) {
        if ($contacto['nombre'] == $vNombre && $contacto['apellido'] == $vApellido){
        
    ?>
    <table border="1">
        <tr>
            <td>Nombre: </td>
            <td>
            <?php echo($contacto["nombre"]); ?> 
            </td>   
        </tr>
        <tr>
            <td>Apellidos: </td>
            <td>
            <?php echo($contacto["apellido"]); ?> 
            </td>
        </tr>
        <tr>
            <td>Año nacimiento: </td>
            <td>
            <?php echo($contacto["nacimientoAAAA"]); ?> 
            </td>
        </tr>
        <tr>
        <?php
            // Recorremos los telefonos dentro de cada contacto
            foreach ($contacto['telefono'] as $telefonos) { 
                $ntelf++       
            ?>         
            <td>Telefono <?php echo($ntelf); ?> : </td>
            <td>
                <?php echo($telefonos["prefijo"]); ?> 
            </td>
            <td>
                <?php echo($telefonos["numero"]); ?> 
            </td>
        </tr>
            <?php } ?>
    </table>
<?php 
    }
 } //cerramos foreach
 
?>

<a href="./list.php">
    <button type="button">Volver al listado</button>
</a>
    </body>
</html>