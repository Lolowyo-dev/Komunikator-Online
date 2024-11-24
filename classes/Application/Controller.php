<?php

namespace Application;

class Controller
{
    private $cmd;
    private $config;

    public function __construct($cmd, $config)
    {
        $this->cmd = explode("/", $cmd);
        $this->config = $config;
    }

    public function getObjectName()
    {
        $namespace = $this->cmd[0] ?? null;
        $class = $this->cmd[1] ?? null;
        if ($namespace && $class) {
            $objectName = "\\{$namespace}\\{$class}";
            if (class_exists($objectName))
                return $objectName;
        }
        return null;
    }

    public function redirectPage($pageUrl, $end = false)
    {
        $url = "{$this->config['proto']}://{$this->config['url']}{$pageUrl}.html";
        header("Location: {$url}");

        if ($end) {
            die();
        }
    }

    public function GetParam($name)
    {
        $key = array_search($name, $this->cmd);
        if ($key) {
            if (isset($this->cmd[$key + 1])) {
                return $this->cmd[$key + 1];
            }
        }
        return null;
    }
}
