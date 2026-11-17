CREATE DATABASE IF NOT EXISTS tp_mvc25;
USE tp_mvc25;

-- Tabel 1: Departments (Tabel Baru 1)
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    faculty VARCHAR(100) NOT NULL
);

-- Tabel 2: Lecturers (Tabel Utama dari Starter + Relasi ke Departments)
CREATE TABLE lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(30) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    join_date DATE NOT NULL,
    department_id INT NOT NULL,
    CONSTRAINT fk_lecturer_department
        FOREIGN KEY (department_id) REFERENCES departments(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Tabel 3: Courses (Tabel Baru 2 + Relasi ke Lecturers)
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL,
    lecturer_id INT NOT NULL,
    CONSTRAINT fk_course_lecturer
        FOREIGN KEY (lecturer_id) REFERENCES lecturers(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Data Awal (Dummy Data)
INSERT INTO departments (department_name, faculty) VALUES
('Ilmu Komputer', 'FPMIPA'),
('Pendidikan Ilmu Komputer', 'FPMIPA'),
('Rekayasa Perangkat Lunak', 'Kampus Cibiru');

INSERT INTO lecturers (name, nidn, phone, join_date, department_id) VALUES
('Dr. Budi Santoso, M.Kom.', '0412088501', '081234567890', '2018-09-01', 1),
('Rina Marlina, S.Pd., M.T.', '0423049002', '082345678901', '2020-02-15', 2);

INSERT INTO courses (course_code, course_name, credits, lecturer_id) VALUES
('IK204', 'Desain dan Pemrograman Berorientasi Objek', 3, 1),
('IK301', 'Rekayasa Perangkat Lunak', 3, 2);