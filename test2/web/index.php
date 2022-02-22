<?php
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

$server = new swoole_http_server('0.0.0.0', 8080);
$server->set([
    'worker_num' => swoole_cpu_num()
]);

$database = new Database();

$server->on("start", function (Server $server) {
    echo "Swoole http server is started at http://127.0.0.1:8080\n";
});

$server->on('workerStart', function () use ($database) {
    $database->connect();
});

$server->on('request', function (Request $req, Response $res) use ($database) {
    \Swoole\Runtime::enableCoroutine();
    $queries =1;
    $channel = new \Swoole\Coroutine\Channel($queries);
    go(function () use ($channel, $queries, $database) {
        $pdo = $database->get();
        $sql = "INSERT INTO `test`.`users` (`username`, `password`, `email`, `profile`) VALUES ('xxxx', '$2y$10$T5OxWmbW37hbPhZDteIH8eJbIx5kLZlrltu10vIsez2.ost/Z45bG', 'xxx@xxxx.com', 'uploads/files/43e56f0d-a49b-478c-84f6-0d7d7d3877ea.jpg')";
        $statement = $pdo->prepare($sql);
        $statement->execute();
            // $channel->push($statement->fetchAll());
        $channel->push($statement->fetchAll(PDO::FETCH_ASSOC));
    });
    $arr = $channel->pop();
    $res->end(\json_encode($arr));
});

$server->start();

class Database {

    private $db;

    public function connect(){
        $this->db = new \PDO('mysql:host=mariadb;dbname=test', 'root', 'toor', []);
    }

    public function get(){
        return $this->db;
    }
}