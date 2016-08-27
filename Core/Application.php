<?php

namespace FDF\Core;

use FDF\Models\User;
use FDF\Models\Subject;

class Application
{
    /**
     *Function that boots up the app
     *
     */
    public function run()
    {
        // Initializing basic constants
        define('DS', DIRECTORY_SEPARATOR);
        define('SYS_ROOT', 'RT5614_Rasko_Lazic' . DS . 'moodle_v2.0' . DS);
        define('HOST_ROOT', '/RT5614_Rasko_Lazic/moodle_v2.0/');
        define('FDF_CORE_DIR', 'core' . DS);
        define('FDF_MODEL_DIR', 'models' . DS);
        define('NS', '\\');
        define('FILE_EXTENSION', '.php');

        $appContainer = new Container();

        require_once FDF_CORE_DIR . 'Loader' . FILE_EXTENSION;

        $appContainer->store('loader', new Loader());

        // Registering all autoloaders
        $loader = $appContainer->get('loader');
        $loader->loadAll();

        $appContainer->store('database', new Database());

        // Connecting to database and checking if parameters we have are ok
        $db = $appContainer->get('database');
        $db->connect();
        if(! $db->checkIfConnected()) {
            exit("Database failed to connect.\nPlease contact your admin.");
        }

        session_start();
        $appContainer->store('session', new Session());

        // Forwarding current request to Requester class
        $requestUrl = str_replace(HOST_ROOT, '', $_SERVER['REQUEST_URI']);
        $queryString = $_SERVER['QUERY_STRING'];
        $appContainer->store('requester', new Requester($requestUrl, $queryString));

        // Calling method that resolves controller depending on url
        $appContainer->get('requester')->parse();
    }
}

class Container
{
    static private $holder = [];

    /**
     * @param $key
     * @param $item
     * @param bool $overwrite   set only if you want tke key overwritten even if it's taken
     */
    public function store($key, $item, $overwrite = false)
    {
        if($overwrite) {
            self::$holder[$key] = $item;
        } else {
            if(! isset(self::$holder[$key])) {
                self::$holder[$key] = $item;
            }
        }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if(isset(self::$holder[$key])) {
            return self::$holder[$key];
        }

        return null;
    }
}