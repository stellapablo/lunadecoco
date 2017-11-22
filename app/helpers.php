<?php

function currentUser()
{
    return auth()->user();
}


function getEstado($id)
{


    $estado = \App\Estado::find($id)->nombre;

    switch ($id) {
        case 1:
            echo '<span class="label label-success label-rounded"> ' . $estado .'</span>';

            break;
        case 2:
            echo '<span class="label label-info label-rounded"> ' . $estado .'</span>';

            break;
        case 3:
            echo '<span class="label label-danger label-rounded"> ' . $estado .'</span>';

            break;
    }

}

//convierte las fechas dd/mm/aaaa en aaaa-mm-dd

function fechaAmd($dma) {

    return substr($dma, 6, 4) . "-" . substr($dma, 3, 2) . "-" . substr($dma, 0, 2);

}

function fechaAmdInv($dma) {
    if (trim($dma) != '') {
        return date("d/m/Y", strtotime($dma));
    } else {
        return '';
    }
}