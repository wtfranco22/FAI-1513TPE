<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ConversacionDescarga extends Conversation
{
    protected $link;
    protected $contra;

    /**
     * 'ejecuta' de manera automatica la clase y llama de inmediato a la funcion charla
     */
    public function pedirlink()
    {
        $this->ask('Ingresa el código', function ($answer) {
            $this->link = $answer->getText();
            $this->preguntarContra();
        });
    }

    public function preguntarContra()
    {
        $pregunta = Question::create('¿Tiene contraseña?')
            ->addButtons([ //preguntamos por la seguridad
                Button::create('SI')->value(1),
                Button::create('NO')->value(0),
            ]);
        $this->ask($pregunta, function ($answer) {
            //respondio con los botones
            if ($answer->getValue() == 0 || strtolower($answer->getText()) == 'no') {
                //pedimos contraseña
                $this->contra = 'null';
                $this->retornarArchivo();
            } else {
                $this->pedirContra();
            }
        });
    }

    public function pedirContra()
    {
        $this->ask('Ingrese la clave: ', function ($answer) {
            $this->contra = $answer->getText();
            $this->retornarArchivo();
        });
    }

    public function retornarArchivo()
    {
        $archivo = new AbmArchivoCargado();
        $busqueda['aclinkacceso'] = $this->link;
        $busqueda['acprotegidoclave'] = $this->contra;
        $arreglo = $archivo->buscar($busqueda);
        if ($arreglo != null) {
            $objAC = $arreglo[0];
            if (file_exists('../vista/contenido/compartidos/' . $objAC->getAcNombre())) {
                $this->say("Nombre: " . $objAC->getAcNombre() . "
            <br><a type='button' target='_blank' href='../vista/contenido/formularios/verArchivo.php?aclinkacceso=".$this->link."'>Ver Archivo</a>");
            } else {
                $this->say('Ups! no esta disponible para compartir');
            }
        } else {
            $this->say('No se encuentra en la BD');
            $this->pedirlink();
        }
    }


    public function run()
    {
        $this->pedirLink();
    }
}
