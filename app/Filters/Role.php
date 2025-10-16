<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user has required role
        $userRole = session()->get('role');
        
        // If no specific role is required, just check if user is logged in
        if (empty($arguments)) {
            return;
        }

        // Handle both string and array arguments
        $requiredRoles = is_array($arguments) ? $arguments : [$arguments];

        if (!in_array($userRole, $requiredRoles)) {
            return redirect()->back()->with('error', 'Access Denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}