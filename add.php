<?php

// formulario para rellenar el nuevo contacto y pasar los datos por POST

$data = file_get_contents("contactos.json");
$contactos = json_decode($data, true);
?>


<html>
  <body>
    <h1> Añadir contacto nuevo : </h1>
    <form action="list.php" method="post">
        <table>
            <tr>
                <td>*Nombre: <input type="text" name="nombre" required></td>
            </tr>
            <tr>
                <td>*Apellido: <input type="text" name="apellido" required></td>
            </tr>
            <tr>
                <td>*Año nacimiento [AAAA]: <input type="number" name="nacimientoAAAA" max="2020" required></td>
            </tr>
            <tr>
                <td>*Telefono 1 - Prefijo: <input type="number" name="prefijo1" max="999" min="1" required></td>
                <td>*Numero: <input type="number" name="telefono1" max="999999999" min="1" required></td>
            </tr>
            <tr>
                <td>Telefono 2  - Prefijo: <input type="number" name="prefijo2" max="999"></td>
                <td>Numero: <input type="number" name="telefono2" max="999999999"></td>
            </tr>
            <tr>
                <td>Telefono 3 - Prefijo: <input type="number" name="prefijo3" max="999"></td>
                <td>Numero: <input type="number" name="telefono3" max="999999999"></td>
            </tr>
            <tr>
                <td>Los campos con * son obligatrios</td>
            </tr>
        </table>
        <input type="submit" value="Añadir">
    </form>
    <a href="./list.php">
        <button type="button">Cancelar</button>
    </a>
  </body>
</html>

