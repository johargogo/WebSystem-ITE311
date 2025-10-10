<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Course extends BaseController
{
    /**
     * Handle AJAX enrollment request
     */
    public function enroll()
    {
        // Check if user is logged in
        if (!session()->has('userId')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please log in to enroll in courses.'
            ]);
        }

        // Get course_id from POST request
        $course_id = $this->request->getPost('course_id');

        if (!$course_id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Course ID is required.'
            ]);
        }

        $user_id = session('userId');
        $enrollmentModel = new EnrollmentModel();

        // Check if user is already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You are already enrolled in this course.'
            ]);
        }

        // Insert new enrollment
        $data = [
            'user_id' => $user_id,
            'course_id' => $course_id
        ];

        if ($enrollmentModel->enrollUser($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Successfully enrolled in the course!'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to enroll in the course. Please try again.'
            ]);
        }
    }

    /**
     * Display student dashboard with enrolled and available courses
     */
    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->has('userId')) {
            return redirect()->to('/login');
        }

        $user_id = session('userId');
        $enrollmentModel = new EnrollmentModel();

        // Get enrolled courses
        $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);

        // Get available courses
        $availableCourses = $enrollmentModel->getAvailableCourses($user_id);

        $data = [
            'enrolledCourses' => $enrolledCourses,
            'availableCourses' => $availableCourses,
            'userEmail' => session('userEmail')
        ];

        return view('dashboard', $data);
    }
}
