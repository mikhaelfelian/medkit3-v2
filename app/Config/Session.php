<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    public $driver = FileHandler::class;
    
    public $cookieName = 'ci_session';
    
    public $expiration = 7200;
    
    public $savePath = WRITEPATH . 'session';
    
    public $matchIP = false;
    
    public $timeToUpdate = 300;
    
    public $regenerateDestroy = false;
}
