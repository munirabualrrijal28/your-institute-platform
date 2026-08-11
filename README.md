<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

# The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# your-institute-platform

An educational platform connecting verified institutes and students. It features a secure authentication system for institutes to publish their courses, and allows registered students to seamlessly browse educational offerings.

# Your Institute

**Your Institute** is a full-stack educational platform built with **Laravel 11** that connects educational institutes with students. Institutes can register, get admin-verified, publish courses & advertisements, and build their online presence — while students can discover, follow, rate, and interact with institutes.

---

## Tech Stack

| Layer       | Technology                                                       |
| ----------- | ---------------------------------------------------------------- |
| Backend     | PHP 8.2, Laravel 11                                              |
| Frontend    | Blade Templates, Livewire 3, Alpine.js, TailwindCSS, Bootstrap 5 |
| Build Tools | Vite, PostCSS, Autoprefixer                                      |
| Real-time   | Pusher + Laravel Echo (WebSocket broadcasting)                   |
| Database    | SQLite (local), MySQL (production via Railway / Clever Cloud)    |
| Debugging   | Laravel Telescope, Laravel Pail                                  |
| Auth        | Laravel Breeze (email/password)                                  |
| Deployment  | Docker (PHP 8.2-FPM), Render (`render.yaml`)                     |

---

## User Roles

The platform uses role-based access control with three distinct user types:

| Role              | Description                                                                                               |
| ----------------- | --------------------------------------------------------------------------------------------------------- |
| **Admin** (0)     | Verifies/restricts institutes, manages advertisements, moderates ratings/reports, system oversight.       |
| **Institute** (1) | Manages own profile, categories, courses, advertisements, and instructors. Requires license verification. |
| **User** (2)      | Browses institutes and courses, follows institutes, leaves comments and ratings, reports content.         |

---

## Core Features

### Institute Management

- Institute registration with license photo upload
- Admin verification & license approval workflow
- Institute restriction/unrestriction by admins
- Profile customization (name, description, photo)
- License re-submission on rejection

### Course & Category System

- Institutes organize courses under custom categories
- Full CRUD for categories and courses
- Courses are scoped by institute verification status (unverified/restricted institutes' courses are hidden)
- Polymorphic media attachments on courses

### Advertisements

- Institutes can create and manage promotional ads
- Admins can also manage ads globally
- Ads are searchable alongside institutes and courses

### Social Features

- **Follow system** — Users follow institutes to stay updated
- **Comments** — Polymorphic comment system on courses
- **Ratings** — Polymorphic rating system with admin moderation (approve/reject)
- **Notifications** — Real-time notifications via Pusher with mark-as-read support (single & bulk)

### Search

- Global search across institutes, courses, and advertisements
- Live search suggestions via API endpoint
- Dedicated search results page with multi-type results

### Reporting & Moderation

- Users can report content (comments, users, etc.)
- Admin report management dashboard with resolve, notify reporter, and delete content actions

### Admin Dashboard

- Institute verification queue
- Student management
- Advertisement management
- Report moderation
- Rating moderation

---

## Data Models

```
User ──┬── Institute ──┬── Category ──── Course
       │               ├── Advertisement
       │               ├── Instructor
       │               └── Follower ←── Student
       ├── Student
       └── Instructor

Polymorphic:
  ├── Comments   → (Course, ...)
  ├── Ratings    → (Course, Institute, ...)
  ├── Media      → (User, Institute, Course, ...)
  └── Reports    → (Comment, User, ...)
```

**14 Eloquent Models:** User, Institute, Student, Instructor, Admin, Category, Courses, Advertisements, Comments, Followers, Ratings, Reports, Notifications, Media.

---

## Architecture

### Livewire Components (35 total)

Organized into feature areas:

- **InstituteTabs** — 13 components for institute profile/dashboard tabs
- **StudentTabs** — 13 components for student/user profile tabs
- **Admin** — Admin-specific interactive components
- **Follow** — Follow/unfollow toggle logic
- **Ratings** — Star rating UI and submission
- **Search** — Live search and suggestions
- **Notifications** — Real-time notification bell and list
- **User** — User profile-related components

### Controllers (37 total)

Separated by domain:

- `Admin/` — Admin dashboard, institute/student management, ads, reports, ratings moderation
- `Institute/` — Institute-facing controllers (profile, categories, courses, ads, notifications)
- `User/` — User-specific views and search
- `Master*` — Shared CRUD controllers for categories, courses/ads, comments, and instructors

### Middleware

- `rolemanager` — Enforces role-based route access (admin, institute, user)
- Separate `auth:admin` guard for admin authentication

---

## Database

18 migrations covering:

- `users`, `cache`, `jobs` (Laravel defaults)
- `institutes`, `categories`, `courses`, `students`
- `comments`, `followers`, `ratings`, `media`
- `advertisements`, `notifications`, `instructors`
- `admins`, `telescope_entries`, `reports`
- `add_licence_approval_to_institutes_table`

---

## Project Structure

```
your-institute/
├── app/
│   ├── Constants/        # UserRole, CategoryObject, ConfirmDelete, LicPhoto
│   ├── Events/           # Real-time broadcasting events
│   ├── Http/
│   │   ├── Controllers/  # 37 controllers (Admin/, Institute/, User/, Master*)
│   │   ├── Middleware/    # Role-based access control
│   │   └── Requests/     # Form request validation
│   ├── Livewire/         # 35 Livewire components (8 feature groups)
│   ├── Models/           # 14 Eloquent models
│   ├── Notifications/    # Laravel notification classes
│   ├── Providers/        # Service providers
│   └── View/             # View composers / components
├── config/               # 12 config files (app, auth, broadcasting, etc.)
├── database/
│   ├── factories/        # Model factories
│   ├── migrations/       # 18 migration files
│   └── seeders/          # Database seeders
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # Alpine.js, Laravel Echo setup
│   └── views/            # 129 Blade templates (admin, auth, user, institute, livewire)
├── routes/
│   ├── web.php           # Main routes (713 lines)
│   ├── auth.php          # Authentication routes (Breeze)
│   └── channels.php      # Broadcasting channel authorization
├── public/               # Public assets
├── tests/                # PHPUnit test suite
├── Dockerfile            # Docker deployment config
├── render.yaml           # Render deployment config
├── vite.config.js        # Vite bundler config
├── tailwind.config.js    # TailwindCSS config
└── composer.json         # PHP dependencies
```

---

## Getting Started

```bash
# 1. Install PHP dependencies
composer install

# 2. Install JS dependencies
npm install

# 3. Copy environment config
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Run migrations
php artisan migrate

# 6. Start development servers (Laravel + Vite + Queue + Pail)
composer dev
```

The `composer dev` script starts all four services concurrently:

- **Laravel dev server** (`php artisan serve`)
- **Queue worker** (`php artisan queue:listen`)
- **Log tail** (`php artisan pail`)
- **Vite dev server** (`npm run dev`)
  <!-- >>>>>>> 3a064344cec8e8598b3946aebdc72998f97f5faf -->
