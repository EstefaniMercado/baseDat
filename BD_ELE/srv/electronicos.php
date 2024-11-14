<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ELECTRONICO.php";

ejecutaServicio(function () {
    $lista = select(pdo: Bd::pdo(), from: ELECTRONICO, orderBy: ELE_NOMBRE);
    
    // Inicia la lista de descripción con un fondo azul claro
    $render = "<dl class='row p-4 rounded shadow-sm' style='background-color: #e3f2fd;'>";

    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[ELE_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[ELE_NOMBRE]);
        $color = htmlentities($modelo[ELE_COLOR]);
        $tamaño = htmlentities($modelo[ELE_TAMAÑO]);
        
        $render .= "
            <div class='col-12'>
                <dt class='font-weight-bold text-primary'>
                    <a href='modifica.html?id=$id' class='text-decoration-none'>$nombre</a>
                </dt>
                <dd class='text-muted'>
                    <a href='modifica.html?id=$id' class='text-dark text-decoration-none'>$color, $tamaño</a>
                </dd>
            </div>
            <button class='btn-mobile-app col-12 my-2' disabled></button>";
    }

    $render .= "</dl>";
    
    devuelveJson(["tabla" => ["innerHTML" => $render]]);
});
?>
