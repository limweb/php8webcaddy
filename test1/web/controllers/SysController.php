<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class SysController
{

    /**
     * @noAuth
     */
    private function info($info = null)
    {
        echo "<br/><center><b>API Server JWT v1.".((isset($info) && $info=='tlen') ? $info : null)." is <a href='/routes'>WORK!</a></b></center>";
    }

    /**
     * @noAuth
     * @url GET /
     * @url GET /index
     */
    public function index()
    {
        $u = new User();
        $u->username = 'yyyy';
        $u->password = '$2y$10$T5OxWmbW37hbPhZDteIH8eJbIx5kLZlrltu10vIsez2.ost/Z45bG';
        $u->email = 'yyyy@yyyy.com';
        $u->profile ='uploads/files/43e56f0d-a49b-478c-84f6-0d7d7d3877ea.jpg';
        $u->save();
        return ['ok'];
    }


    /**
    *@noAuth
    * @url GET /routes
    * @ url GET /routes/$info
    * @ url GET /routes/$info/$controller
    *----------------------------------------------
    *FILE NAME:  SysController.php gen for Servit Framework Controller
    *Created by: Tlen<limweb@hotmail.com>
    *DATE:  2020-03-16(Mon)  13:41:47

    *----------------------------------------------
    */
    public function getRoutes($info = null, $controller = null) {
            $this->getrouteinfo($info, $controller);
    }



    private function getrouteinfo($info=null,$controller=null){
        $info = 'tlen';
        $this->info($info);
        if ($this->server->mode == 'debug' ) {
            echo '<style> .divline { width:100%; text-align:center; border-bottom: 1px dashed #000; line-height:0.1em; margin:10px 0 20px; }
            </style>
            <center><table><thead><tr><td><b>Route</b></td><td><b>Controller</b></td><td><b>Method</b></td><td><b>$args</b></td><td>null</td><td><b>@noAuth</b></td></tr></thead><tbody>';
            foreach ($this->server->map as $routekey => $routes) {
                echo '<tr><td colspan="6"><div style="display:flex;padding-right:10px;height:15px;">
                <div class="divline" style="width:200px;">&nbsp;</div>
                <span style="white-space: pre;">&nbsp;>&nbsp;@url '.$routekey.'&nbsp;</span>
                <div class="divline">&nbsp;</div>
                </div>
                </td></tr>';
                switch ($routekey) {
                    case 'GET':
                        foreach ($routes as $key => $value) {
                            if (!in_array($key,['get_header','get_footer','gettheme'])){
                                if ($controller) {
                                    if (strtolower($value[0])==strtolower($controller)) {
                                        echo "<tr><td>".($routekey =='GET' ? '<a href="http://'.$_SERVER['HTTP_HOST'].'/'.$key.'">'.( empty($key) ? '/' : $key ).'</a>'    : $key)."</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td>".($routekey =='GET' ? '<a href="http://'.$_SERVER['HTTP_HOST'].$this->server->root.$key.'">'.( empty($key) ? '/' : $key ).'</a>'    : $key)."</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                                }
                            }
                        }
                        break;
                    case 'POST':
                    case 'OPTIONS':
                    default:
                        foreach ($routes as $key => $value) {
                            if ($controller) {
                                if (strtolower($value[0])==strtolower($controller)) {
                                    echo "<tr><td style='cursor:pointer;' onclick='alert(\"".$key."\")'>$key</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                                }
                            } else {
                                echo "<tr><td style='cursor:pointer;' onclick='alert(\"".$key."\")'>$key</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                            }
                        }
                        break;
                }
            }
            echo '<tr><td colspan="6"><div style="display:flex;padding-right:10px;height:15px;">
            <div class="divline">&nbsp;</div>
            <span style="white-space: pre;">&nbsp;>&nbsp;END.&nbsp;</span>
            </div></td></tr>';
            echo '</tbody></table></center>';
        }
        exit(0);
    }

}