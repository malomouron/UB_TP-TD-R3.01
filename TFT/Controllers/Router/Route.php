<?php

declare(strict_types=1);

namespace Controllers\Router;

abstract class Route
{

    public function __construct()
    {

    }
    public function action($params = [], $method = 'GET')
    {
        $ret = null;
        // Si la méthode est POST, on appelle la méthode post(), sinon get()
        if ($method === 'POST') {
            $ret = $this->post($params);
        }
        elseif ($method === 'GET'){
            $ret = $this->get($params);
        }
        return $ret;
    }

    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            // Si le paramètre ne peut pas être vide et qu'il l'est, on lance une exception
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        } else {
            // Si le paramètre n'existe pas, on lance une exception
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    abstract public function get($params = []);

    abstract public function post($params = []);
}

