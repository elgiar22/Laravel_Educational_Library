# 📚 Laravel Books Management System

A comprehensive digital library management system built with Laravel 12, featuring advanced roles and permissions, modern UI/UX design with dark mode support, and robust book management capabilities.

## 🌟 Features

### 🔐 **Advanced Roles & Permissions System**
- **Guest**: Can view books and categories only
- **User**: Can read and download books
- **Author**: Can create, edit, and manage their own books
- **Admin**: Full system access and control

### 📖 **Book Management**
- Create, edit, delete books with PDF file uploads
- Categorize books by categories
- Advanced search and filter functionality
- Read books online with PDF viewer
- Download books (permission-based)
- Author-specific book management (My Books)

### 🏷️ **Category Management**
- Create and manage book categories
- Admin-only category management
- Category-based book organization and filtering

### 👥 **User Management**
- User registration and authentication
- Role-based access control with middleware
- Admin user management panel
- Profile editing with role management
- Password reset functionality

### 🎨 **Modern UI/UX Design**
- **Dark Mode Support** 🌙
- Responsive design for all devices
- Glassmorphism effects and modern styling
- Smooth animations and transitions
- Modern card-based layouts
- Interactive role selection interface

### 📊 **Admin Dashboard**
- Statistics overview
- User management interface
- Book management tools
- Category management
- Quick action cards

### 🔍 **Advanced Search**
- Search books by title, author, description
- Filter by categories
- Real-time search results
- Advanced search interface

## 🚀 **Quick Start**

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/laravel-books-management.git
cd laravel-books-management
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
DB_DATABASE=laravel_books_management
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

- **Backend**: Laravel 12
- **Frontend**: Blade Templates, Bootstrap 5
- **Database**: MySQL/PostgreSQL
- **Authentication**: Custom Auth System
- **File Storage**: Laravel Storage
- **Styling**: Custom CSS with CSS Variables
- **JavaScript**: Vanilla JS for interactions
- **PDF Handling**: Browser-based PDF viewer

## 📁 **Project Structure**

```
laravel-books-management/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Admin dashboard and user management
│   │   ├── AuthController.php      # Authentication and password reset
│   │   ├── BookController.php      # Book CRUD operations
│   │   ├── CategoryController.php  # Category management
│   │   ├── HomeController.php      # Home page controller
│   │   └── Controller.php          # Base controller
│   ├── Models/
│   │   ├── Book.php                # Book model with relationships
│   │   ├── Category.php            # Category model
│   │   └── User.php                # User model with roles
│   └── Http/Middleware/
│       └── CheckPermission.php     # Custom permission middleware
├── resources/views/
│   ├── Admin/
│   │   ├── dashboard.blade.php     # Admin dashboard
│   │   ├── editUser.blade.php      # User editing interface
│   │   └── author-requests/        # Author request management
│   ├── Books/
│   │   ├── all.blade.php           # All books listing
│   │   ├── create.blade.php        # Book creation form
│   │   ├── edit.blade.php          # Book editing form
│   │   ├── mybooks.blade.php       # Author's books
│   │   └── show.blade.php          # Book details view
│   ├── Categories/
│   │   ├── all.blade.php           # All categories listing
│   │   ├── create.blade.php        # Category creation form
│   │   ├── edit.blade.php          # Category editing form
│   │   └── show.blade.php          # Category details view
│   ├── auth/
│   │   ├── login.blade.php         # Login form
│   │   ├── register.blade.php      # Registration form
│   │   ├── forgot-password.blade.php # Password reset request
│   │   └── reset-password.blade.php # Password reset form
│   ├── components/                 # Reusable Blade components
│   ├── layout.blade.php            # Main layout template
│   ├── home.blade.php              # Home page
│   ├── search.blade.php            # Search interface
│   └── welcome.blade.php           # Welcome page
├── public/
│   ├── css/
│   │   ├── style.css               # Main stylesheet
│   │   ├── advanced.css            # Advanced styling
│   │   └── shared.css              # Shared styles
│   ├── js/
│   │   ├── script.js               # Main JavaScript
│   │   └── bootstrap.min.js        # Bootstrap JavaScript
│   └── storage/                    # File storage
└── database/
    ├── migrations/                 # Database migrations
    └── seeders/                    # Database seeders
```

## 🔧 **Key Features Implementation**

### **Roles & Permissions System**
- Custom middleware for permission checking
- Role-based route protection
- Dynamic permission checking in views
- Flexible permission system with granular control

### **File Management**
- Secure PDF file uploads with validation
- File storage configuration
- Download protection based on user permissions
- Browser-based PDF viewer for reading

### **Search & Filtering**
- Advanced search functionality
- Category-based filtering
- Real-time search results
- Responsive search interface

### **UI/UX Design**
- CSS Variables for theming
- Dark mode toggle with persistent preference
- Responsive grid layouts
- Modern animations and transitions
- Glassmorphism effects
- Mobile-first design approach

## 🚀 **API Endpoints**

### Authentication
- `GET /register` - Registration form
- `POST /register` - User registration
- `GET /login` - Login form
- `POST /login` - User login
- `POST /logout` - User logout
- `GET /forgot-password` - Password reset request form
- `POST /forgot-password` - Send password reset email
- `GET /reset-password/{token}` - Password reset form
- `POST /reset-password` - Reset password

### Books
- `GET /Books` - View all books
- `GET /Books/show/{id}` - View book details
- `GET /Books/create` - Create book form (Author/Admin)
- `POST /Books` - Store new book (Author/Admin)
- `GET /Books/edit/{id}` - Edit book form (Author/Admin)
- `PUT /Books/update/{id}` - Update book (Author/Admin)
- `DELETE /Books/{id}` - Delete book (Author/Admin)
- `GET /Books/mybooks` - Author's books (Author)
- `GET /books/read/{book}` - Read book (User+)
- `GET /books/download/{book}` - Download book (User+)

### Categories
- `GET /categories` - View all categories
- `GET /categories/show/{id}` - View category details
- `GET /categories/create` - Create category form (Admin)
- `POST /categories` - Store new category (Admin)
- `GET /categories/edit/{id}` - Edit category form (Admin)
- `PUT /categories/update/{id}` - Update category (Admin)
- `DELETE /categories/{id}` - Delete category (Admin)

### Admin
- `GET /admin/dashboard` - Admin dashboard
- `GET /users/edit/{user}` - Edit user form
- `PUT /users/update/{user}` - Update user
- `DELETE /users/{user}` - Delete user

### Search
- `GET /search` - Search books

## 🔒 **Security Features**

- CSRF protection on all forms
- Input validation and sanitization
- File upload security
- Role-based access control
- Secure password hashing
- SQL injection prevention
- XSS protection

## 🎨 **Customization**

### Styling
The application uses CSS variables for easy theming. Main variables are defined in `public/css/style.css`:

```css
:root {
  --primary-color: #007bff;
  --secondary-color: #6c757d;
  --background-color: #ffffff;
  --text-color: #333333;
  /* Add more variables as needed */
}
```

### Dark Mode
Dark mode is implemented with CSS variables and JavaScript toggle functionality.

## 🧪 **Testing**

Run the test suite:
```bash
php artisan test
```

## 📦 **Deployment**

### Production Setup
1. Set environment to production
2. Optimize for production:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
npm run build
```

### File Permissions
Ensure proper file permissions:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

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

**Made with ❤️ using Laravel 12**

## 📞 **Support**

For support and questions, please open an issue on GitHub or contact the development team.

## 🔄 **Changelog**

See [CHANGELOG.md](CHANGELOG.md) for a list of changes and updates.
