# HRMS - Human Resource Management System

A complete web-based Human Resource Management System built with PHP and MySQL.

## ✅ What's Included

### Core Features
- ✅ **User Authentication** - Secure login and registration system
- ✅ **Role-based Access Control** - Admin, HR, and Employee roles
- ✅ **Employee Management** - Add, view, and manage employees
- ✅ **Attendance System** - Check-in/Check-out with work hours tracking
- ✅ **Leave Management** - Apply and approve/reject leave applications
- ✅ **Payroll** - Salary structure and management
- ✅ **Dashboards** - Role-specific dashboards with analytics
- ✅ **Profile Management** - Employee profiles and details

## 🔧 Setup Instructions

### Prerequisites
- XAMPP (Apache + MySQL + PHP)
- PHP 8.0+
- MySQL 5.7+
- Web Browser

### Installation Steps

1. **Database Setup**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `hrms_db`
   - Import the SQL file: `database/hrms_db.sql` or the downloaded `hrms_db.sql`

2. **Start XAMPP Services**
   - Start Apache
   - Start MySQL

3. **Verify Database Connection**
   - Check that `config/db.php` has correct credentials:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "hrms_db");
   ```

4. **Access the Application**
   - Open browser and go to: `http://localhost/hrms/`
   - You will be redirected to login page

## 👤 Default Credentials

```
Email: admin@demo.com
Password: password
Role: Admin
```

## 📋 Default Admin User

The system comes with a pre-configured admin account:
- **Email**: admin@demo.com
- **Password**: password (already hashed in database)
- **Role**: Admin

## 🚀 Quick Start

### Login
1. Go to http://localhost/hrms/
2. Enter credentials (admin@demo.com / password)
3. Click Login

### Register New Company
1. Click "Register here" on login page
2. Fill in company details
3. Create admin account
4. You'll be automatically logged in

### Employee Functions (After Login)
- View Dashboard
- Check In/Check Out (Attendance)
- Apply for Leaves
- View Salary Information
- Update Profile

### Admin/HR Functions
- Manage Employees
- View/Manage Attendance
- Review & Approve Leaves
- Manage Payroll
- View Company Analytics

## 📁 Project Structure

```
hrms/
├── admin/                 # Admin panel pages
│   ├── dashboard.php
│   ├── employees.php
│   ├── add_employee.php
│   ├── attendance.php
│   ├── leaves.php
│   └── payroll.php
├── employee/             # Employee panel pages
│   ├── dashboard.php
│   ├── attendance.php
│   ├── leaves.php
│   ├── salary.php
│   └── profile.php
├── hr/                   # HR panel pages
│   ├── dashboard.php
│   ├── attendance.php
│   └── leaves.php
├── auth/                 # Authentication files
│   ├── login.php
│   ├── register.php
│   ├── login_process.php
│   ├── register_process.php
│   ├── logout.php
│   └── auth_check.php
├── attendance/           # Attendance logic
│   ├── checkin.php
│   ├── checkout.php
├── leave/                # Leave management
│   ├── apply_leave.php
│   └── leave_action.php
├── config/
│   └── db.php           # Database configuration
├── includes/
│   ├── header.php       # Common header
│   └── footer.php       # Common footer
├── assets/
│   ├── css/             # Stylesheets
│   ├── js/              # JavaScript files
│   └── images/          # Images and logos
└── index.php            # Main entry point
```

## 🗄️ Database Schema

### Users Table
- User authentication and profile information
- Roles: admin, hr, employee
- Email verification status

### Attendance Table
- Check-in/Check-out times
- Work hours calculation
- Status (present, absent, halfday, leave)

### Leaves Table
- Leave applications
- Leave types: paid, sick, unpaid
- Status: pending, approved, rejected

### Salary Table
- Salary structure (basic, HRA, allowance)
- Deductions (PF, tax)
- Gross and net calculations

### Employee_Details Table
- Department and designation
- Manager assignment
- Location and join date

## 🔒 Security Features

✅ Password Hashing (BCrypt)
✅ SQL Injection Prevention (mysqli_real_escape_string)
✅ Session Management
✅ Auth Check on Protected Pages
✅ Role-based Access Control
✅ CSRF Protection with Session Verification

## 🎨 UI Features

- Modern Bootstrap 5 Design
- Responsive Layout (Mobile-friendly)
- Gradient Navigation Bar
- Card-based Dashboard
- Data Tables with Sorting
- Alert Messages for Feedback
- Icon Integration (Bootstrap Icons)

## 📝 Common Tasks

### Add New Employee
1. Login as Admin
2. Go to Employees → Add Employee
3. Fill in details (First Name, Last Name, Email, Password)
4. Optionally add Department and Designation
5. Click "Add Employee"

### Check In/Out
1. Login as Employee
2. Go to Attendance
3. Click "Checkin" button (Morning)
4. Click "Checkout" button (Evening)
5. System calculates work hours automatically

### Apply for Leave
1. Login as Employee
2. Go to My Leaves
3. Click "Apply Leave"
4. Select leave type, dates, and reason
5. Submit application

### Approve Leaves
1. Login as Admin/HR
2. Go to Leaves → Pending tab
3. Review applications
4. Click "Approve" or "Reject"

## 🐛 Troubleshooting

### Issue: "DB Connection Failed"
**Solution**: 
- Check if MySQL is running
- Verify database name in config/db.php (should be `hrms_db`)
- Ensure database is imported correctly

### Issue: "Invalid login"
**Solution**:
- Check if database was imported (look for users table)
- Verify default admin account exists
- Try default credentials: admin@demo.com / password

### Issue: Images not showing
**Solution**:
- Check /assets/images directory exists
- Default profile uses initials, so images are optional

### Issue: Attendance checkout not working
**Solution**:
- Make sure check-in happened first
- Check if today's date matches system date
- Verify attendance table in database

## 📞 Support

For issues or improvements, check:
1. Database connection in `config/db.php`
2. Ensure all files are in correct directories
3. Check PHP error logs in XAMPP
4. Verify MySQL is running

## 📝 Notes

- System uses 24-hour format for time
- Dates follow YYYY-MM-DD format
- Work hours < 4 hours = Half Day
- All monetary values are in default currency (₹)
- System automatically logs out inactive sessions

## 🔄 Version Info

- **Version**: 1.0
- **Last Updated**: January 3, 2026
- **PHP Version**: 8.0+
- **MySQL Version**: 5.7+
- **Bootstrap**: 5.3.2

---

**Happy HR Management!** 🎉
