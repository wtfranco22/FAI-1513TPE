<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ConversacionDescarga extends Conversation
{
    protected $busqueda;

    /**
     * 'ejecuta' de manera automatica la clase y llama de inmediato a la funcion charla
     */
    public function run()
    {
        $this->ask('Mostrame el link de Acceso para el archivo', function ($answer) {
            $busqueda['aclinkacceso'] =  $answer->getText();
            $this->ask('Ingrese Clave',function($answer){
                $busqueda['acprotegidoclave'] = $answer->getText();
            });
            $archivo = new AbmArchivoCargado();
            $arreglo = $archivo->buscarArchivo($busqueda);
            if (($objAC = $arreglo[0]) != null) {
                if (file_exists('../vista/contenido/compartidos/' . $objAC->getAcNombre())) {
                    $this->say("Nombre: " . $objAC->getAcNombre() . "
            <br><a href='../vista/contenido/compartidos/" . $objAC->getAcNombre() . "' download='" . $objAC->getAcNombre() . "'>Descargar archivo</a>");
                } else {
                    $this->say('Ups! no esta disponible para compartir');
                }
            }else{
                $this->say('No se encuentra en la BD');
            }
        });
    }

    public function pedirContra()
    {
        $pregunta = Question::create('Tiene contraseña?')
            ->addButtons([ //preguntamos por la seguridad
                Button::create('SI')->value(1),
                Button::create('NO')->value(0)
            ]);
        $this->ask($pregunta, function ($answer) {
            if ($answer->isInteractiveMessageReply()) {
                //respondio con los botones
                if ($answer->getValue()) {
                    //pedimos contraseña
                    $this->ask('Ingrese la contraseña', function ($answer) {
                        $contra = $answer->getText();
                    });
                } else {
                    //no tiene contraseña
                    $contra = 'null';
                }
            } else {
                //no respondio por botones
                $this->say('Si/No');
                $this->repeat(); //se repite la pregunta con botones
            }
            return $contra;
        });
    }
}
