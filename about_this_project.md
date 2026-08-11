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
