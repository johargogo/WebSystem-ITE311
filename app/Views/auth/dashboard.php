<?= $this->extend('template') ?>

<?= $this->section('content') ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0 text-light">Dashboard</h1>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-primary">Logout</a>
    </div>

    <div class="alert alert-success" role="alert">
        Welcome, <?= esc($userName ?: ($userEmail ?? 'User')) ?>! Your role is <strong><?= esc($role) ?></strong>.
    </div>

	<!-- Layout: Sidebar (menus) + Main content -->
	<div class="row g-3">
		<div class="col-lg-3">
			<div class="card bg-dark text-light">
				<div class="card-header d-flex justify-content-between align-items-center">
					<span>Menu</span>
					<span class="badge bg-secondary text-uppercase"><?= esc($role) ?></span>
				</div>
				<div class="list-group list-group-flush">
					<?php if ($role === 'admin'): ?>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light d-flex justify-content-between align-items-center">
							<span>Users</span>
							<span class="badge bg-info text-dark"><?= esc($stats['totalUsers'] ?? 0) ?></span>
						</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Courses</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Reports</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Settings</a>
					<?php elseif ($role === 'teacher'): ?>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light d-flex justify-content-between align-items-center">
							<span>My Courses</span>
							<span class="badge bg-info text-dark"><?= esc($stats['myCourses'] ?? 0) ?></span>
						</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light d-flex justify-content-between align-items-center">
							<span>Submissions</span>
							<span class="badge bg-warning text-dark"><?= esc($stats['pendingSubmissions'] ?? 0) ?></span>
						</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Gradebook</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Messages</a>
					<?php else: ?>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light d-flex justify-content-between align-items-center">
							<span>My Courses</span>
							<span class="badge bg-info text-dark"><?= esc($stats['enrolledCourses'] ?? 0) ?></span>
						</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Progress</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Upcoming</a>
						<a href="#" class="list-group-item list-group-item-action bg-dark text-light">Messages</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-lg-9">
	<?php if ($role === 'admin'): ?>
		<!-- Quick Stats -->
		<div class="row g-3 mb-1">
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Total Users</div>
						<div class="h4 mb-0"><strong><?= esc($stats['totalUsers'] ?? 0) ?></strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Active Courses</div>
						<div class="h4 mb-0"><strong>—</strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">System Health</div>
						<div class="h4 mb-0"><span class="badge bg-success">Good</span></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Quick Actions -->
		<div class="card bg-dark text-light mb-2">
			<div class="card-body d-flex gap-2 flex-wrap">
				<button class="btn btn-primary btn-sm disabled">Add User</button>
				<button class="btn btn-outline-light btn-sm disabled">Export Report</button>
				<button class="btn btn-outline-light btn-sm disabled">Site Settings</button>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-md-4">
				<div class="card bg-dark text-light h-100">
					<div class="card-header">Admin Overview</div>
					<div class="card-body">
						<p class="mb-2">Total Users</p>
						<h3 class="mb-3"><strong><?= esc($stats['totalUsers'] ?? 0) ?></strong></h3>
						<a href="#" class="btn btn-primary btn-sm disabled">Manage Users (coming soon)</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card bg-dark text-light h-100">
					<div class="card-header d-flex justify-content-between align-items-center">
						<span>Recent Users</span>
						<span class="badge bg-secondary">Last 5</span>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-dark table-hover table-sm mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($recentUsers)): ?>
										<?php foreach ($recentUsers as $u): ?>
										<tr>
											<td><?= esc($u['name'] ?? 'Unknown') ?></td>
											<td><?= esc($u['email'] ?? '') ?></td>
											<td><span class="badge bg-info text-dark"><?= esc($u['role'] ?? 'student') ?></span></td>
										</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr><td colspan="3" class="text-center">No users found.</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ($role === 'teacher'): ?>
		<!-- Quick Stats -->
		<div class="row g-3 mb-1">
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">My Courses</div>
						<div class="h4 mb-0"><strong><?= esc($stats['myCourses'] ?? 0) ?></strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Pending Submissions</div>
						<div class="h4 mb-0"><strong><?= esc($stats['pendingSubmissions'] ?? 0) ?></strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Messages</div>
						<div class="h4 mb-0"><strong>0</strong></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Quick Actions -->
		<div class="card bg-dark text-light mb-2">
			<div class="card-body d-flex gap-2 flex-wrap">
				<button class="btn btn-primary btn-sm disabled">Create Course</button>
				<button class="btn btn-outline-light btn-sm disabled">Post Announcement</button>
				<button class="btn btn-outline-light btn-sm disabled">Grade All</button>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-lg-6">
				<div class="card bg-dark text-light h-100">
					<div class="card-header">My Courses (<?= esc($stats['myCourses'] ?? 0) ?>)</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-dark table-hover table-sm mb-0">
								<thead>
									<tr>
										<th>Code</th>
										<th>Title</th>
										<th>Students</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($myCourses)): ?>
										<?php foreach ($myCourses as $c): ?>
										<tr>
											<td><?= esc($c['code']) ?></td>
											<td><?= esc($c['title']) ?></td>
											<td><?= esc($c['students']) ?></td>
										</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr><td colspan="3" class="text-center">No courses yet.</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary btn-sm disabled">Create Course (coming soon)</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card bg-dark text-light h-100">
					<div class="card-header">Pending Submissions (<?= esc($stats['pendingSubmissions'] ?? 0) ?>)</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<?php if (!empty($pendingSubmissions)): ?>
								<?php foreach ($pendingSubmissions as $p): ?>
								<li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
									<span>
										<strong><?= esc($p['student']) ?></strong> · <?= esc($p['course']) ?> · <?= esc($p['item']) ?>
									</span>
									<span>
										<button class="btn btn-outline-success btn-sm disabled">Grade</button>
									</span>
								</li>
								<?php endforeach; ?>
							<?php else: ?>
								<li class="list-group-item bg-dark text-light text-center">No pending submissions.</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<!-- Enrollment System for Students -->
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
										<h6 class="mb-1 text-white fw-bold"><?= esc($course['title']) ?></h6>
										<p class="mb-1 text-light-50"><?= esc($course['description']) ?></p>
										<small class="text-info">
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
					<div class="card-header bg-primary text-white">
						<h5 class="mb-0">Available Courses</h5>
					</div>
					<div class="card-body">
						<?php if (!empty($availableCourses)): ?>
							<div class="list-group">
								<?php foreach ($availableCourses as $course): ?>
									<div class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between align-items-center">
										<div>
											<h6 class="mb-1 text-white fw-bold"><?= esc($course['title']) ?></h6>
											<p class="mb-1 text-light-50"><?= esc($course['description']) ?></p>
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

						// Get the course information from the button's parent element
						var courseItem = button.closest('.list-group-item');
						var courseTitle = courseItem.find('h6').text();
						var courseDescription = courseItem.find('p').text();
						var enrollmentDate = new Date().toLocaleDateString('en-US', {
							year: 'numeric',
							month: 'short',
							day: 'numeric'
						});

						// Hide the button
						button.fadeOut();

						// After animation completes, move course to enrolled section
						setTimeout(function() {
							// Remove from available courses
							courseItem.fadeOut(400, function() {
								$(this).remove();

								// Add to enrolled courses
								var enrolledCourseHtml = `
									<div class="list-group-item bg-dark text-light border-secondary">
										<h6 class="mb-1 text-white fw-bold">${courseTitle}</h6>
										<p class="mb-1 text-light-50">${courseDescription}</p>
										<small class="text-info">Enrolled on: ${enrollmentDate}</small>
									</div>
								`;

								// Check if enrolled courses list is empty
								var enrolledList = $('.card:has(.card-header:contains("My Enrolled Courses")) .list-group');
								var emptyMessage = enrolledList.find('p:contains("You haven\'t enrolled in any courses yet.")');

								if (emptyMessage.length > 0) {
									// Replace empty message with course
									emptyMessage.parent().html('<div class="list-group">' + enrolledCourseHtml + '</div>');
								} else {
									// Add to existing list
									enrolledList.append(enrolledCourseHtml);
								}

								// Update course counts in sidebar
								updateCourseCounts();

								// Check if no more available courses
								var availableCoursesCard = $('.card:has(.card-header:contains("Available Courses")) .list-group');
								if (availableCoursesCard.children('.list-group-item').length === 0) {
									availableCoursesCard.html('<p class="text-muted mb-0">No courses available at the moment.</p>');
								}
							});
						}, 500);

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

		// Function to update course counts in sidebar
		function updateCourseCounts() {
			var enrolledCount = $('.card:has(.card-header:contains("My Enrolled Courses")) .list-group .list-group-item').length;
			$('.list-group-item:contains("My Courses") .badge').text(enrolledCount);
		}
		</script>
	<?php endif; ?>
		</div>
	</div>

<?= $this->endSection() ?>
