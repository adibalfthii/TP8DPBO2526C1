**Tugas Praktikum 8 DPBO 2026 - Kelas C1**

Nama: Muh. Adib Al-Fathi 

NIM: 2500418 

Kelas: C1 

**Janji**

Saya Muh. Adib Al-Fathi dengan NIM 2500418 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## 1. Desain Program & Database
Pada tugas praktikum ini, kode starter PHP yang awalnya masih ditulis secara prosedural untuk mengelola tabel `lecturers` dirombak ke dalam pola arsitektur **Model-View-Controller (MVC)** menggunakan koneksi database **PDO**. Selain itu, ditambahkan **2 tabel baru** (`departments` dan `courses`) yang saling berelasi dengan tabel utama, serta penambahan atribut `department_id` pada tabel `lecturers`.

Aplikasi menggunakan database MySQL bernama **`tp_mvc25`** dengan struktur 3 tabel sebagai berikut:

### A. Tabel `departments` (Tabel Baru 1 - Master Program Studi)
Menyimpan daftar program studi dan fakultas.
* `id` (`INT`, Primary Key, Auto Increment) — ID unik program studi
* `department_name` (`VARCHAR(100)`) — Nama program studi
* `faculty` (`VARCHAR(100)`) — Nama fakultas

### B. Tabel `lecturers` (Tabel Utama + Modifikasi Atribut Relasi)
Menyimpan data dosen beserta relasi ke program studi asalnya.
* `id` (`INT`, Primary Key, Auto Increment) — ID unik dosen
* `name` (`VARCHAR(100)`) — Nama lengkap dosen
* `nidn` (`VARCHAR(30)`) — Nomor Induk Dosen Nasional
* `phone` (`VARCHAR(20)`) — Nomor telepon dosen
* `join_date` (`DATE`) — Tanggal mulai bergabung
* `department_id` (`INT`, Foreign Key $\rightarrow$ `departments.id`) — Relasi *Many-to-One* ke tabel `departments` (`ON DELETE CASCADE`, `ON UPDATE CASCADE`)

### C. Tabel `courses` (Tabel Baru 2 - Data Mata Kuliah)
Menyimpan daftar mata kuliah beserta dosen pengampunya.
* `id` (`INT`, Primary Key, Auto Increment) — ID unik mata kuliah
* `course_code` (`VARCHAR(20)`) — Kode mata kuliah
* `course_name` (`VARCHAR(100)`) — Nama mata kuliah
* `credits` (`INT`) — Jumlah beban SKS
* `lecturer_id` (`INT`, Foreign Key $\rightarrow$ `lecturers.id`) — Relasi *Many-to-One* ke tabel `lecturers` (`ON DELETE CASCADE`, `ON UPDATE CASCADE`)

## 2. Struktur Folder Repositori
```text
TP8DPBO2526C1_Adib/
├── Dokumentasi/                       # Berisi screen record & screenshot uji coba CRUD semua tabel
├── Project/                           # Folder utama aplikasi dengan arsitektur MVC
│   ├── config/
│   │   └── Database.php               # Class koneksi database MySQL menggunakan PDO
│   ├── controller/
│   │   ├── CourseController.php       # Controller untuk mengatur request & aksi CRUD tabel courses
│   │   ├── DepartmentController.php   # Controller untuk mengatur request & aksi CRUD tabel departments
│   │   └── LecturerController.php     # Controller untuk mengatur request & aksi CRUD tabel lecturers
│   ├── database/
│   │   └── tp_mvc25.sql               # Salinan file SQL struktur & dummy data database
│   ├── model/
│   │   ├── Course.php                 # Model query CRUD & JOIN tabel courses dengan lecturers
│   │   ├── Department.php             # Model query CRUD tabel departments
│   │   └── Lecturer.php             # Model query CRUD & JOIN tabel lecturers dengan departments
│   ├── view/
│   │   ├── courses.php                # Tampilan form input/edit & tabel data courses
│   │   ├── departments.php            # Tampilan form input/edit & tabel data departments
│   │   ├── footer.php                 # Template penutup HTML & pemanggilan script Bootstrap
│   │   ├── header.php                 # Template navbar navigasi & pemanggilan CSS Bootstrap
│   │   └── lecturers.php              # Tampilan form input/edit & tabel data lecturers
│   ├── bootstrap.bundle.min.js        # Aset lokal JavaScript Bootstrap
│   ├── bootstrap.min.css              # Aset lokal CSS Bootstrap
│   ├── bootstrap.min.js               # Aset lokal JavaScript Bootstrap
│   ├── index.php                      # Entry point utama & router halaman aplikasi
│   ├── jquery.min.js                  # Aset lokal jQuery
│   └── popper.min.js                  # Aset lokal Popper.js
├── tp_mvc25.sql                       # File database utama untuk di-import ke phpMyAdmin
└── README.md                          # Dokumentasi desain program, alur MVC, dan pengujian
```

