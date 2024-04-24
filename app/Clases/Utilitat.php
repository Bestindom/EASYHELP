<?php

namespace App\Clases;

class Utilitat
{
    public static function errorMessage ($e)
    {
        if (!empty($e->errorInfo[1]))
        {
            switch ($e->errorInfo[1])
            {
                case 1062:
                    $message = 'Dades Duplicades';
                    break;
                case 1451:
                    $message = 'Dades amb elements relacionats';
                    break;
                case 1048:
                    $message = 'Aquest número ja existeix ';
                    break;
                default:
                    $message = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                    break;
            }
        }
        else
        {
            switch ($e->getCode())
            {
                case 1044:
                    $message = "Usuari o Contrasenya incorrectes";
                    break;
                case 1049:
                    $message = "Base de dades desconeguda";
                    break;
                case 2002:
                    $message = "Server not found";
                    break;
                default:
                    $message = $e->getCode() . ' - ' . $e->getMessage();
                    break;
            }
        }

        return $message;
    }
}