<?php

class Router
{
    private $_uri = array();
    private $_action = array();

    public function add($uri, $action = null)
    {
        $this->_uri[] = '/' . trim($uri, '/');

        if ($action != null) {
            $this->_action[] = $action;
        }
    }

    public function run()
    {
        $uriGet = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        foreach ($this->_uri as $key => $value) {
            if (preg_match("#^$value$#", $uriGet)) {
                $action = $this->_action[$key];
                $this->runAction($action);
            }
        }
    }

    private static function runAction($action)
    {
        $action();
    }
}
