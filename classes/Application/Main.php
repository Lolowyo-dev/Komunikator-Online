<?php

namespace Application;

class Main
{
    public $cmd;
    public $config;
    public $objects = [];

    public function __construct($cmd, $config)
    {
        $this->cmd = explode("/", $cmd);
        $this->config = $config;
        $this->config['css'] = $this->config['css'] ?? [];
        $this->config['js'] = $this->config['js'] ?? [];
    }

    public function registerObject($obj)
    {
        if (is_object($obj)) {
            $this->objects[get_class($obj)] = $obj;
            return true;
        }
        return false;
    }

    public function getInstance($className)
    {
        return $this->objects[$className] ?? null;
    }

    public function getTemplatePath($file)
    {
        $path = "templates/" . $this->config['template'] . "/" . $file;
        return file_exists($path) ? $path : false;
    }

    public function addAsset($name, $type = 'css')
    {
        $allowedTypes = ['css', 'js'];
        if (in_array($type, $allowedTypes)) {
            $this->config[$type][] = $name;
        }
    }

    public function getUrl($path = '')
    {
        return "{$this->config['proto']}://{$this->config['url']}/{$path}";
    }

    public function loadAssets()
    {
        $html = '';

        // Ładowanie plików CSS
        $cssUrl = $this->getUrl("templates/{$this->config['template']}/css/");
        foreach ($this->config['css'] as $cssFile) {
            $html .= "<link rel='stylesheet' type='text/css' href='{$cssUrl}{$cssFile}'>\n";
        }

        // Ładowanie plików JS
        $jsUrl = $this->getUrl("templates/{$this->config['template']}/js/");
        foreach ($this->config['js'] as $jsFile) {
            if (strpos($jsFile, 'http') === 0) {
                $html .= "<script src='{$jsFile}'></script>\n";
                continue;
            }
            $html .= "<script src='{$jsUrl}{$jsFile}'></script>\n";
        }

        return $html;
    }
}