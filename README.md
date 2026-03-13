# Job Portal

A full-featured job portal web application built with Laravel 12, supporting job listings, freelance projects, resume management, and multi-role user workflows.

## Features

### Job Listings
- Post and browse full-time, part-time, contract, and internship positions
- Filter by category (IT, Healthcare, Engineering, Education, Finance, Marketing, and more)
- Salary ranges with currency support
- Experience levels: entry, mid, senior, executive
- Featured job promotion and view count tracking
- Application deadline management

### Freelance Marketplace
- Post freelance projects with fixed-price or hourly budgets
- Remote, onsite, or hybrid location types
- Freelancers submit proposals with bid amount and delivery timeline
- Proposal tracking and status management

### Resume Builder
- Create and manage multiple resumes
- Sections for skills, languages, experience, education, and certifications
- Toggle resumes between public and private visibility
- Attach resumes to job applications

### Company & Freelancer Directory
- Public company profiles with active job listings
- Freelancer directory with ratings and skill filters

## User Roles

| Feature | Jobseeker | Employer | Freelancer | Admin |
|---|---|---|---|---|
| Browse & search jobs | Yes | - | - | - |
| Apply for jobs | Yes | - | - | - |
| Create resumes | Yes | - | - | - |
| Save/bookmark jobs | Yes | - | - | - |
| Post job listings | - | Yes | - | - |
| Post freelance projects | - | Yes | - | - |
| Review applications | - | Yes | - | - |
| Submit proposals | - | - | Yes | - |
| Manage profile & portfolio | - | - | Yes | - |
| User management | - | - | - | Yes |
| Content moderation | - | - | - | Yes |
| Platform statistics | - | - | - | Yes |

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Frontend:** Blade templates, Tailwind CSS 4, Vite 7
- **Database:** SQLite (default), MySQL supported
- **Authentication:** Session-based with bcrypt password hashing

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm

### Quick Setup

```bash
# Clone the repository
git clone https://github.com/farshidghyasi/job-portal.git
cd job-portal

# Run the setup script (installs dependencies, generates key, runs migrations)
composer run setup

# Seed the database with sample data
php artisan db:seed
```

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Run database migrations
php artisan migrate

# Install frontend dependencies and build assets
npm install
npm run build
```

### Running the Development Server

```bash
# Start all services concurrently (app server, queue, logs, Vite)
composer run dev
```

This starts:
- Laravel development server on `http://localhost:8000`
- Queue worker for background jobs
- Log viewer (Laravel Pail)
- Vite dev server for hot module replacement

## Sample Data

After seeding, the following accounts are available:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@jobs.af` | `password` |
| Employer | See seeder | `password` |
| Jobseeker | See seeder | `password` |
| Freelancer | See seeder | `password` |

The seeder creates 5 employers, 5 jobseekers, 5 freelancers, and 20 job listings across various categories.

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/              # Admin panel (users, jobs, freelance moderation)
│   ├── AuthController       # Registration, login, logout
│   ├── JobController        # Public job browsing and filtering
│   ├── ApplicationController# Job applications
│   ├── JobseekerController  # Jobseeker dashboard and profile
│   ├── EmployerController   # Employer dashboard, job & application management
│   ├── FreelancerController # Freelancer dashboard and proposals
│   ├── FreelanceJobController# Freelance project management
│   └── ResumeController     # Resume CRUD and public viewing
├── Models/                  # Eloquent models (User, JobListing, Resume, etc.)
database/
├── migrations/              # Database schema definitions
├── seeders/                 # Sample data generators
resources/
├── views/                   # Blade templates organized by feature
routes/
└── web.php                  # All application routes
```

## Configuration

Key `.env` settings:

```env
DB_CONNECTION=sqlite          # Switch to mysql for production
SESSION_DRIVER=database
CACHE_STORE=database
BCRYPT_ROUNDS=12
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
