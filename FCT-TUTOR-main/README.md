# FCT-TUTOR (Local XAMPP PHP project)

This project is a simple student/tutor registration and login site built with PHP and MySQL (designed for XAMPP local development).

## Quick setup

1. Start XAMPP (Apache + MySQL).
2. Import the database schema:
   - Open phpMyAdmin (http://localhost/phpmyadmin), import `db_schema.sql`, or run the file from a shell:

```powershell
mysql -u root < "e:\Xampp\htdocs\FCT-TUTOR-main\db_schema.sql"
```

3. Ensure `dbconnect.php` has correct credentials (by default XAMPP uses `root` / no password and database name `fct_tutor`).

4. Open the app in your browser:
   - Registration start: `http://localhost/FCT-TUTOR-main/user_role.html`
   - Login: `http://localhost/FCT-TUTOR-main/login.php`

## What I changed
- Added friendly error display on `login.php`, `student_registration.html`, and `tutor_registration.html`.
- Fixed several issues in `functions_student.php` and `functions_tutor.php` to make signup/login behavior consistent.
- Added `logout.php` and `auth_check.php` (simple helper to protect pages).
- Added `db_schema.sql` containing the database schema and some seed data.

## Testing
- Register a student, then verify a row is added to the `student` table.
- Register a tutor, verify a row in the `tutor` table.
- Login using the registered username and password(s).
- Use `logout.php` to clear session.

## Next recommended improvements
- Move registration pages to `.php` to allow server-side message rendering (currently handled by JS).
- Add CSRF tokens and stronger validation.
- Add a central `auth` class to unify student/tutor handling and reduce duplication.
- Add unit tests and input sanitization.

If you'd like, I can:
- Implement server-side feedback rendering by converting registration pages to PHP.
- Add a `logout` link to `index.html` and convert `index.html` to `index.php` to show login status.
- Harden validation and add password-strength checks.

Tell me which next step you'd like me to take and I will continue.