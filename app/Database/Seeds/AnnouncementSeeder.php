<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'      => 'Welcome to the New Semester!',
                'content'    => 'We are excited to welcome all students to the new academic semester. Please review your course schedules and ensure all enrollment requirements are complete. Classes begin next Monday.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title'      => 'Library Hours Extended',
                'content'    => 'The university library will now be open until 10 PM on weekdays to accommodate student study needs. Weekend hours remain 9 AM to 6 PM. Please bring your student ID for access.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'title'      => 'Scholarship Application Deadline',
                'content'    => 'Reminder: The deadline for scholarship applications is approaching. All applications must be submitted by the end of this month. Visit the financial aid office for assistance.',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('announcements')->insertBatch($data);
    }
}