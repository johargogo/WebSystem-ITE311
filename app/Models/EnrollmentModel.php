<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];
    protected $useTimestamps = false;

    /**
     * Enroll a user in a course
     */
    public function enrollUser($data)
    {
        $data['enrollment_date'] = date('Y-m-d H:i:s');
        return $this->insert($data);
    }

    /**
     * Get all enrollments for a specific user
     */
    public function getUserEnrollments($user_id)
    {
        return $this->select('enrollments.*, courses.title, courses.description')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->findAll();
    }

    /**
     * Check if a user is already enrolled in a specific course
     */
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        return $this->where('user_id', $user_id)
                    ->where('course_id', $course_id)
                    ->countAllResults() > 0;
    }

    /**
     * Get all available courses (not enrolled by user)
     */
    public function getAvailableCourses($user_id)
    {
        $enrolled_course_ids = $this->select('course_id')
                                   ->where('user_id', $user_id)
                                   ->findAll();

        $enrolled_ids = array_column($enrolled_course_ids, 'course_id');

        $coursesModel = new \App\Models\CourseModel();

        if (empty($enrolled_ids)) {
            return $coursesModel->findAll();
        }

        return $coursesModel->whereNotIn('id', $enrolled_ids)->findAll();
    }
}
