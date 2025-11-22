# SkillHub Certification - Course Management System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## 📋 About Project

**SkillHub Certification** is a course and participant management system built using Laravel 12. This project was created to **fulfill certification requirements** and demonstrate proficiency in:

-   Web application development using Laravel framework
-   Implementation of MVC (Model-View-Controller) pattern
-   Database management with Eloquent ORM
-   Application testing with PestPHP
-   CRUD operations implementation
-   Model relationships (Many-to-Many)

### Main Features

✨ **Participant Management**

-   Create, Read, Update, Delete participants
-   Complete information: name, email, phone, address

✨ **Course Management**

-   Create, Read, Update, Delete courses
-   Course details: name, instructor, description, duration

✨ **Enrollment Management**

-   Enroll participants to courses
-   Many-to-Many relationship between participants and courses
-   View enrollment list with participant and course details
-   Unenroll participants from courses

## 🛠 Technologies Used

-   **Framework**: Laravel 12.0
-   **PHP**: 8.2+
-   **Database**: MySQL/PostgreSQL/SQLite
-   **Testing**: PestPHP 4.1
-   **Frontend**: Blade Templates, Vite
-   **CSS Framework**: Bootstrap/Tailwind (optional)

## 📦 Installation

### Prerequisites

Make sure your system has installed:

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   Database (MySQL/PostgreSQL/SQLite)

### Installation Steps

1. **Clone repository**

```bash
git clone https://github.com/LouisFernando1204/skillhub-certification.git
cd skillhub-certification
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Setup environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Database configuration**

Edit `.env` file and adjust database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skillhub_certification
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations**

```bash
php artisan migrate
```

6. **Build assets**

```bash
npm run build
```

7. **Run application**

```bash
php artisan serve
```

Application will run at `http://localhost:8000`

## 🗄 Database Structure

### Participants Table

-   `id`: Primary Key
-   `name`: Participant name
-   `email`: Participant email (unique)
-   `phone`: Phone number
-   `address`: Address
-   `created_at`, `updated_at`: Timestamps

### Courses Table

-   `id`: Primary Key
-   `name`: Course name
-   `instructor`: Instructor name
-   `description`: Course description
-   `duration`: Course duration
-   `created_at`, `updated_at`: Timestamps

### Course_Participants Table (Pivot Table)

-   `id`: Primary Key
-   `course_id`: Foreign Key to courses
-   `participant_id`: Foreign Key to participants
-   `created_at`, `updated_at`: Timestamps

## 🔗 Endpoint Routes

### Participants

-   `GET /participants` - List all participants
-   `GET /participants/create` - Add participant form
-   `POST /participants` - Save new participant
-   `GET /participants/{id}` - Participant details
-   `GET /participants/{id}/edit` - Edit participant form
-   `PUT /participants/{id}` - Update participant
-   `DELETE /participants/{id}` - Delete participant

### Courses

-   `GET /courses` - List all courses
-   `GET /courses/create` - Add course form
-   `POST /courses` - Save new course
-   `GET /courses/{id}` - Course details
-   `GET /courses/{id}/edit` - Edit course form
-   `PUT /courses/{id}` - Update course
-   `DELETE /courses/{id}` - Delete course

### Enrollments

-   `GET /enrollments` - List all enrollments
-   `GET /enrollments/create` - New enrollment form
-   `POST /enrollments` - Save enrollment
-   `DELETE /enrollments/{id}` - Delete enrollment

## 🧪 Testing

This project uses **PestPHP** for testing. To run tests:

```bash
# Run all tests
php artisan test

# or use pest directly
./vendor/bin/pest

# Run tests with coverage
php artisan test --coverage
```

### Test Coverage

Available tests:

-   ✅ Course CRUD operations
-   ✅ Participant CRUD operations
-   ✅ Enrollment operations
-   ✅ Model relationships
-   ✅ Validation rules

## 📁 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── CourseController.php
│       ├── ParticipantController.php
│       └── EnrollmentController.php
├── Models/
│   ├── Course.php
│   ├── Participant.php
│   └── CourseParticipant.php
│
database/
├── migrations/
│   ├── 2025_11_22_044027_create_courses_table.php
│   ├── 2025_11_22_044027_create_participants_table.php
│   └── 2025_11_22_099999_create_course_participants_table.php
│
resources/
├── views/
│   ├── courses/
│   ├── participants/
│   ├── enrollments/
│   └── layouts/
│
tests/
├── Feature/
│   ├── CourseTest.php
│   ├── ParticipantTest.php
│   └── EnrollmentTest.php
```

## 🎯 Implemented Features

### 1. CRUD Operations

-   ✅ Create, Read, Update, Delete for Participants
-   ✅ Create, Read, Update, Delete for Courses
-   ✅ Create, Read, Delete for Enrollments

### 2. Database Relations

-   ✅ Many-to-Many relationship between Courses and Participants
-   ✅ Eloquent ORM for query optimization

### 3. Validation

-   ✅ Form validation for all inputs
-   ✅ Email unique validation
-   ✅ Required field validation

### 4. Testing

-   ✅ Unit tests for models
-   ✅ Feature tests for controllers
-   ✅ Test coverage for critical paths

## 👨‍💻 Developer

**Louis Fernando**

-   GitHub: [@LouisFernando1204](https://github.com/LouisFernando1204)
