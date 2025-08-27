<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Create your content as a string
        $content = "<h1>Welcome to the Home Page!</h1><p>This content is created directly in the controller.</p>";

        // Pass the content string to the template
        return view('template', ['content' => $content]);
    }
}
