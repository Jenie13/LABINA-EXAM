<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Registration
    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name'              => 'required|min_length[3]|max_length[100]',
                'email'             => 'required|valid_email|is_unique[users.email]',
                'password'          => 'required|min_length[8]',
                'password_confirm'  => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $data = [
                    'name'     => $this->request->getVar('name'),
                    'email'    => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'role'     => 'student'
                ];
                $userModel->save($data);
                session()->setFlashdata('success', 'Registration successful. Please login.');
                return redirect()->to('/login');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/register', $data);
    }

    // Login with Role-Based Redirection
    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]'
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getPost('email'))->first();

                if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                    $sessionData = [
                        'user_id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLoggedIn' => true
                    ];
                    session()->set($sessionData);

                    // Role-based redirection
                    switch ($user['role']) {
                        case 'admin':
                            return redirect()->to('/admin/dashboard');
                        case 'instructor':
                        case 'teacher':
                            return redirect()->to('/teacher/dashboard');
                        case 'student':
                        default:
                            return redirect()->to('/announcements');
                    }
                }
                
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->back();
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/login', $data);
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login')->with('success', 'You have been logged out.');
    }

    // Dashboard (for backward compatibility)
    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role')
            ]
        ];
        
        return view('auth/dashboard', $data);
    }
}