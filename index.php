<?php
//{
//  "text": "Server is still starting! Please wait before reconnecting."
//}
//Importar Klein
require_once __DIR__ . '/vendor/autoload.php';
$klein = new \Klein\Klein();

//Importar php-srv-minecraft
require __DIR__ . '/vendor/xpaw/php-minecraft-query/src/MinecraftPing.php';
require __DIR__ . '/vendor/xpaw/php-minecraft-query/src/MinecraftPingException.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;


$klein->respond('GET', '/api/[:ip]/[:port]', function ($request) {
    try {
        $query = new MinecraftPing( $request->ip, $request->port);

        $info = $query->Query();
        return print_r(json_encode($info));
    } catch (MinecraftPingException $e) {
        return "Server Offline";
    }
});

$klein->respond('GET', '/api/[:ip]', function ($request) {
    try {
        $query = new MinecraftPing( $request->ip, 25565);

        $info = $query->Query();
        return print_r(json_encode($info));
    } catch (MinecraftPingException $e) {
        return "Server Offline";
    }
});

$klein->dispatch();