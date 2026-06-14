# NeonJudge

NeonJudge is a university database course project skeleton for an Online Judge system. This first version focuses on a professional Laravel + Blade interface with mock data, clean navigation, and presentation-ready pages for contests, problems, submissions, verdicts, leaderboard, practice, setter tools, admin approval, and database design.

## Project Overview

The project demonstrates how a database-driven Online Judge can be structured before building the complex judging engine. Controllers currently use demo arrays, and comments mark where real MySQL queries, relationships, procedures, triggers, views, and reports will be added later.

## Core Features

- Home page with hero, feature cards, and database feature summary
- Public contest list with status and approval state
- Contest details with problem list, score, time limit, and memory limit
- Practice problems with search, difficulty filtering, and sorting
- Problem details with statement, samples, constraints, and submit button
- Submission form with JavaScript-based simulated verdict
- Leaderboard with score and penalty sorting
- User dashboard with rating, solves, progress, and recommendations
- Problem setter panel with create problem form UI
- Admin panel with contest approval, suspicious submissions, and reports
- Database Design page explaining main entities and planned SQL features

## Technology Stack

- Laravel with PHP
- Blade templates
- HTML, CSS, JavaScript
- MySQL-ready structure
- Demo/mock data for first version

## Installation Steps

```bash
composer install
copy .env.example .env
D:\xampp\php\php.exe artisan key:generate
D:\xampp\php\php.exe artisan serve
```

Open the local URL shown by Laravel, usually:

```bash
http://127.0.0.1:8000
```

If PHP is already in your PATH, you can use `php artisan ...` instead of `D:\xampp\php\php.exe artisan ...`.

## Demo User Roles

- Student: browses contests, solves practice problems, submits code, views dashboard
- Problem Setter: creates problems, drafts contests, adds problems to contests
- Admin: approves contests, monitors suspicious submissions, reviews reports
- Teacher Reviewer: checks system flow and database design explanation

## Planned Database Features

- SQL schema for users, contests, problems, contest problems, submissions, languages, leaderboard, practice records, and rating history
- Primary keys, foreign keys, unique constraints, and check constraints
- Triggers for leaderboard updates and audit logs
- PL/SQL procedures/functions for verdict aggregation, reports, and rating updates
- Views for leaderboard, user progress, contest summary, and admin reports
- Indexing strategy for submissions, contest rankings, and problem search
- Report queries for most solved problems, most active users, contests created, and total submissions

## Presentation Flow

1. Show Home Page and explain project purpose.
2. Show Contest List and contest status.
3. Open Contest Details and explain score, time limit, and problems.
4. Show Submission Page and simulated live verdict.
5. Show Leaderboard and explain score and penalty.
6. Show Practice Page and difficulty/rating-based filtering.
7. Show Problem Setter Panel and explain problem/contest creation.
8. Show Admin Panel and explain contest approval and monitoring.
9. Show Database Design page and explain SQL/PLSQL features.

## Future Improvements

- Add authentication and role-based middleware
- Convert mock arrays into Eloquent models and MySQL tables
- Add migrations, seeders, and ER diagram
- Implement real submission storage and judge queue
- Add admin audit logs and approval history
- Add problem tags, test case management, and setter review workflow
- Add downloadable reports for teachers/admins

## Suggested Commit Plan

This version is intentionally small enough to split into many commits later. Suggested early commits:

- `chore: initialize laravel skeleton for neonjudge`
- `feat: add shared blade layout and neon theme`
- `feat: add home page for project presentation`
- `feat: add contest list and contest detail demo pages`
- `feat: add practice and problem detail pages`
- `feat: add simulated submission verdict ui`
- `feat: add leaderboard and dashboard demos`
- `feat: add setter and admin panels`
- `docs: add database design and presentation flow`
