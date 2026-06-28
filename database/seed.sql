USE web_php_lab05;
 
INSERT INTO users (name, email, password_hash, role)
VALUES
('Admin User', 'admin@example.com', '$2y$10$examplehashadmin', 'admin'),
('Sales Staff', 'sales@example.com', '$2y$10$examplehashstaff', 'staff');
 
INSERT INTO Students (name, email, phone, status, note)
VALUES
('Anna Nguyen', 'anna@example.com', '0909000001', 'new', 'Tư vấn khóa PHP'),
('Ben Tran', 'ben@example.com', '0909000002', 'contacted', 'Quan tâm Web App'),
('Chris Le', 'chris@example.com', '0909000003', 'qualified', 'Muốn học backend'),
('Duyen Pham', 'duyen@example.com', '0909000004', 'lost', 'Chưa có nhu cầu'),
('Minh Ho', 'minh@example.com', '0909000005', 'new', 'Đăng ký tư vấn');
 
INSERT INTO Enrollments (student_id,student_id, student_email, total_amount, status)
VALUES
('ORD-2026-0001', 'Anna Nguyen', 'anna@example.com', 2500000, 'pending'),
('ORD-2026-0002', 'Ben Tran', 'ben@example.com', 850000, 'paid'),
('ORD-2026-0003', 'Chris Le', 'chris@example.com', 1200000, 'cancelled');
