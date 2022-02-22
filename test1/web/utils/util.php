<?php

function includeDir($path)
{
    $dir = new \RecursiveDirectoryIterator($path);
    $iterator = new \RecursiveIteratorIterator($dir);
    foreach ($iterator as $file) {
        $fname = $file->getFilename();
        if (preg_match('%\.php$%', $fname)) {
            if($fname != 'index.php') require_once $file->getPathname();
        }
    }
}

function includeDirClass($path,$basePath = '',$server=null)
{
        $dir = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($dir);
        foreach($iterator as $file) {
            $fname = $file->getFilename();
            $namespace="";
            if($basePath){
               $basePathx = $basePath;
            } else {
               $basePathx = '/'.$iterator->getSubPath();
               $namespace = $iterator->getSubPath();
            }
            if(preg_match('%\.php$%', $fname)) {
                if($fname != 'index.php') {
                    require_once $file->getPathname();
                    if(preg_match('/.*Controller\.php/',$fname)) {
                        $basePathx = str_replace(['\\'],'/',$basePathx);
                        $namespace = str_replace(['/'],'\\',$basePathx);
                        $className = basename($fname, '.php');
                        if($namespace =='\\') $namespace = '';
                        if($server) $server->addClass($namespace.'\\'.$className, $basePathx);
                    }
                }
            }
        }
}

function replaceslag($str){
      return  str_replace(['//'],'/',$str);
}

function replacebslag($str){
      return  str_replace(['\\\\'],'\\',$str);
}

if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}


if (!function_exists('implodeKV')) {
    function implodeKV($glueKV, $gluePair, $KVarray)
    {
        if (is_object($KVarray)) {
            $KVarray = json_decode(json_encode($KVarray), true);
        }
        $t = array();
        foreach ($KVarray as $key => $val) {
            if (is_array($val)) {
                $val = implodeKV(':', ',', $val);
            } elseif (is_object($val)) {
                $val = json_decode(json_encode($val), true);
                $val = implodeKV(':', ',', $val);
            }

            if (is_int($key)) {
                $t[] = $val;
            } else {
                $t[] = $key . $glueKV . $val;
            }
        }
        return implode($gluePair, $t);
    }
}

if (!function_exists('consolelog')) {
    function consolelog($status = 200)
    {
        $lists = func_get_args();
        $status = '';
        $status = implodeKV(':', ' ', $lists);
        if (isset($_SERVER["REMOTE_ADDR"]) && !empty($_SERVER["REMOTE_ADDR"])) {
            $raddr =$_SERVER["REMOTE_ADDR"];
        } else {
            $raddr = '127.0.0.1';
        }
        if (isset($_SERVER["REMOTE_PORT"]) && !empty($_SERVER["REMOTE_PORT"])) {
            $rport = $_SERVER["REMOTE_PORT"];
        } else {
            $rport = '8000';
        }

        if (isset($_SERVER["REQUEST_URI"]) && !empty($_SERVER["REQUEST_URI"])) {
            $ruri = $_SERVER["REQUEST_URI"];
        } else {
            $ruri = '/console';
        }
        file_put_contents(
            "php://stdout",
            sprintf(
                "[%s] %s:%s [%s]:%s \n",
                date("D M j H:i:s Y"),
                $raddr,
                $rport,
                $status,
                $ruri
            )
        );
    }
} // end-of-check funtion exist

if (!function_exists('logAccess')) {
    function logAccess($status = 200)
    {
        file_put_contents("php://stdout", sprintf(
            "[%s] %s:%s [%s]: %s\n",
            date("D M j H:i:s Y"),
            $_SERVER["REMOTE_ADDR"],
            $_SERVER["REMOTE_PORT"],
            $status,
            $_SERVER["REQUEST_URI"]
        ));
    }
}

if (!function_exists('saveImg')) {
    //---- save image ----------
    /**
     * @param base64 string $b64img
     * @param string|null $imgname
     * @param string $filepath
     * @return string
    **/
    function saveImg($b64img,$imgname=null,$filepath="/images/") {
        try {
            if($imgname) {
                $output_file = $imgname;
            } else {
                $output_file = uniqid().'.png';
            }
            file_put_contents(SRVPATH.$filepath.$output_file,file_get_contents($b64img));
            return $output_file;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
//------------- INIT----------------------------------------

?>