# 📚 Laravel Library Management System

A comprehensive library management system built with Laravel 11, featuring advanced roles and permissions, modern UI/UX design, and dark mode support.

## 🌟 Features

### 🔐 **Advanced Roles & Permissions System**
- **Guest**: Can view books only
- **User**: Can read and download books
- **Author**: Can create, edit, and manage their own books
- **Admin**: Full system access and control

### 📖 **Book Management**
- Create, edit, delete books
- Upload PDF files
- Categorize books
- Search and filter functionality
- Download and read books

### 🏷️ **Category Management**
- Create and manage book categories
- Admin-only category management
- Category-based book organization

### 👥 **User Management**
- User registration and authentication
- Role-based access control
- Admin user management panel
- Profile editing with role management

### 🎨 **Modern UI/UX Design**
- **Dark Mode Support** 🌙
- Responsive design for all devices
- Glassmorphism effects
- Smooth animations and transitions
- Modern card-based layouts
- Interactive role selection

### 📊 **Admin Dashboard**
- Statistics overview
- User management
- Book management
- Category management
- Quick action cards

## 🚀 **Quick Start**

### Prerequisites
- PHP 8.1+
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/laravel-library.git
cd laravel-library
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_library
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build assets**
```bash
npm run build
```

7. **Start the server**
```bash
php artisan serve
```

Visit `http://localhost:8000` to see your application!

## 👤 **Default Users**

After running the seeders, you'll have these default users:

- **Admin**: admin@example.com / password
- **Author**: author@example.com / password
- **User**: user@example.com / password

## 🛠️ **Technology Stack**

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap 5
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage
- **Styling**: Custom CSS with CSS Variables
- **JavaScript**: Vanilla JS for interactions

## 📁 **Project Structure**

```
laravel-library/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── BookController.php
│   │   └── CategoryController.php
│   ├── Models/
│   │   ├── Book.php
│   │   ├── Category.php
│   │   └── User.php
│   └── Http/Middleware/
│       └── CheckPermission.php
├── resources/views/
│   ├── Admin/
│   │   ├── dashboard.blade.php
│   │   └── editUser.blade.php
│   ├── Books/
│   │   ├── all.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   ├── mybooks.blade.php
│   │   └── show.blade.php
│   └── Categories/
│       ├── all.blade.php
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── show.blade.php
└── database/
    ├── migrations/
    └── seeders/
```

## 🔧 **Key Features Implementation**

### **Roles & Permissions**
- Custom middleware for permission checking
- Role-based route protection
- Dynamic permission checking in views
- Flexible permission system

### **File Management**
- Secure file uploads
- File validation
- Storage configuration
- Download protection

### **UI/UX Design**
- CSS Variables for theming
- Dark mode toggle
- Responsive grid layouts
- Modern animations
- Glassmorphism effects

## 🤝 **Contributing**

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 **Acknowledgments**

- Laravel team for the amazing framework
- Bootstrap team for the UI components
- All contributors and supporters

---

**Made with ❤️ using Laravel 11**
