<?= $this->extend('template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-light">Student Dashboard</h1>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-primary">Logout</a>
    </div>

    <div class="alert alert-success" role="alert">
        Welcome, <?= esc($userEmail ?? session('userEmail')) ?>!
    </div>

    <div class="row">
        <!-- Enrolled Courses Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 bg-dark text-light">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Enrolled Courses</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($enrolledCourses)): ?>
                        <div class="list-group">
                            <?php foreach ($enrolledCourses as $course): ?>
                                <div class="list-group-item bg-dark text-light border-secondary">
                                    <h6 class="mb-1"><?= esc($course['title']) ?></h6>
                                    <p class="mb-1 text-muted"><?= esc($course['description']) ?></p>
                                    <small class="text-success">
                                        Enrolled on: <?= date('M d, Y', strtotime($course['enrollment_date'])) ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">You haven't enrolled in any courses yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Available Courses Section -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 bg-dark text-light">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Available Courses</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($availableCourses)): ?>
                        <div class="list-group">
                            <?php foreach ($availableCourses as $course): ?>
                                <div class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1"><?= esc($course['title']) ?></h6>
                                        <p class="mb-1 text-muted"><?= esc($course['description']) ?></p>
                                    </div>
                                    <button class="btn btn-success btn-sm enroll-btn"
                                            data-course-id="<?= $course['id'] ?>">
                                        Enroll
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">No courses available at the moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Message Area -->
    <div id="message-area"></div>

    <!-- jQuery and AJAX Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.enroll-btn').on('click', function(e) {
            e.preventDefault();

            var button = $(this);
            var courseId = button.data('course-id');
            var originalText = button.text();

            // Disable button and show loading state
            button.prop('disabled', true).text('Enrolling...');

            $.post('<?= base_url('course/enroll') ?>', {
                course_id: courseId
            })
            .done(function(response) {
                if (response.success) {
                    // Show success message
                    $('#message-area').html(
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>'
                    );

                    // Hide the button
                    button.fadeOut();

                    // Optional: Add to enrolled courses list (you can refresh the page or update dynamically)
                    setTimeout(function() {
                        location.reload(); // Simple solution - refresh to show updated lists
                    }, 1500);

                } else {
                    // Show error message
                    $('#message-area').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                        '</div>'
                    );

                    // Re-enable button
                    button.prop('disabled', false).text(originalText);
                }
            })
            .fail(function() {
                // Show error message
                $('#message-area').html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    'An error occurred. Please try again.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>'
                );

                // Re-enable button
                button.prop('disabled', false).text(originalText);
            });
        });
    });
    </script>
<?= $this->endSection() ?>
