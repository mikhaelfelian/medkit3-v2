<?php
/**
 * Dashboard Controller
 * 
 * Created by Mikhael Felian Waskito
 * Created at 2024-01-09
 */

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }
        
        $data = [
            'title'         => 'Dashboard',
            'Pengaturan'    => $this->pengaturan,
            'user'          => $this->ionAuth->user()->row(),
            'isMenuActive'  => isMenuActive('dashboard') ? 'active' : '',
            'total_users'   => 1
        ];

        return view($this->theme->getThemePath() . '/dashboard', $data);
    }
} 