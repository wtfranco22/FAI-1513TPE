<?php

require_once 'vendor/autoload.php';
require_once '../configuracion.php';
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('ConversacionDescarga.php');


DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$config = [];

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

//cuando no coincide con ningun 'hears' entra en fallback
$botman->fallback(function ($bot) {
    //del driver que utilizamos obtenemos el obj mensaje del usuario
    $mensaje = $bot->getMessage();
    //damos una respuesta inmediata con reply al usuario
    $bot->reply("<a href='https://youtube.com' target='_blank'>youtube</a>");
});

//para descargar
$botman->hears('(.*)si(.*)',function ($bot) {
    $bot->startConversation(new ConversacionDescarga());
});

$botman->listen();
