<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Introduction to Programming',
                'description' => 'Learn the basics of programming with hands-on examples and exercises.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Web Development Fundamentals',
                'description' => 'Build modern websites using HTML, CSS, and JavaScript.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Database Design and Management',
                'description' => 'Learn how to design, implement, and manage relational databases.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Object-Oriented Programming',
                'description' => 'Master OOP concepts with practical examples in popular programming languages.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Create native mobile applications for iOS and Android platforms.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'description' => 'Learn essential data structures and algorithms for efficient problem solving.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Software Engineering Principles',
                'description' => 'Understand software development lifecycle and best practices.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'title' => 'Cybersecurity Basics',
                'description' => 'Learn fundamental concepts of information security and protection.',
                'teacher_id' => 2, // Tom Teacher
                'created_at' => null,
                'updated_at' => null,
            ],
        ];

        $this->db->table('courses')->insertBatch($data);
    }
}
