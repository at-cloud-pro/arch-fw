<?php
namespace ArchFW\Controller;

class Router
{
    /**
     * Function for assigning wrappers and templates depending on URI
     *
     * Depending on URI returns API wrappers or TWIG Templates and PHP Wrappers
     *
     * @return string filename that has to be loaded
     */
    public function getFileName()
    {
        // CHECK IF APP HAS
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        if (array_key_exists(1, $uri)) {
            $_GET = $this->_findArgs($uri[1]);
        }

        if (strpos($_SERVER['REQUEST_URI'], '/api/') !== false) {
            return $this->_findFiles($uri[0], true);
        }
        return $this->_findFiles($uri[0], false);
    }

    /**
     * Returns array of GET values in URI
     *
     * Simple gets all data after '?', then puts it in an array. Required if using REST style routing. Run function and assing returned values to $_GET variable.
     *
     * @param string $string
     * @return void
     */
    private function _findArgs(string $string)
    {
        $args = explode('&', $string);
        $output = [];

        if (count($args) > 0) {
            foreach ($args as $key => $value) {
                $str = explode('=', $value);
                if (array_key_exists(1, $str)) {
                    $output += [$str[0] => $str[1]];
                } else if ($str[0] != "") {
                    $output += [$str[0] => null];
                }
            }
        }
        return $output;
    }

    /**
     * Finds file name for specified URI
     *
     * Function is checking if in config file is specified which file app should load when user enters specified URI. By default looking for twig templates, if $isAPI variable is set to true, only loads API wrapper.
     *
     * @param string $string Requested URI file part
     * @param boolean $isAPI Set to true when accessing API server
     * @return string Returns filename when found
     * @throws Exception when route were not found
     */
    private function _findFiles(string $string, bool $isAPI)
    {
        if ($isAPI) {
            // RUNS IF SERVER MAY BE USED AS API SERVO
            if (CONFIG['APIrunning'] === false) {
                header("Content-Type: application/json");
                echo json_encode([
                    'error' => true,
                    'errorCode' => 601,
                    'errorMessage' => 'API functionality were turned off in app config file on server.',
                ]);
                exit;
            }

            $string = str_replace("/api", null, $string);
            if (!array_key_exists($string, CONFIG['APIrouter'])) {
                throw new \Exception("Router did not found route '$string' in API config file!", 11);
            }
            header("Content-Type: application/json");

            $file = CONFIG['APIwrappers'] . "/" . CONFIG['APIrouter'][$string];
            if (!file_exists("$file.php")) {
                throw new \Exception("File does not exists!", 11);
            }
            $json = require_once "$file.php";
            echo json_encode($json);
            exit;
        } else {
            if (!array_key_exists($string, CONFIG['appRouter'])) {
                throw new \Exception("Router did not found route '$string' in APP config file!", 11);
            }
            return CONFIG['appRouter'][$string];
        }
    }
}

