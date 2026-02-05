INSERT INTO admins (name, email, password) VALUES
('Admin User', 'admin@ocims.test', '$2y$12$2FemVxc.3J1nJzu/zFuccut97sgsyxbLBHgrDs7JDbMTnQBoZfFRS');

INSERT INTO teachers (name, email, password, subscription_status, subscription_expiry, mobile, approval_status) VALUES
('Teacher One', 'teacher1@ocims.test', '$2y$12$9PySy6WA44V6mn7bd/YY7u8orYcoa.YZBmcqpJ2/gCHsi2zNjNcT.', 'active', DATE_ADD(CURDATE(), INTERVAL 1 MONTH), '0710000001', 'approved'),
('Teacher Two', 'teacher2@ocims.test', '$2y$12$9PySy6WA44V6mn7bd/YY7u8orYcoa.YZBmcqpJ2/gCHsi2zNjNcT.', 'inactive', NULL, '0710000002', 'approved');

INSERT INTO students (name, age, NIC, city, WhatsApp, email, password, approval_status) VALUES
('Student One', 18, 'NIC001', 'City A', '0711111111', 'student1@ocims.test', '$2y$12$t6lvuaJYkRwDjLGt3rIoOOoOcJio5v2qEGjEJIx5qq0QAa6b.mtNe', 'approved'),
('Student Two', 19, 'NIC002', 'City B', '0711111112', 'student2@ocims.test', '$2y$12$t6lvuaJYkRwDjLGt3rIoOOoOcJio5v2qEGjEJIx5qq0QAa6b.mtNe', 'approved'),
('Student Three', 20, 'NIC003', 'City C', '0711111113', 'student3@ocims.test', '$2y$12$t6lvuaJYkRwDjLGt3rIoOOoOcJio5v2qEGjEJIx5qq0QAa6b.mtNe', 'approved'),
('Student Four', 21, 'NIC004', 'City D', '0711111114', 'student4@ocims.test', '$2y$12$t6lvuaJYkRwDjLGt3rIoOOoOcJio5v2qEGjEJIx5qq0QAa6b.mtNe', 'approved');

INSERT INTO batches (name, teacher_id, fee_amount) VALUES
('Maths Batch A', 1, 1000.00),
('Science Batch B', 2, 1200.00);

INSERT INTO teacher_payments (teacher_id, amount, payment_type, proof, status, paid_on) VALUES
(1, 500.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'approved', CURDATE()),
(2, 500.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'pending', CURDATE());

INSERT INTO student_payments (student_id, batch_id, amount, convenience_fee, total_amount, payment_type, proof, status, paid_on) VALUES
(1, 1, 1000.00, 0.00, 1000.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'approved', CURDATE()),
(2, 1, 1000.00, 50.00, 1050.00, 'online', 'MOCK-1234', 'captured', CURDATE()),
(3, 2, 1200.00, 0.00, 1200.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'pending', CURDATE());

INSERT INTO class_schedule (batch_id, class_date, start_time, end_time, topic, status) VALUES
(1, DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:00', '10:00', 'Algebra Basics', 'scheduled'),
(2, DATE_ADD(CURDATE(), INTERVAL 2 DAY), '11:00', '12:00', 'Physics Intro', 'scheduled');

INSERT INTO tutes (batch_id, title, file_path) VALUES
(1, 'Algebra Notes', '/assets/uploads/tutes/algebra.pdf'),
(2, 'Physics Notes', '/assets/uploads/tutes/physics.pdf');

INSERT INTO live_classes (batch_id, youtube_embed_url, schedule_date) VALUES
(1, '<iframe width="300" height="170" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>', DATE_ADD(CURDATE(), INTERVAL 1 DAY));

INSERT INTO posts (teacher_id, batch_id, content, visibility, status, approved_by, approved_at, created_at) VALUES
(1, 1, 'Welcome to Maths Batch A!', 'students', 'approved', 1, NOW(), NOW()),
(2, 2, 'Please submit assignments by Friday.', 'students', 'pending', NULL, NULL, NOW());

INSERT INTO post_payments (post_id, teacher_id, amount, payment_type, proof, status, featured_until, created_at) VALUES
(1, 1, 150.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'approved', DATE_ADD(NOW(), INTERVAL 7 DAY), NOW()),
(2, 2, 150.00, 'manual', '/assets/uploads/payment_proofs/sample-proof.pdf', 'pending', NULL, NOW());

INSERT INTO reminders (user_id, user_type, batch_id, content, channel, scheduled_date, status) VALUES
(1, 'teacher', NULL, 'Your subscription is due soon.', 'sms', DATE_ADD(NOW(), INTERVAL 1 DAY), 'pending'),
(1, 'student', 1, 'Class starts in 1 hour.', 'email', DATE_ADD(NOW(), INTERVAL 1 DAY), 'pending');

INSERT INTO attendance (class_schedule_id, student_id, status, marked_by, marked_at) VALUES
(1, 1, 'present', 1, NOW()),
(1, 2, 'absent', 1, NOW());

INSERT INTO performance (student_id, batch_id, score, notes, recorded_at) VALUES
(1, 1, 85.5, 'Good progress', NOW()),
(2, 1, 72.0, 'Needs improvement', NOW());

INSERT INTO enrollments (student_id, batch_id, next_due_date) VALUES
(1, 1, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
(2, 1, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
(3, 2, DATE_ADD(CURDATE(), INTERVAL 30 DAY));

INSERT INTO settings (`key`, `value`) VALUES
('convenience_fee_percent', '5'),
('teacher_subscription_months', '1');
