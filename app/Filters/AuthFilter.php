<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use IonAuth\Libraries\IonAuth;

class AuthFilter implements FilterInterface
{
    protected $ionAuth;

    public function __construct()
    {
        $this->ionAuth = new IonAuth();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$this->ionAuth->loggedIn()) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to(base_url('auth/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
} 