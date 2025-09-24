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
		<!-- Quick Stats -->
		<div class="row g-3 mb-1">
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Enrolled Courses</div>
						<div class="h4 mb-0"><strong><?= esc($stats['enrolledCourses'] ?? 0) ?></strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Completed Lessons</div>
						<div class="h4 mb-0"><strong><?= esc($stats['completedLessons'] ?? 0) ?></strong></div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark text-light">
					<div class="card-body">
						<div class="small text-muted">Overall Progress</div>
						<div class="h4 mb-0"><strong>—</strong></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Quick Actions -->
		<div class="card bg-dark text-light mb-2">
			<div class="card-body d-flex gap-2 flex-wrap">
				<button class="btn btn-primary btn-sm disabled">Resume Learning</button>
				<button class="btn btn-outline-light btn-sm disabled">Browse Courses</button>
				<button class="btn btn-outline-light btn-sm disabled">View Grades</button>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-lg-7">
				<div class="card bg-dark text-light h-100">
					<div class="card-header">My Enrollments (<?= esc($stats['enrolledCourses'] ?? 0) ?>)</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-dark table-hover table-sm mb-0">
								<thead>
									<tr>
										<th>Code</th>
										<th>Title</th>
										<th>Progress</th>
									</tr>
								</thead>
								<tbody>
									<?php if (!empty($enrolledCourses)): ?>
										<?php foreach ($enrolledCourses as $e): ?>
										<tr>
											<td><?= esc($e['code']) ?></td>
											<td><?= esc($e['title']) ?></td>
											<td>
												<div class="progress" style="height: 10px;">
													<div class="progress-bar" role="progressbar" style="width: <?= esc($e['progress']) ?>;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
														<?= esc($e['progress']) ?>
													</div>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr><td colspan="3" class="text-center">You are not enrolled in any course.</td></tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary btn-sm disabled">Browse Courses (coming soon)</a>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="card bg-dark text-light h-100">
					<div class="card-header">Upcoming</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<?php if (!empty($upcoming)): ?>
								<?php foreach ($upcoming as $u): ?>
								<li class="list-group-item bg-dark text-light d-flex justify-content-between align-items-center">
									<span>
										<strong><?= esc($u['type']) ?></strong> · <?= esc($u['course']) ?>
									</span>
									<span class="badge bg-primary">Due: <?= esc($u['due']) ?></span>
								</li>
								<?php endforeach; ?>
							<?php else: ?>
								<li class="list-group-item bg-dark text-light text-center">No upcoming items.</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
		</div>
	</div>

<?= $this->endSection() ?>