## 3. Penjelasan Alur Program (Flow MVC)
Aplikasi memisahkan logika akses database, alur kontrol request, dan tampilan antarmuka ke dalam alur kerja berikut:

1. **Entry Point & Routing (`Project/index.php`)**
   Saat pengguna mengakses web melalui browser, `index.php` membuat instance koneksi dari `config/Database.php` dan membaca parameter URL `?page=` (`lecturers`, `departments`, atau `courses`). Berdasarkan parameter tersebut, `index.php` memanggil *Controller* yang sesuai (default mengarah ke `LecturerController`).

2. **Controller (`Project/controller/`)**
   Masing-masing controller (`LecturerController`, `DepartmentController`, `CourseController`) bertugas menangani seluruh request HTTP dari pengguna:
   * **Create & Update (`POST`):** Menangkap input dari form. Jika input `id` kosong, controller memanggil method `create()` pada Model; jika `id` terisi, controller memanggil method `update()`. Setelah selesai, pengguna di-redirect kembali ke halaman daftar tabel.
   * **Delete (`GET` dengan `?action=delete&id=...`):** Memanggil method `delete($id)` pada Model untuk menghapus data tertentu. * **Edit Mode (`GET` dengan `?action=edit&id=...`):** Memanggil method `getById($id)` pada Model agar data lama muncul otomatis di dalam form edit.
   * **Read:** Mengambil seluruh data dari Model (termasuk data relasi untuk keperluan `<select>` dropdown pada form) lalu melempar variabel datanya ke file View.
  
  3. **Model (`Project/model/`)**
   Setiap kelas Model (`Lecturer`, `Department`, `Course`) menerima objek koneksi PDO dan menjalankan seluruh operasi SQL menggunakan *Prepared Statements* (`prepare()`, `bindParam()`, `execute()`). Khusus pada `Lecturer::getAll()` dan `Course::getAll()`, digunakan query `JOIN` agar nama departemen dan nama dosen pengampu langsung tampil di tabel utama, bukan sekadar angka ID foreign key-nya.

4. **View (`Project/view/`)**
   File di folder `view/` (`lecturers.php`, `departments.php`, `courses.php`) hanya fokus menampilkan komponen HTML dan Bootstrap 5 menggunakan data array yang sudah disiapkan Controller. Bagian navigasi atas dan penutup halaman dipisah ke `header.php` dan `footer.php` supaya lebih rapi dan tidak berulang di setiap file.

## 4. Dokumentasi Pengujian Program
Pengujian seluruh fitur **Create, Read, Update, dan Delete (CRUD)** telah dilakukan pada ketiga tabel (`departments`, `lecturers`, dan `courses`) dan berjalan sesuai alur relasinya.

**add_lecturers**
<img width="918" height="482" alt="add_lecturers" src="https://github.com/user-attachments/assets/6fc65f89-f9c9-45fc-a1f9-27c9b4b1f007" />

**delete_lecturers**
<img width="911" height="525" alt="delete_lecturers" src="https://github.com/user-attachments/assets/7587b658-7848-4e14-9918-7be107d39723" />

**edit_lecturers**
<img width="938" height="507" alt="edit_lecturers" src="https://github.com/user-attachments/assets/3721fea5-c7c6-4f5f-9ae6-fe3e9c070e71" />

**add_departments**
<img width="931" height="380" alt="add_departments" src="https://github.com/user-attachments/assets/51d5cbee-f1ac-4955-8e44-ee6fb189ff44" />

**delete_departments**
<img width="863" height="312" alt="delete_departments" src="https://github.com/user-attachments/assets/67f6091e-4bbd-47b0-894e-15c7d7853249" />

**edit_departments**
<img width="928" height="385" alt="edit_departments" src="https://github.com/user-attachments/assets/269166f4-e53d-4d12-a125-9a154cae7f92" />

**add_courses**
<img width="923" height="456" alt="add_courses" src="https://github.com/user-attachments/assets/af7d122e-1049-4b3d-954d-b3f643f57b9c" />

**delete_courses**
<img width="902" height="448" alt="delete_courses" src="https://github.com/user-attachments/assets/5580bc27-ff87-4012-911b-d6734ce721b1" />

**edit_courses**
<img width="908" height="429" alt="edit_courses" src="https://github.com/user-attachments/assets/e0f90acd-2c1c-418e-8c44-f9d17730eb72" />


