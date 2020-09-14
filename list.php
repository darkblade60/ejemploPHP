<?php


/*
Inicialmente compruebo si he recibido algo por post (desde la pagina add), he dado por supuesto que el máximo de telefonos es 3, aunque podría hacer de forma ilimitada dinamicamente.
Se podría iniciar sin datos en el JSON aunque he añadido dos registros de ejemplo
*/

$post1 =(isset($_POST['nombre']) && !empty($_POST['nombre'])) &&
        (isset($_POST['apellido']) && !empty($_POST['apellido'])) &&
        (isset($_POST['nacimientoAAAA']) && !empty($_POST['nacimientoAAAA'])) &&
        (isset($_POST['prefijo1']) && !empty($_POST['prefijo1'])) &&
        (isset($_POST['telefono1']) && !empty($_POST['telefono1']));

$post2 =(isset($_POST['prefijo2']) && !empty($_POST['prefijo2'])) &&
        (isset($_POST['telefono2']) && !empty($_POST['telefono2']));

$post3 =(isset($_POST['prefijo3']) && !empty($_POST['prefijo3'])) &&
        (isset($_POST['telefono3']) && !empty($_POST['telefono3']));
        


// Compruebo los 3 telefonos para crear el array correcto, dependiendo de los datos que se pronvengan de "add"

if ($post1 && !$post2 && !$post3) {      
    echo ('wtf1');
    $vNombre = $_POST['nombre'];
    $vApellido = $_POST['apellido'];
    $vNacimiento = $_POST['nacimientoAAAA'];
    $vPrefijo1 = $_POST['prefijo1'];
    $vTelefojo1 = $_POST['telefono1'];

    $nuevoContacto = array ('nombre' => $_POST['nombre'],
                        'apellido' => $_POST['apellido'],
                        'nacimientoAAAA' => $_POST['nacimientoAAAA'],
                        'telefono' =>   array (['prefijo' => $_POST['prefijo1'],
                                               'numero'  => $_POST['telefono1']]                       
                                        )
                    );     

}

    elseif ($post2 && ! $post3)  {
        echo ('wtf2');
        $vPrefijo2 = $_POST['prefijo2'];
        $vTelefojo2 = $_POST['telefono2'];

        $nuevoContacto = array ('nombre' => $_POST['nombre'],
                                'apellido' => $_POST['apellido'],
                                'nacimientoAAAA' => $_POST['nacimientoAAAA'],
                                'telefono' =>   array (['prefijo' => $_POST['prefijo1'],
                                                        'numero'  => $_POST['telefono1']],
                                                       ['prefijo' => $_POST['prefijo2'],
                                                        'numero'  => $_POST['telefono2']]                       
                                                )
                        ); 

    }

        elseif ($post3) {
            echo ('wtf3');
            $vPrefijo3 = $_POST['prefijo3'];
            $vTelefojo3 = $_POST['telefono3']; 

            $nuevoContacto = array ('nombre' => $_POST['nombre'],
                                    'apellido' => $_POST['apellido'],
                                    'nacimientoAAAA' => $_POST['nacimientoAAAA'],
                                    'telefono' =>   array (['prefijo' => $_POST['prefijo1'],
                                                            'numero'  => $_POST['telefono1']],
                                                           ['prefijo' => $_POST['prefijo2'],
                                                            'numero'  => $_POST['telefono2']], 
                                                           ['prefijo' => $_POST['prefijo3'],
                                                            'numero'  => $_POST['telefono3']]                       
                                                        )
                            );
        }


//Lectura de JSON

$data = file_get_contents("contactos.json");
$contactos = json_decode($data, true);

// Si he recibido por post un nuevo contacto, lo añado al JSON, además lo escribo en el JSON para hacerlo persistente
// Si el array esta vacio (JSON VACIO) se inicaliza.
if ($post1){
    if ($contactos != null){
        array_push ( $contactos , $nuevoContacto);
    }
    else {
        $contactos = array ($nuevoContacto);
    }
    $jsonData = json_encode($contactos);
    file_put_contents("contactos.json", $jsonData); 
}

?>

<html>
    <body>
    <h1>Tus contactos</h1>
    
    <?php
    //Recorremos los contactos del array y envio por GET los datos a "detail" para mostrar más información
    if ($contactos != null){
        foreach ($contactos as $contacto) {
    ?>
    <table border="1">
        <tr>
            <td>Nombre: </td>
            <td>
                <?php echo($contacto['nombre']); ?> 
            </td>
            <td>
                
                <a href="./detail.php?nombre=<?php echo($contacto['nombre'])?>&apellido=<?php echo($contacto['apellido'])?>">
                    <button type="button">Ver</button>
                </a>
            </td>
        </tr>
    </table>
    <?php 
        }
    } 
    ?>
    
    <a href="./add.php">
        <button type="button">Añadir contacto</button>
    </a>
    </body>
</html>