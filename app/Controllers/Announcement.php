<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;

class Announcement extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $model = new AnnouncementModel();
        
        // Fetch all announcements ordered by created_at descending
        $data['announcements'] = $model->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Announcements';
        
        return view('announcements', $data);
    }
}