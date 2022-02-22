<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Illuminate\Database\Capsule\Manager as DB;

require_once __DIR__ .'/vendor/autoload.php';
require_once __DIR__ .'/utils/util.php';
define('SRVPATH', __DIR__);
require_once __DIR__.'/configs/config.php';
includeDir(__DIR__.'/models');
includeDir(__DIR__.'/services');


$server = new swoole_http_server('0.0.0.0', 8080);
$server->set([
    'worker_num' => swoole_cpu_num()
]);

$server->on("start", function (Server $server) {
    echo "Swoole http server is started at http://127.0.0.1:8080\n";
});

$server->on('request', function (Request $req, Response $res) {
    // $u = new User();
    // $u->username = 'zzzz';
    // $u->password = '$2y$10$T5OxWmbW37hbPhZDteIH8eJbIx5kLZlrltu10vIsez2.ost/Z45bG';
    // $u->email = 'zzzz@zzzz.com';
    // $u->profile ='uploads/files/43e56f0d-a49b-478c-84f6-0d7d7d3877ea.jpg';
    // $u->save();
    $sql = "INSERT INTO `test`.`users` (`username`, `password`, `email`, `profile`) VALUES ('abcx', '$2y$10$T5OxWmbW37hbPhZDteIH8eJbIx5kLZlrltu10vIsez2.ost/Z45bG', 'abcx@abcx.com', 'uploads/files/43e56f0d-a49b-478c-84f6-0d7d7d3877ea.jpg')";
    DB::insert($sql);
    $res->end('[okzzzz]');
});

$server->start();





