<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\DemoEmail;
use App\Mail\AcceptMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($email, $usuario, $reciver, $unidad, $materia, $tema)
    {
        $objDemo = new \stdClass();
        $objDemo->unidad = $unidad;
        $objDemo->materia = $materia;
        $objDemo->tema = $tema;
        $objDemo->sender = $usuario;
        $objDemo->receiver = $reciver;
 
        Mail::to($email)->send(new DemoEmail($objDemo));
    }

    public function sendAceptada($email, $usuario, $reciver, $unidad, $materia, $tema)
    {
        $objDemo = new \stdClass();
        $objDemo->unidad = $unidad;
        $objDemo->materia = $materia;
        $objDemo->tema = $tema;
        $objDemo->sender = $usuario;
        $objDemo->receiver = $reciver;
 
        Mail::to($email)->send(new AcceptMail($objDemo));
    }
}
