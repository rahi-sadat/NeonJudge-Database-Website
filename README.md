# NeonJudge

NeonJudge is an Online Judge platform for programming contests, practice problems, submissions, verdicts, standings, setter tools, and admin contest approval.

## Project Overview

The application gives contestants and setters a focused workspace for competitive programming workflows.

## Core Features

- Home page with contest and practice highlights
- Public contest list with status and approval state
- Contest details with problem list, score, time limit, and memory limit
- Practice problems with search, difficulty filtering, and sorting
- Problem details with statement, samples, constraints, code editor, and submit button
- Submission form that can send code to Judge0 for verdicts
- Leaderboard with score and penalty sorting
- User dashboard with rating, solves, progress, and recommendations
- Problem setter panel with create problem form UI
- Admin panel with contest approval and reports

## Technology Stack

- Laravel with PHP
- Blade templates
- HTML, CSS, JavaScript
- Oracle-ready structure
- Oracle-backed user login

## Installation Steps

```bash
composer install
copy .env.example .env
D:\xampp\php\php.exe artisan key:generate
D:\xampp\php\php.exe artisan migrate
D:\xampp\php\php.exe artisan db:seed
D:\xampp\php\php.exe artisan serve
```

Open the local URL shown by Laravel, usually:

```bash
http://127.0.0.1:8000
```

If PHP is already in your PATH, you can use `php artisan ...` instead of `D:\xampp\php\php.exe artisan ...`.

For Oracle on Windows, you can also start the site with:

```bash
serve-oracle.bat
```

That script puts Oracle Instant Client in PATH before Laravel starts.

## Judge0 Setup

Laravel talks to Judge0 through the URL in `.env`:

```text
JUDGE0_URL=http://127.0.0.1:2358
JUDGE0_API_KEY=
```

Use the local URL when Judge0 is running on your machine. Keep `JUDGE0_API_KEY` empty for a self-hosted Judge0 server.

## User Roles

- Student: browses contests, solves practice problems, submits code, views dashboard
- Problem Setter: creates problems, drafts contests, adds problems to contests
- Admin: approves contests and reviews reports

Default admin login:

```text
Username: Admin
Password: admin123
```

## Planned Platform Features

- Real submission storage and judge queue
- Test case management for setters
- Contest registration and announcements
- Problem editorials after contests end
- Rating updates after rated rounds
- Downloadable contest reports for admins

## Presentation Flow

1. Show Home Page and explain the platform purpose.
2. Show Contest List and contest status.
3. Open Contest Details and explain score, time limit, and problems.
4. Show Problem Page and submit code from the built-in editor.
5. Show Leaderboard and explain score and penalty.
6. Show Practice Page and difficulty/rating-based filtering.
7. Show Problem Setter Panel and explain problem/contest creation.
8. Show Admin Dashboard and explain contest approval.

## Future Improvements

- Add authentication and role-based middleware
- Convert controller sample data into Eloquent models
- Add more migrations and seeders
- Store submissions in the database and run them through a queue
- Add admin audit logs and approval history
- Add problem tags, test case management, and setter review workflow
- Add downloadable reports for teachers/admins

## Suggested Commit Plan

Suggested early commits:

- `chore: initialize laravel skeleton for neonjudge`
- `feat: add shared blade layout and neon theme`
- `feat: add home page`
- `feat: add contest list and contest detail pages`
- `feat: add practice and problem detail pages`
- `feat: add submission verdict ui`
- `feat: add leaderboard and dashboard pages`
- `feat: add setter and admin panels`
