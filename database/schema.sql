-- =====================================
-- RESET DATABASE
-- =====================================

DROP DATABASE IF EXISTS web_php_lab05;

CREATE DATABASE web_php_lab05
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE web_php_lab05;



-- =====================================
-- USERS (LOGIN)
-- =====================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(50) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    full_name VARCHAR(100) NOT NULL,

    role ENUM(
        'admin',
        'staff',
        'user'
    ) DEFAULT 'user',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- =====================================
-- STUDENTS
-- =====================================

CREATE TABLE students (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    full_name VARCHAR(100) NOT NULL,

    email VARCHAR(100) NOT NULL UNIQUE,

    phone VARCHAR(20),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


    CONSTRAINT fk_students_user
    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

);



-- =====================================
-- COURSES
-- =====================================

CREATE TABLE courses (

    id INT AUTO_INCREMENT PRIMARY KEY,


    user_id INT NOT NULL,


    course_code VARCHAR(20)
    NOT NULL UNIQUE,


    course_name VARCHAR(100)
    NOT NULL,


    tuition_fee DECIMAL(10,2)
    NOT NULL,


    available_seats INT
    DEFAULT 0,


    thumbnail VARCHAR(255),


    is_deleted BOOLEAN
    DEFAULT FALSE,


    created_at TIMESTAMP
    DEFAULT CURRENT_TIMESTAMP,


    CONSTRAINT fk_courses_user
    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

);



-- =====================================
-- ENROLLMENTS
-- =====================================

CREATE TABLE enrollments (

    id INT AUTO_INCREMENT PRIMARY KEY,


    user_id INT NOT NULL,


    student_id INT NOT NULL,


    course_id INT NOT NULL,


    enroll_date DATE NOT NULL,


    status ENUM(
        'pending',
        'approved',
        'cancelled'
    )
    DEFAULT 'pending',



    created_at TIMESTAMP
    DEFAULT CURRENT_TIMESTAMP,



    CONSTRAINT fk_enrollment_user
    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE CASCADE,


    CONSTRAINT fk_enrollment_student
    FOREIGN KEY(student_id)
    REFERENCES students(id)
    ON DELETE CASCADE,


    CONSTRAINT fk_enrollment_course
    FOREIGN KEY(course_id)
    REFERENCES courses(id)
    ON DELETE CASCADE

);



-- =====================================
-- AUDIT LOG
-- =====================================

CREATE TABLE audit_logs (

    id INT AUTO_INCREMENT PRIMARY KEY,


    user_id INT,


    action VARCHAR(100)
    NOT NULL,


    entity VARCHAR(100)
    NOT NULL,


    entity_id INT,


    result VARCHAR(50),


    ip_address VARCHAR(50),


    created_at TIMESTAMP
    DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(user_id)
    REFERENCES users(id)
    ON DELETE SET NULL

);



-- =====================================
-- INDEX
-- =====================================


CREATE INDEX idx_student_name
ON students(full_name);


CREATE INDEX idx_course_code
ON courses(course_code);


CREATE INDEX idx_enrollment_student
ON enrollments(student_id);


CREATE INDEX idx_enrollment_course
ON enrollments(course_id);


CREATE INDEX idx_audit_user
ON audit_logs(user_id);




-- =====================================
-- DEMO USERS
-- Password:
-- admin123
-- staff123
-- user123
-- =====================================


INSERT INTO users
(username,password,full_name,role)
VALUES


(
'admin',
'$2y$10$E4HWCN3GTXeUETjGu/doZejfTyMrDUS7gjEoJnDLQ3RwYgjH/L7fy',
'Administrator',
'admin'
),


(
'staff',
'$2y$10$PLACE_STAFF_HASH',
'Staff Account',
'staff'
),


(
'user',
'$2y$10$PLACE_USER_HASH',
'Student Account',
'user'
);




-- =====================================
-- SAMPLE STUDENTS
-- =====================================


INSERT INTO students
(user_id,full_name,email,phone)

VALUES

(1,
'Nguyen Van An',
'an@gmail.com',
'0901111111'),


(1,
'Tran Thi Binh',
'binh@gmail.com',
'0902222222'),


(1,
'Le Van Cuong',
'cuong@gmail.com',
'0903333333');




-- =====================================
-- SAMPLE COURSES
-- =====================================


INSERT INTO courses

(
user_id,
course_code,
course_name,
tuition_fee,
available_seats
)

VALUES


(
1,
'PHP01',
'PHP Basic',
2500000,
30
),


(
1,
'PHP02',
'PHP MVC',
3500000,
25
),


(
1,
'LARAVEL01',
'Laravel Framework',
4500000,
20
);




-- =====================================
-- SAMPLE ENROLLMENTS
-- =====================================


INSERT INTO enrollments

(
user_id,
student_id,
course_id,
enroll_date,
status
)

VALUES


(
1,
1,
1,
'2026-07-18',
'approved'
),


(
1,
2,
2,
'2026-07-19',
'pending'
),


(
1,
3,
3,
'2026-07-20',
'cancelled'
);