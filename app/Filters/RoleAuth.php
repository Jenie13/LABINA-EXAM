<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{
    /**
     * Check if the user has permission to access the route based on their role
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        $userRole = $session->get('role');
        $uri = $request->getUri()->getPath();

        // Admin can access everything
        if ($userRole === 'admin') {
            return null; // Allow access
        }

        // Teacher/Instructor access control
        if ($userRole === 'teacher' || $userRole === 'instructor') {
            // Teachers can access /teacher/* and /announcements
            if (strpos($uri, '/teacher') === 0 || strpos($uri, '/announcements') === 0) {
                return null; // Allow access
            }
            
            // Deny access to admin routes
            if (strpos($uri, '/admin') === 0) {
                return redirect()->to('/announcements')
                    ->with('error', 'Access Denied: Insufficient Permissions');
            }
        }

        // Student access control
        if ($userRole === 'student') {
            // Students can only access /student/* and /announcements
            if (strpos($uri, '/student') === 0 || strpos($uri, '/announcements') === 0) {
                return null; // Allow access
            }
            
            // Deny access to admin and teacher routes
            if (strpos($uri, '/admin') === 0 || strpos($uri, '/teacher') === 0) {
                return redirect()->to('/announcements')
                    ->with('error', 'Access Denied: Insufficient Permissions');
            }
        }

        // If no specific rule matched, deny access
        return redirect()->to('/announcements')
            ->with('error', 'Access Denied: Insufficient Permissions');
    }

    /**
     * Allows After filters to inspect and modify the response.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}