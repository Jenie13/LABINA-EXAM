<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user has teacher role
        if (session()->get('role') !== 'teacher' && session()->get('role') !== 'instructor') {
            return redirect()->to('/announcements')->with('error', 'Access Denied: Insufficient Permissions');
        }

        $data = [
            'title' => 'Teacher Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];

        return view('teacher/teacher_dashboard', $data);
    }
}