@extends('layout')

@section('title', 'Edit Category - ' . $category->name)

@section('content')
<div class="container" style="margin-top: 100px;">
    <!-- Header Section -->
    <div class="section-header">
        <h1 class="section-title">✏️ Edit Category</h1>
        <p class="section-subtitle">Update the category information and image</p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <div>
                <h4>Please fix the following errors:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="form-container">
        <form action="{{ route('updateCategory', $category->id) }}" method="POST" enctype="multipart/form-data" class="modern-form">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 3h18v18H3zM21 9H3M21 15H3M12 3v18"/>
                        </svg>
                        Category Name *
                    </label>
                    <input type="text" id="name" name="name" class="form-input" 
                           value="{{ old('name', $category->name) }}" 
                           placeholder="Enter the category name..."
                           required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21,15 16,10 5,21"></polyline>
                        </svg>
                        Category Image
                    </label>
                    
                    @if($category->image)
                        <div class="current-image">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Current image" class="preview-image">
                            <span class="current-label">Current Image</span>
                        </div>
                    @endif
                    
                    <div class="file-upload-container">
                        <input type="file" name="image" id="image" class="file-input" 
                               accept="image/*" onchange="previewImage(this)">
                        <div class="file-upload-area" id="imagePreview">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21,15 16,10 5,21"></polyline>
                            </svg>
                            <p>Click to upload new category image</p>
                            <span>Supports: JPG, PNG, GIF (Max: 5MB)</span>
                        </div>
                    </div>
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="form-label">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10,9 9,9 8,9"></polyline>
                    </svg>
                    Description *
                </label>
                <textarea name="desc" id="desc" class="form-textarea" 
                          placeholder="Enter a detailed description of the category..."
                          rows="5" required>{{ old('desc', $category->desc) }}</textarea>
                @error('desc')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="history.back()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4"></path>
                        <path d="M21 12c-1 0-2-1-2-2s1-2 2-2 2 1 2 2-1 2-2 2z"></path>
                        <path d="M3 12c1 0 2-1 2-2s-1-2-2-2-2 1-2 2 1 2 2 2z"></path>
                        <path d="M12 3c0 1-1 2-2 2s-2 1-2 2 1 2 2 2 2 1 2 2 1-2 2-2 2-1 2-2-1-2-2-2-2-1-2-2z"></path>
                    </svg>
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    background: var(--bg-primary);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.modern-form {
    padding: 32px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1rem;
}

.form-label svg {
    color: var(--accent-primary);
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 16px;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    background: var(--bg-primary);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
}

.current-image {
    margin-bottom: 16px;
    padding: 16px;
    background: var(--bg-secondary);
    border-radius: 12px;
    border: 1px solid var(--border-color);
    text-align: center;
}

.preview-image {
    max-width: 100%;
    max-height: 150px;
    border-radius: 8px;
    margin-bottom: 8px;
}

.current-label {
    font-size: 0.875rem;
    color: var(--text-muted);
    font-weight: 500;
}

.file-upload-container {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
}

.file-upload-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 24px;
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    background: var(--bg-secondary);
    color: var(--text-secondary);
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 140px;
}

.file-upload-area:hover {
    border-color: var(--accent-primary);
    background: var(--bg-tertiary);
}

.file-upload-area svg {
    margin-bottom: 12px;
    color: var(--text-muted);
}

.file-upload-area p {
    margin: 8px 0;
    font-weight: 500;
    color: var(--text-primary);
}

.file-upload-area span {
    font-size: 0.875rem;
    color: var(--text-muted);
}

.file-preview {
    border: 2px solid var(--accent-primary);
    background: var(--bg-primary);
}

.file-preview img {
    max-width: 100%;
    max-height: 120px;
    border-radius: 8px;
    object-fit: cover;
}

.file-preview .file-info {
    margin-top: 12px;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.form-actions {
    display: flex;
    gap: 16px;
    justify-content: flex-end;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--border-color);
}

.error-message {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 8px;
    display: block;
}

.alert {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-weight: 500;
}

.alert-danger {
    background: var(--danger);
    color: white;
}

.alert-danger ul {
    margin: 8px 0 0 20px;
}

@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .modern-form {
        padding: 24px;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .form-actions .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];
    
    if (file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 120px; border-radius: 8px; object-fit: cover;">
                    <div class="file-info">
                        <strong>${file.name}</strong><br>
                        <span>${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                    </div>
                `;
                preview.classList.add('file-preview');
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
            input.value = '';
        }
    }
}

// Add form validation
document.querySelector('.modern-form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const desc = document.getElementById('desc').value.trim();
    
    if (!name || !desc) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return false;
    }
    
    // Show loading state
    const submitBtn = e.target.querySelector('button[type="submit"]');
    submitBtn.innerHTML = `
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="animate-spin">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 6v6l4 2"></path>
        </svg>
        Updating Category...
    `;
    submitBtn.disabled = true;
});

// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const formElements = document.querySelectorAll('.form-group');
    formElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection