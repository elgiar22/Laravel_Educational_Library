@extends('layout')

@section('title', 'Edit User - Admin Dashboard')

@section('content')
<div class="edit-user-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </div>
                        <div class="header-text">
                            <h1>Edit User Profile</h1>
                            <p>Update user information and manage permissions</p>
                        </div>
                    </div>
                    <div class="header-actions">
                        <button class="theme-toggle" id="themeToggle">
                            <svg class="sun-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                            <svg class="moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                            </svg>
                        </button>
                        <a href="{{ route('dashboard') }}" class="back-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5M12 19l-7-7 7-7"/>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>

                <!-- User Info Card -->
                <div class="user-info-card">
                    <div class="user-avatar">
                        <div class="avatar-ring"></div>
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="user-details">
                        <h3>{{ $user->name }}</h3>
                        <p class="user-email">{{ $user->email }}</p>
                        <div class="role-info">
                            <span class="role-badge role-{{ $user->role }}">
                                {{ $user->getRoleDisplayName() }}
                            </span>
                            <span class="role-description">
                                @if($user->role === 'user')
                                    Can read and download books
                                @elseif($user->role === 'author')
                                    Can create and manage books
                                @else
                                    Full system access and control
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Form Card -->
                <div class="edit-form-card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <div class="alert-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4"></path>
                                    <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"></path>
                                </svg>
                            </div>
                            <div class="alert-content">
                                <h4>Success!</h4>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <div class="alert-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </div>
                            <div class="alert-content">
                                <h4>Please fix the following errors:</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST" class="edit-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <h4>Basic Information</h4>
                                <p>Update user's personal details</p>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                        </svg>
                                        Full Name
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    <div class="form-hint">Enter the user's full name as it should appear</div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        Email Address
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    <div class="form-hint">This email will be used for login and notifications</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <h4>User Role & Permissions</h4>
                                <p>Manage user access and capabilities</p>
                            </div>
                            
                            <div class="form-group">
                                <label for="role" class="form-label">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    User Role
                                </label>
                                <div class="role-selector">
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                            👤 User - Can read and download books
                                        </option>
                                        <option value="author" {{ $user->role === 'author' ? 'selected' : '' }}>
                                            ✍️ Author - Can create and manage books
                                        </option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                            👑 Admin - Full system access
                                        </option>
                                    </select>
                                    <div class="role-preview">
                                        <div class="role-card role-user" id="role-preview-user">
                                            <div class="role-icon">👤</div>
                                            <div class="role-content">
                                                <h5>User</h5>
                                                <p>Can read and download books</p>
                                            </div>
                                        </div>
                                        <div class="role-card role-author" id="role-preview-author">
                                            <div class="role-icon">✍️</div>
                                            <div class="role-content">
                                                <h5>Author</h5>
                                                <p>Can create and manage books</p>
                                            </div>
                                        </div>
                                        <div class="role-card role-admin" id="role-preview-admin">
                                            <div class="role-icon">👑</div>
                                            <div class="role-content">
                                                <h5>Admin</h5>
                                                <p>Full system access and control</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="history.back()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4"></path>
                                    <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"></path>
                                </svg>
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --bg-primary: #ffffff;
    --bg-secondary: rgba(255, 255, 255, 0.95);
    --bg-tertiary: rgba(247, 250, 252, 0.8);
    --text-primary: #2d3748;
    --text-secondary: #4a5568;
    --text-muted: #718096;
    --text-hint: #a0aec0;
    --border-color: #e2e8f0;
    --shadow-light: rgba(0, 0, 0, 0.1);
    --shadow-medium: rgba(0, 0, 0, 0.15);
    --shadow-heavy: rgba(0, 0, 0, 0.2);
    --success-bg: linear-gradient(135deg, #f0fff4 0%, #c6f6d5 100%);
    --success-color: #22543d;
    --success-border: #9ae6b4;
    --danger-bg: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
    --danger-color: #742a2a;
    --danger-border: #feb2b2;
    --user-bg: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
    --user-color: #234e52;
    --user-border: #81e6d9;
    --author-bg: linear-gradient(135deg, #fef5e7 0%, #fed7aa 100%);
    --author-color: #744210;
    --author-border: #f6ad55;
    --admin-bg: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
    --admin-color: #742a2a;
    --admin-border: #fc8181;
}

[data-theme="dark"] {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --bg-primary: #1a202c;
    --bg-secondary: rgba(26, 32, 44, 0.95);
    --bg-tertiary: rgba(45, 55, 72, 0.8);
    --text-primary: #f7fafc;
    --text-secondary: #e2e8f0;
    --text-muted: #a0aec0;
    --text-hint: #718096;
    --border-color: #4a5568;
    --shadow-light: rgba(0, 0, 0, 0.3);
    --shadow-medium: rgba(0, 0, 0, 0.4);
    --shadow-heavy: rgba(0, 0, 0, 0.5);
    --success-bg: linear-gradient(135deg, #1a4731 0%, #2d5a3f 100%);
    --success-color: #9ae6b4;
    --success-border: #48bb78;
    --danger-bg: linear-gradient(135deg, #742a2a 0%, #9b2c2c 100%);
    --danger-color: #feb2b2;
    --danger-border: #f56565;
    --user-bg: linear-gradient(135deg, #1a4731 0%, #2d5a3f 100%);
    --user-color: #9ae6b4;
    --user-border: #48bb78;
    --author-bg: linear-gradient(135deg, #744210 0%, #9b5a1a 100%);
    --author-color: #fed7aa;
    --author-border: #f6ad55;
    --admin-bg: linear-gradient(135deg, #742a2a 0%, #9b2c2c 100%);
    --admin-color: #feb2b2;
    --admin-border: #f56565;
}

.edit-user-container {
    padding: 6rem 0 2rem 0;
    background: var(--primary-gradient);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

.edit-user-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    background: var(--bg-secondary);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 8px 32px var(--shadow-light);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary-gradient);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.header-icon {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.header-text h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-text p {
    margin: 0;
    color: var(--text-muted);
    font-size: 1rem;
    font-weight: 500;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.theme-toggle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: var(--bg-tertiary);
    border: 2px solid var(--border-color);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.theme-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px var(--shadow-light);
    border-color: var(--text-secondary);
}

.theme-toggle .sun-icon,
.theme-toggle .moon-icon {
    transition: all 0.3s ease;
}

.theme-toggle .sun-icon {
    opacity: 1;
    transform: rotate(0deg);
}

.theme-toggle .moon-icon {
    opacity: 0;
    transform: rotate(-90deg);
    position: absolute;
}

[data-theme="dark"] .theme-toggle .sun-icon {
    opacity: 0;
    transform: rotate(90deg);
}

[data-theme="dark"] .theme-toggle .moon-icon {
    opacity: 1;
    transform: rotate(0deg);
}

.back-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: var(--bg-tertiary);
    color: var(--text-secondary);
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    backdrop-filter: blur(10px);
}

.back-btn:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px var(--shadow-light);
    border-color: var(--border-color);
}

.user-info-card {
    background: var(--bg-secondary);
    backdrop-filter: blur(10px);
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 8px 32px var(--shadow-light);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.user-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary-gradient);
    background-size: 200% 100%;
    animation: shimmer 3s infinite;
}

.user-avatar {
    position: relative;
    background: var(--primary-gradient);
    color: white;
    padding: 1.5rem;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.avatar-ring {
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    border: 3px solid rgba(102, 126, 234, 0.3);
    border-radius: 50%;
    animation: rotate 3s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.user-details h3 {
    margin: 0 0 0.75rem 0;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
}

.user-email {
    margin: 0 0 1.5rem 0;
    color: var(--text-muted);
    font-size: 1.1rem;
    font-weight: 500;
}

.role-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.role-badge {
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    width: fit-content;
    box-shadow: 0 4px 15px var(--shadow-light);
}

.role-user {
    background: var(--user-bg);
    color: var(--user-color);
    border: 2px solid var(--user-border);
}

.role-author {
    background: var(--author-bg);
    color: var(--author-color);
    border: 2px solid var(--author-border);
}

.role-admin {
    background: var(--admin-bg);
    color: var(--admin-color);
    border: 2px solid var(--admin-border);
}

.role-description {
    color: var(--text-muted);
    font-size: 0.9rem;
    font-weight: 500;
}

.edit-form-card {
    background: var(--bg-secondary);
    backdrop-filter: blur(10px);
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 8px 32px var(--shadow-light);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    font-weight: 500;
    border: 2px solid transparent;
}

.alert-icon {
    flex-shrink: 0;
    padding: 0.5rem;
    border-radius: 8px;
}

.alert-success {
    background: var(--success-bg);
    color: var(--success-color);
    border-color: var(--success-border);
}

.alert-success .alert-icon {
    background: #48bb78;
    color: white;
}

.alert-danger {
    background: var(--danger-bg);
    color: var(--danger-color);
    border-color: var(--danger-border);
}

.alert-danger .alert-icon {
    background: #f56565;
    color: white;
}

.alert-content h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.alert-content p,
.alert-content ul {
    margin: 0;
    font-size: 0.95rem;
}

.form-section {
    margin-bottom: 3rem;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.section-icon {
    background: var(--primary-gradient);
    color: white;
    padding: 0.75rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}

.section-header h4 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-primary);
}

.section-header p {
    margin: 0;
    color: var(--text-muted);
    font-size: 0.95rem;
    font-weight: 500;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 1rem;
}

.form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--bg-tertiary);
    backdrop-filter: blur(10px);
    color: var(--text-primary);
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    background: var(--bg-primary);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-hint {
    margin-top: 0.5rem;
    font-size: 0.85rem;
    color: var(--text-hint);
    font-weight: 500;
}

select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}

.role-selector {
    position: relative;
}

.role-preview {
    margin-top: 1.5rem;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

.role-card {
    padding: 1.5rem;
    border-radius: 12px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    cursor: pointer;
    text-align: center;
    opacity: 0.6;
    transform: scale(0.95);
    background: var(--bg-tertiary);
    backdrop-filter: blur(10px);
}

.role-card.active {
    opacity: 1;
    transform: scale(1);
    border-color: #667eea;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
}

.role-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px var(--shadow-light);
}

.role-icon {
    font-size: 2rem;
    margin-bottom: 0.75rem;
}

.role-content h5 {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.role-content p {
    margin: 0;
    font-size: 0.85rem;
    color: var(--text-muted);
}

.form-actions {
    display: flex;
    gap: 1.5rem;
    justify-content: flex-end;
    padding-top: 2.5rem;
    border-top: 2px solid var(--border-color);
    margin-top: 2rem;
}

.btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: var(--primary-gradient);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
}

.btn-secondary {
    background: var(--bg-tertiary);
    color: var(--text-secondary);
    border: 2px solid var(--border-color);
    backdrop-filter: blur(10px);
}

.btn-secondary:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px var(--shadow-light);
}

@media (max-width: 768px) {
    .edit-user-container {
        padding: 5rem 0 2rem 0;
    }
    
    .page-header {
        flex-direction: column;
        gap: 1.5rem;
        text-align: center;
        padding: 1.5rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 1rem;
    }
    
    .user-info-card {
        flex-direction: column;
        text-align: center;
        padding: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .role-preview {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .header-text h1 {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const roleCards = document.querySelectorAll('.role-card');
    const themeToggle = document.getElementById('themeToggle');
    
    // Theme toggle functionality
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    }
    
    // Initialize theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
    
    themeToggle.addEventListener('click', toggleTheme);
    
    // Role preview functionality
    function updateRolePreview() {
        const selectedRole = roleSelect.value;
        
        roleCards.forEach(card => {
            card.classList.remove('active');
        });
        
        const activeCard = document.getElementById(`role-preview-${selectedRole}`);
        if (activeCard) {
            activeCard.classList.add('active');
        }
    }
    
    roleSelect.addEventListener('change', updateRolePreview);
    updateRolePreview();
    
    // Add click handlers to role cards
    roleCards.forEach(card => {
        card.addEventListener('click', function() {
            const role = this.id.replace('role-preview-', '');
            roleSelect.value = role;
            updateRolePreview();
        });
    });
});
</script>
@endsection
