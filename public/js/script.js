// Global state management
let currentLanguage = 'en';
let currentTheme = 'light';
let currentBooksPage = 1;
let currentCategoriesPage = 1;
const itemsPerPage = 6;

// Advanced search and filter state
let searchQuery = '';
let selectedCategory = '';
let sortBy = 'title';
let sortOrder = 'asc';

// Sample data
let books = [
    {
        id: 1,
        title: 'MATH 0f',
        author: 'Dr. Ahmed Hassan',
        category: 'math',
        description: 'Mathematical concepts and problem-solving techniques for advanced learners',
        image: 'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'الرياضيات المتقدمة',
        authorAr: 'د. أحمد حسن',
        descriptionAr: 'المفاهيم الرياضية وتقنيات حل المشكلات للمتعلمين المتقدمين',
        fileSize: '2.5 MB',
        downloadCount: 156,
        rating: 4.8
    },
    {
        id: 2,
        title: 'English Literature Classics',
        author: 'Sarah Johnson',
        category: 'english',
        description: 'A comprehensive collection of classic English literature works',
        image: 'https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'كلاسيكيات الأدب الإنجليزي',
        authorAr: 'سارة جونسون',
        descriptionAr: 'مجموعة شاملة من أعمال الأدب الإنجليزي الكلاسيكية',
        fileSize: '3.2 MB',
        downloadCount: 89,
        rating: 4.6
    },
    {
        id: 3,
        title: 'World History Chronicles',
        author: 'Prof. Michael Brown',
        category: 'history',
        description: 'Journey through the most significant events in world history',
        image: 'https://images.pexels.com/photos/3118934/pexels-photo-3118934.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'سجلات التاريخ العالمي',
        authorAr: 'البروفيسور مايكل براون',
        descriptionAr: 'رحلة عبر أهم الأحداث في التاريخ العالمي',
        fileSize: '4.1 MB',
        downloadCount: 234,
        rating: 4.9
    },
    {
        id: 4,
        title: 'Advanced Calculus',
        author: 'Dr. Lisa Chen',
        category: 'math',
        description: 'Deep dive into calculus concepts and applications',
        image: 'https://images.pexels.com/photos/6238297/pexels-photo-6238297.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'التفاضل والتكامل المتقدم',
        authorAr: 'د. ليزا تشين',
        descriptionAr: 'غوص عميق في مفاهيم وتطبيقات التفاضل والتكامل',
        fileSize: '5.8 MB',
        downloadCount: 178,
        rating: 4.7
    },
    {
        id: 5,
        title: 'Shakespeare Complete Works',
        author: 'William Shakespeare',
        category: 'english',
        description: 'The complete collection of Shakespeare\'s plays and sonnets',
        image: 'https://images.pexels.com/photos/256541/pexels-photo-256541.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'الأعمال الكاملة لشكسبير',
        authorAr: 'وليام شكسبير',
        descriptionAr: 'المجموعة الكاملة من مسرحيات وسونيتات شكسبير',
        fileSize: '6.2 MB',
        downloadCount: 445,
        rating: 5.0
    },
    {
        id: 6,
        title: 'Ancient Civilizations',
        author: 'Dr. Robert Wilson',
        category: 'history',
        description: 'Explore the rise and fall of ancient civilizations',
        image: 'https://images.pexels.com/photos/1903702/pexels-photo-1903702.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'الحضارات القديمة',
        authorAr: 'د. روبرت ويلسون',
        descriptionAr: 'استكشف صعود وسقوط الحضارات القديمة',
        fileSize: '3.7 MB',
        downloadCount: 167,
        rating: 4.5
    },
    {
        id: 7,
        title: 'Statistics and Probability',
        author: 'Dr. Maria Garcia',
        category: 'math',
        description: 'Comprehensive guide to statistical analysis and probability theory',
        image: 'https://images.pexels.com/photos/590020/pexels-photo-590020.jpg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'الإحصاء والاحتمالات',
        authorAr: 'د. ماريا غارسيا',
        descriptionAr: 'دليل شامل للتحليل الإحصائي ونظرية الاحتمالات',
        fileSize: '4.5 MB',
        downloadCount: 203,
        rating: 4.8
    },
    {
        id: 8,
        title: 'Modern Poetry Collection',
        author: 'Various Authors',
        category: 'english',
        description: 'A curated selection of contemporary poetry from around the world',
        image: 'https://images.pexels.com/photos/1370295/pexels-photo-1370295.jpeg?auto=compress&cs=tinysrgb&w=400',
        titleAr: 'مجموعة الشعر الحديث',
        authorAr: 'مؤلفون متنوعون',
        descriptionAr: 'مجموعة منتقاة من الشعر المعاصر من جميع أنحاء العالم',
        fileSize: '2.8 MB',
        downloadCount: 134,
        rating: 4.4
    }
];

let categories = [
    {
        id: 1,
        name: 'Mathematics',
        nameAr: 'الرياضيات',
        description: 'Explore numbers, equations, and mathematical concepts',
        descriptionAr: 'استكشف الأرقام والمعادلات والمفاهيم الرياضية',
        image: 'https://images.pexels.com/photos/6238297/pexels-photo-6238297.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 3,
        color: '#3b82f6'
    },
    {
        id: 2,
        name: 'English Literature',
        nameAr: 'الأدب الإنجليزي',
        description: 'Dive into classic and contemporary literature',
        descriptionAr: 'اغوص في الأدب الكلاسيكي والمعاصر',
        image: 'https://images.pexels.com/photos/256541/pexels-photo-256541.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 3,
        color: '#10b981'
    },
    {
        id: 3,
        name: 'History',
        nameAr: 'التاريخ',
        description: 'Journey through time and historical events',
        descriptionAr: 'رحلة عبر الزمن والأحداث التاريخية',
        image: 'https://images.pexels.com/photos/1903702/pexels-photo-1903702.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 2,
        color: '#f59e0b'
    },
    {
        id: 4,
        name: 'Science',
        nameAr: 'العلوم',
        description: 'Discover the wonders of scientific knowledge',
        descriptionAr: 'اكتشف عجائب المعرفة العلمية',
        image: 'https://images.pexels.com/photos/2280549/pexels-photo-2280549.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 0,
        color: '#8b5cf6'
    },
    {
        id: 5,
        name: 'Technology',
        nameAr: 'التكنولوجيا',
        description: 'Stay updated with the latest in technology',
        descriptionAr: 'ابق على اطلاع بأحدث التطورات التكنولوجية',
        image: 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 0,
        color: '#ef4444'
    }
];

// Initialize application
document.addEventListener('DOMContentLoaded', function() {
    initializeTheme();
    initializeLanguage();
    initializeAdvancedSearch();
    initializeLazyLoading();
    initializeIntersectionObserver();
    initializeSmoothScrolling();
    initializeKeyboardNavigation();
    initializeTouchGestures();
    initializePerformanceOptimizations();
    renderBooks();
    renderCategories();
    initializeAnimations();
    initializeSearch();
    initializeNavbarEffects();
});

// Theme management
function initializeTheme() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    currentTheme = savedTheme;
    document.documentElement.setAttribute('data-theme', savedTheme);
}

function toggleTheme() {
    currentTheme = currentTheme === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    localStorage.setItem('theme', currentTheme);
    
    showToast(
        currentLanguage === 'en' ? 'Theme Updated' : 'تم تحديث المظهر',
        currentLanguage === 'en' ? `Switched to ${currentTheme} mode` : `تم التبديل إلى وضع ${currentTheme === 'dark' ? 'الليل' : 'النهار'}`,
        'success'
    );
}

// Language management
function initializeLanguage() {
    const savedLang = localStorage.getItem('language') || 'en';
    currentLanguage = savedLang;
    updateLanguage();
}

function toggleLanguage() {
    currentLanguage = currentLanguage === 'en' ? 'ar' : 'en';
    localStorage.setItem('language', currentLanguage);
    updateLanguage();
    
    showToast(
        currentLanguage === 'en' ? 'Language Changed' : 'تم تغيير اللغة',
        currentLanguage === 'en' ? 'Switched to English' : 'تم التبديل إلى العربية',
        'success'
    );
}

function updateLanguage() {
    document.documentElement.setAttribute('data-lang', currentLanguage);
    
    // Update language toggle button
    const langToggle = document.querySelector('.lang-toggle .lang-text');
    langToggle.textContent = currentLanguage === 'en' ? 'عربي' : 'English';
    
    // Update all translatable elements
    const elements = document.querySelectorAll('[data-en]');
    elements.forEach(element => {
        const key = currentLanguage === 'en' ? 'data-en' : 'data-ar';
        if (element.hasAttribute(key)) {
            element.textContent = element.getAttribute(key);
        }
    });
    
    // Update placeholders
    const placeholderElements = document.querySelectorAll('[data-en-placeholder]');
    placeholderElements.forEach(element => {
        const key = currentLanguage === 'en' ? 'data-en-placeholder' : 'data-ar-placeholder';
        if (element.hasAttribute(key)) {
            element.placeholder = element.getAttribute(key);
        }
    });
    
    // Re-render content to apply language changes
    renderBooks();
    renderCategories();
}

// Mobile menu functionality
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

// Smooth scrolling to sections
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Books rendering and pagination
function renderBooks() {
    const booksGrid = document.getElementById('booksGrid');
    const startIndex = (currentBooksPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedBooks = books.slice(startIndex, endIndex);
    
    booksGrid.innerHTML = '';
    
    paginatedBooks.forEach((book, index) => {
        const bookCard = createBookCard(book, index);
        booksGrid.appendChild(bookCard);
    });
    
    renderBooksPagination();
}

function createBookCard(book, index) {
    const card = document.createElement('div');
    card.className = 'card book-card';
    card.style.animationDelay = `${index * 0.1}s`;
    
    const title = currentLanguage === 'ar' && book.titleAr ? book.titleAr : book.title;
    const author = currentLanguage === 'ar' && book.authorAr ? book.authorAr : book.author;
    const description = currentLanguage === 'ar' && book.descriptionAr ? book.descriptionAr : book.description;
    
    card.innerHTML = `
        <div class="card-image">
            <img src="${book.image}" alt="${title}" loading="lazy">
            <div class="card-overlay">
                <button class="overlay-btn" onclick="openBookDetails(${book.id})" data-en="View" data-ar="عرض">${currentLanguage === 'en' ? 'View' : 'عرض'}</button>
                <button class="overlay-btn edit-btn" onclick="openEditBookModal(${book.id})" data-en="Edit" data-ar="تحرير">${currentLanguage === 'en' ? 'Edit' : 'تحرير'}</button>
            </div>
        </div>
        <div class="card-content">
            <h3 class="card-title">${title}</h3>
            <p class="card-description">${description}</p>
            <div class="card-meta">
                <span class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                    ${author}
                </span>
                <span class="category-stats">${getCategoryName(book.category)}</span>
            </div>
        </div>
    `;
    
    return card;
}

function renderBooksPagination() {
    const pagination = document.getElementById('booksPagination');
    const totalPages = Math.ceil(books.length / itemsPerPage);
    
    pagination.innerHTML = '';
    
    // Previous button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'page-btn';
    prevBtn.disabled = currentBooksPage === 1;
    prevBtn.onclick = () => changeBooksPage(currentBooksPage - 1);
    prevBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15,18 9,12 15,6"></polyline>
        </svg>
    `;
    pagination.appendChild(prevBtn);
    
    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = `page-btn ${i === currentBooksPage ? 'active' : ''}`;
        pageBtn.textContent = i;
        pageBtn.onclick = () => changeBooksPage(i);
        pagination.appendChild(pageBtn);
    }
    
    // Next button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'page-btn';
    nextBtn.disabled = currentBooksPage === totalPages;
    nextBtn.onclick = () => changeBooksPage(currentBooksPage + 1);
    nextBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9,18 15,12 9,6"></polyline>
        </svg>
    `;
    pagination.appendChild(nextBtn);
}

function changeBooksPage(page) {
    const totalPages = Math.ceil(books.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    
    currentBooksPage = page;
    renderBooks();
    scrollToSection('books');
}

// Categories rendering and pagination
function renderCategories() {
    const categoriesGrid = document.getElementById('categoriesGrid');
    const startIndex = (currentCategoriesPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedCategories = categories.slice(startIndex, endIndex);
    
    categoriesGrid.innerHTML = '';
    
    paginatedCategories.forEach((category, index) => {
        const categoryCard = createCategoryCard(category, index);
        categoriesGrid.appendChild(categoryCard);
    });
    
    renderCategoriesPagination();
}

function createCategoryCard(category, index) {
    const card = document.createElement('div');
    card.className = 'card category-card';
    card.style.animationDelay = `${index * 0.1}s`;
    
    const name = currentLanguage === 'ar' && category.nameAr ? category.nameAr : category.name;
    const description = currentLanguage === 'ar' && category.descriptionAr ? category.descriptionAr : category.description;
    
    card.innerHTML = `
        <div class="card-image">
            <img src="${category.image}" alt="${name}" loading="lazy">
            <div class="card-overlay">
                <button class="overlay-btn" onclick="openCategory(${category.id})" data-en="Browse" data-ar="تصفح">${currentLanguage === 'en' ? 'Browse' : 'تصفح'}</button>
                <button class="overlay-btn edit-btn" onclick="openEditCategoryModal(${category.id})" data-en="Edit" data-ar="تحرير">${currentLanguage === 'en' ? 'Edit' : 'تحرير'}</button>
            </div>
        </div>
        <div class="card-content">
            <h3 class="card-title">${name}</h3>
            <p class="card-description">${description}</p>
            <div class="card-meta">
                <span class="category-stats">${category.bookCount} ${currentLanguage === 'en' ? 'Books' : 'كتاب'}</span>
            </div>
        </div>
    `;
    
    return card;
}

function renderCategoriesPagination() {
    const pagination = document.getElementById('categoriesPagination');
    const totalPages = Math.ceil(categories.length / itemsPerPage);
    
    pagination.innerHTML = '';
    
    // Previous button
    const prevBtn = document.createElement('button');
    prevBtn.className = 'page-btn';
    prevBtn.disabled = currentCategoriesPage === 1;
    prevBtn.onclick = () => changeCategoriesPage(currentCategoriesPage - 1);
    prevBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15,18 9,12 15,6"></polyline>
        </svg>
    `;
    pagination.appendChild(prevBtn);
    
    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = `page-btn ${i === currentCategoriesPage ? 'active' : ''}`;
        pageBtn.textContent = i;
        pageBtn.onclick = () => changeCategoriesPage(i);
        pagination.appendChild(pageBtn);
    }
    
    // Next button
    const nextBtn = document.createElement('button');
    nextBtn.className = 'page-btn';
    nextBtn.disabled = currentCategoriesPage === totalPages;
    nextBtn.onclick = () => changeCategoriesPage(currentCategoriesPage + 1);
    nextBtn.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="9,18 15,12 9,6"></polyline>
        </svg>
    `;
    pagination.appendChild(nextBtn);
}

function changeCategoriesPage(page) {
    const totalPages = Math.ceil(categories.length / itemsPerPage);
    if (page < 1 || page > totalPages) return;
    
    currentCategoriesPage = page;
    renderCategories();
    scrollToSection('categories');
}

// Modal management
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function openAddBookModal() {
    closeFabMenu();
    openModal('addBookModal');
}

function openAddCategoryModal() {
    closeFabMenu();
    openModal('addCategoryModal');
}

function openEditBookModal(bookId) {
    const book = books.find(b => b.id === bookId);
    if (!book) return;
    
    document.getElementById('editBookId').value = book.id;
    document.getElementById('editBookTitle').value = book.title;
    document.getElementById('editBookAuthor').value = book.author;
    document.getElementById('editBookCategory').value = book.category;
    document.getElementById('editBookDescription').value = book.description;
    
    openModal('editBookModal');
}

// Form handlers
function handleAddBook(event) {
    event.preventDefault();
    showLoading();
    
    const formData = new FormData(event.target);
    const newBook = {
        id: books.length + 1,
        title: formData.get('title'),
        author: formData.get('author'),
        category: formData.get('category'),
        description: formData.get('description'),
        image: 'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=400'
    };
    
    setTimeout(() => {
        books.push(newBook);
        updateCategoryBookCount();
        renderBooks();
        closeModal('addBookModal');
        hideLoading();
        event.target.reset();
        
        showToast(
            currentLanguage === 'en' ? 'Book Added' : 'تم إضافة الكتاب',
            currentLanguage === 'en' ? `"${newBook.title}" has been added to your library` : `تم إضافة "${newBook.title}" إلى مكتبتك`,
            'success'
        );
    }, 1000);
}

function handleAddCategory(event) {
    event.preventDefault();
    showLoading();
    
    const formData = new FormData(event.target);
    const newCategory = {
        id: categories.length + 1,
        name: formData.get('name'),
        description: formData.get('description'),
        image: 'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=400',
        bookCount: 0
    };
    
    setTimeout(() => {
        categories.push(newCategory);
        renderCategories();
        closeModal('addCategoryModal');
        hideLoading();
        event.target.reset();
        
        showToast(
            currentLanguage === 'en' ? 'Category Added' : 'تم إضافة الفئة',
            currentLanguage === 'en' ? `"${newCategory.name}" category has been created` : `تم إنشاء فئة "${newCategory.name}"`,
            'success'
        );
    }, 1000);
}

function handleEditBook(event) {
    event.preventDefault();
    showLoading();
    
    const formData = new FormData(event.target);
    const bookId = parseInt(formData.get('bookId'));
    const bookIndex = books.findIndex(b => b.id === bookId);
    
    if (bookIndex !== -1) {
        books[bookIndex] = {
            ...books[bookIndex],
            title: formData.get('title'),
            author: formData.get('author'),
            category: formData.get('category'),
            description: formData.get('description')
        };
        
        setTimeout(() => {
            updateCategoryBookCount();
            renderBooks();
            closeModal('editBookModal');
            hideLoading();
            
            showToast(
                currentLanguage === 'en' ? 'Book Updated' : 'تم تحديث الكتاب',
                currentLanguage === 'en' ? 'Book details have been saved' : 'تم حفظ تفاصيل الكتاب',
                'success'
            );
        }, 1000);
    }
}

function deleteBook() {
    const bookId = parseInt(document.getElementById('editBookId').value);
    const book = books.find(b => b.id === bookId);
    
    if (confirm(currentLanguage === 'en' ? `Are you sure you want to delete "${book.title}"?` : `هل أنت متأكد من حذف "${book.title}"؟`)) {
        showLoading();
        
        setTimeout(() => {
            books = books.filter(b => b.id !== bookId);
            updateCategoryBookCount();
            renderBooks();
            closeModal('editBookModal');
            hideLoading();
            
            showToast(
                currentLanguage === 'en' ? 'Book Deleted' : 'تم حذف الكتاب',
                currentLanguage === 'en' ? 'Book has been removed from your library' : 'تم إزالة الكتاب من مكتبتك',
                'error'
            );
        }, 1000);
    }
}

// Utility functions
function getCategoryName(categoryKey) {
    const categoryMap = {
        'math': currentLanguage === 'en' ? 'Mathematics' : 'الرياضيات',
        'english': currentLanguage === 'en' ? 'English Literature' : 'الأدب الإنجليزي',
        'history': currentLanguage === 'en' ? 'History' : 'التاريخ'
    };
    return categoryMap[categoryKey] || categoryKey;
}

function updateCategoryBookCount() {
    categories.forEach(category => {
        const categoryKey = category.name.toLowerCase().replace(' ', '');
        category.bookCount = books.filter(book => book.category === categoryKey).length;
    });
}

// Book and category actions
function openBookDetails(bookId) {
    const book = books.find(b => b.id === bookId);
    if (book) {
        showLoading();
        setTimeout(() => {
            hideLoading();
            const title = currentLanguage === 'ar' && book.titleAr ? book.titleAr : book.title;
            alert(`${currentLanguage === 'en' ? 'Opening details for:' : 'فتح تفاصيل:'} ${title}`);
        }, 800);
    }
}

function openCategory(categoryId) {
    const category = categories.find(c => c.id === categoryId);
    if (category) {
        showLoading();
        setTimeout(() => {
            hideLoading();
            const name = currentLanguage === 'ar' && category.nameAr ? category.nameAr : category.name;
            alert(`${currentLanguage === 'en' ? 'Opening category:' : 'فتح الفئة:'} ${name}`);
        }, 800);
    }
}

function showAllBooks() {
    alert(currentLanguage === 'en' ? 'Showing all books...' : 'عرض جميع الكتب...');
}

function showAllCategories() {
    alert(currentLanguage === 'en' ? 'Showing all categories...' : 'عرض جميع الفئات...');
}

function openManageModal() {
    alert(currentLanguage === 'en' ? 'Opening library management...' : 'فتح إدارة المكتبة...');
}

// Floating Action Button
function toggleFabMenu() {
    const fabButton = document.getElementById('fabButton');
    const fabMenu = document.getElementById('fabMenu');
    
    fabButton.classList.toggle('active');
    fabMenu.classList.toggle('active');
}

function closeFabMenu() {
    const fabButton = document.getElementById('fabButton');
    const fabMenu = document.getElementById('fabMenu');
    
    fabButton.classList.remove('active');
    fabMenu.classList.remove('active');
}

// Live Search functionality
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    
    if (!searchInput || !searchResults) return;
    
    let searchTimeout;
    let isSearching = false;
    
    // Input event with debouncing
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.trim();
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        // Clear results if input is empty
        if (query.length === 0) {
            hideSearchResults();
            return;
        }
        
        // Show loading state
        if (query.length >= 2) {
            showSearchLoading();
        }
        
        // Debounce search requests
        searchTimeout = setTimeout(() => {
            if (query.length >= 2) {
                performLiveSearch(query);
            }
        }, 300);
    });
    
    // Focus event
    searchInput.addEventListener('focus', () => {
        if (searchInput.value.trim().length >= 2) {
            showSearchResults();
        }
    });
    
    // Click outside to close results
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            hideSearchResults();
        }
    });
    
    // Keyboard navigation
    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            hideSearchResults();
            searchInput.blur();
        }
    });
}

function performLiveSearch(query) {
    const searchResults = document.getElementById('searchResults');
    
    if (!searchResults) return;
    
    // Show loading state
    showSearchLoading();
    
    // Get CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Make AJAX request
    fetch(`/books/search-ajax?query=${encodeURIComponent(query)}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Update results container
            searchResults.innerHTML = data.html;
            
            // Show results if there's content
            if (data.html && data.html.trim() !== '') {
                showSearchResults();
            } else {
                hideSearchResults();
            }
        })
        .catch(error => {
            console.error('Search failed:', error);
            showSearchError();
        });
}

function showSearchResults() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults) {
        searchResults.classList.add('active');
    }
}

function hideSearchResults() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults) {
        searchResults.classList.remove('active');
    }
}

function showSearchLoading() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults) {
        searchResults.innerHTML = `
            <div class="search-loading">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                </div>
                <p>Searching...</p>
            </div>
        `;
        searchResults.classList.add('active');
    }
}

function showSearchError() {
    const searchResults = document.getElementById('searchResults');
    if (searchResults) {
        searchResults.innerHTML = `
            <div class="search-error">
                <div class="error-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                </div>
                <p>Search failed</p>
                <small>Please try again later</small>
            </div>
        `;
        searchResults.classList.add('active');
    }
}

function filterContent(query) {
    if (!query) {
        renderBooks();
        renderCategories();
        return;
    }
    
    // Filter books
    const filteredBooks = books.filter(book => 
        book.title.toLowerCase().includes(query) ||
        book.author.toLowerCase().includes(query) ||
        book.description.toLowerCase().includes(query) ||
        (book.titleAr && book.titleAr.includes(query)) ||
        (book.authorAr && book.authorAr.includes(query))
    );
    
    // Filter categories
    const filteredCategories = categories.filter(category =>
        category.name.toLowerCase().includes(query) ||
        category.description.toLowerCase().includes(query) ||
        (category.nameAr && category.nameAr.includes(query))
    );
    
    // Render filtered results
    renderFilteredBooks(filteredBooks);
    renderFilteredCategories(filteredCategories);
}

function renderFilteredBooks(filteredBooks) {
    const booksGrid = document.getElementById('booksGrid');
    booksGrid.innerHTML = '';
    
    if (filteredBooks.length === 0) {
        booksGrid.innerHTML = `
            <div class="no-results">
                <p>${currentLanguage === 'en' ? 'No books found' : 'لم يتم العثور على كتب'}</p>
            </div>
        `;
        return;
    }
    
    filteredBooks.forEach((book, index) => {
        const bookCard = createBookCard(book, index);
        booksGrid.appendChild(bookCard);
    });
    
    // Hide pagination during search
    document.getElementById('booksPagination').style.display = 'none';
}

function renderFilteredCategories(filteredCategories) {
    const categoriesGrid = document.getElementById('categoriesGrid');
    categoriesGrid.innerHTML = '';
    
    if (filteredCategories.length === 0) {
        categoriesGrid.innerHTML = `
            <div class="no-results">
                <p>${currentLanguage === 'en' ? 'No categories found' : 'لم يتم العثور على فئات'}</p>
            </div>
        `;
        return;
    }
    
    filteredCategories.forEach((category, index) => {
        const categoryCard = createCategoryCard(category, index);
        categoriesGrid.appendChild(categoryCard);
    });
    
    // Hide pagination during search
    document.getElementById('categoriesPagination').style.display = 'none';
}

// Loading and UI functions
function showLoading() {
    const overlay = document.getElementById('loadingOverlay');
    overlay.classList.add('active');
}

function hideLoading() {
    const overlay = document.getElementById('loadingOverlay');
    overlay.classList.remove('active');
}

// Toast notifications
function showToast(title, message, type = 'success') {
    const toastContainer = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    const iconMap = {
        success: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20,6 9,17 4,12"></polyline>
        </svg>`,
        error: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
        </svg>`,
        warning: `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
            <line x1="12" y1="9" x2="12" y2="13"></line>
            <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>`
    };
    
    toast.innerHTML = `
        <div class="toast-icon">${iconMap[type]}</div>
        <div class="toast-content">
            <div class="toast-title">${title}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="removeToast(this)">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    `;
    
    toastContainer.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            removeToast(toast.querySelector('.toast-close'));
        }
    }, 5000);
}

function removeToast(button) {
    const toast = button.closest('.toast');
    toast.style.animation = 'slideOutRight 0.3s ease forwards';
    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 300);
}

// Logout handler
function handleLogout(event) {
    event.preventDefault();
    showLoading();
    
    setTimeout(() => {
        hideLoading();
        showToast(
            currentLanguage === 'en' ? 'Logged Out' : 'تم تسجيل الخروج',
            currentLanguage === 'en' ? 'You have been successfully logged out' : 'تم تسجيل خروجك بنجاح',
            'success'
        );
    }, 1500);
}

// Animation initialization
function initializeAnimations() {
    // Animate stats when they come into view
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('stat-number')) {
                    animateCounter(entry.target);
                }
                
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        observer.observe(stat);
    });
    
    // Observe cards for staggered animation
    setTimeout(() => {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 500);
}

// Animated counter for stats
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const increment = target / 60;
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

// Navbar scroll effects
function initializeNavbarEffects() {
    let lastScrollY = window.scrollY;
    
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > 100) {
            navbar.style.background = currentTheme === 'dark' 
                ? 'rgba(17, 24, 39, 0.98)' 
                : 'rgba(255, 255, 255, 0.98)';
            navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.background = currentTheme === 'dark' 
                ? 'rgba(17, 24, 39, 0.95)' 
                : 'rgba(255, 255, 255, 0.95)';
            navbar.style.boxShadow = 'none';
        }
        
        lastScrollY = currentScrollY;
    });
}

// Advanced search and filtering
function initializeAdvancedSearch() {
    const searchContainer = document.querySelector('.search-container');
    if (!searchContainer) return;

    // Create advanced search interface
    const advancedSearch = document.createElement('div');
    advancedSearch.className = 'advanced-search';
    advancedSearch.innerHTML = `
        <div class="search-filters">
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                ${categories.map(cat => `<option value="${cat.id}">${cat.name}</option>`).join('')}
            </select>
            <select id="sortBy" class="filter-select">
                <option value="title">Sort by Title</option>
                <option value="author">Sort by Author</option>
                <option value="date">Sort by Date</option>
                <option value="rating">Sort by Rating</option>
                <option value="downloads">Sort by Downloads</option>
            </select>
            <button id="sortOrder" class="sort-order-btn" data-order="asc">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M7 14l5-5 5 5"/>
                </svg>
            </button>
        </div>
    `;

    searchContainer.appendChild(advancedSearch);

    // Add event listeners
    document.getElementById('categoryFilter').addEventListener('change', handleFilterChange);
    document.getElementById('sortBy').addEventListener('change', handleSortChange);
    document.getElementById('sortOrder').addEventListener('click', toggleSortOrder);
}

function handleFilterChange() {
    selectedCategory = document.getElementById('categoryFilter').value;
    applyFiltersAndSearch();
}

function handleSortChange() {
    sortBy = document.getElementById('sortBy').value;
    applyFiltersAndSearch();
}

function toggleSortOrder() {
    const btn = document.getElementById('sortOrder');
    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
    btn.setAttribute('data-order', sortOrder);
    btn.innerHTML = sortOrder === 'asc' ? 
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 14l5-5 5 5"/></svg>' :
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 10l5 5 5-5"/></svg>';
    applyFiltersAndSearch();
}

function applyFiltersAndSearch() {
    let filteredBooks = [...books];

    // Apply category filter
    if (selectedCategory) {
        filteredBooks = filteredBooks.filter(book => book.category === selectedCategory);
    }

    // Apply search query
    if (searchQuery) {
        filteredBooks = filteredBooks.filter(book => 
            book.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
            book.author.toLowerCase().includes(searchQuery.toLowerCase()) ||
            book.description.toLowerCase().includes(searchQuery.toLowerCase())
        );
    }

    // Apply sorting
    filteredBooks.sort((a, b) => {
        let aVal, bVal;
        
        switch (sortBy) {
            case 'title':
                aVal = a.title.toLowerCase();
                bVal = b.title.toLowerCase();
                break;
            case 'author':
                aVal = a.author.toLowerCase();
                bVal = b.author.toLowerCase();
                break;
            case 'date':
                aVal = new Date(a.created_at || Date.now());
                bVal = new Date(b.created_at || Date.now());
                break;
            case 'rating':
                aVal = a.rating || 0;
                bVal = b.rating || 0;
                break;
            case 'downloads':
                aVal = a.downloadCount || 0;
                bVal = b.downloadCount || 0;
                break;
            default:
                aVal = a.title.toLowerCase();
                bVal = b.title.toLowerCase();
        }

        if (sortOrder === 'asc') {
            return aVal > bVal ? 1 : -1;
        } else {
            return aVal < bVal ? 1 : -1;
        }
    });

    renderFilteredBooks(filteredBooks);
}

// Lazy loading implementation
function initializeLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        observer.unobserve(img);
                    }
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        // Observe all lazy images
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
}

// Intersection Observer for animations
function initializeIntersectionObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Animate counters if they exist
                if (entry.target.classList.contains('stat-number')) {
                    animateCounter(entry.target);
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.card, .stat-card, .action-card').forEach(el => {
        observer.observe(el);
    });
}

// Smooth scrolling
function initializeSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Keyboard navigation
function initializeKeyboardNavigation() {
    document.addEventListener('keydown', (event) => {
        // Skip if user is typing in input fields
        if (event.target.tagName === 'INPUT' || event.target.tagName === 'TEXTAREA') {
            return;
        }

        switch (event.key) {
            case 'Escape':
                closeAllModals();
                break;
            case 'ArrowLeft':
                if (currentLanguage === 'en') {
                    navigateBooks(-1);
                } else {
                    navigateBooks(1);
                }
                break;
            case 'ArrowRight':
                if (currentLanguage === 'en') {
                    navigateBooks(1);
                } else {
                    navigateBooks(-1);
                }
                break;
            case 'Home':
                scrollToTop();
                break;
            case 'End':
                scrollToBottom();
                break;
        }
    });
}

// Touch gestures for mobile
function initializeTouchGestures() {
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;

    document.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    });

    document.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        handleGesture();
    });

    function handleGesture() {
        const diffX = touchStartX - touchEndX;
        const diffY = touchStartY - touchEndY;
        const threshold = 50;

        if (Math.abs(diffX) > Math.abs(diffY)) {
            // Horizontal swipe
            if (Math.abs(diffX) > threshold) {
                if (diffX > 0) {
                    // Swipe left - next page
                    navigateBooks(1);
                } else {
                    // Swipe right - previous page
                    navigateBooks(-1);
                }
            }
        } else {
            // Vertical swipe
            if (Math.abs(diffY) > threshold) {
                if (diffY > 0) {
                    // Swipe up - could trigger refresh
                    if (touchStartY < 100) {
                        refreshContent();
                    }
                } else {
                    // Swipe down - could trigger refresh
                    if (touchStartY < 100) {
                        refreshContent();
                    }
                }
            }
        }
    }
}

// Performance optimizations
function initializePerformanceOptimizations() {
    // Debounce search input
    const searchInputs = document.querySelectorAll('.search-input');
    searchInputs.forEach(input => {
        let timeout;
        input.addEventListener('input', (e) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                searchQuery = e.target.value;
                applyFiltersAndSearch();
            }, 300);
        });
    });

    // Throttle scroll events
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
}

// Enhanced book rendering with advanced features
function renderFilteredBooks(filteredBooks) {
    const booksGrid = document.getElementById('booksGrid');
    if (!booksGrid) return;

    booksGrid.innerHTML = '';
    
    if (filteredBooks.length === 0) {
        booksGrid.innerHTML = `
            <div class="no-results">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <h3>${currentLanguage === 'en' ? 'No Books Found' : 'لم يتم العثور على كتب'}</h3>
                <p>${currentLanguage === 'en' ? 'Try adjusting your search criteria or filters' : 'حاول تعديل معايير البحث أو المرشحات'}</p>
            </div>
        `;
        return;
    }

    filteredBooks.forEach((book, index) => {
        const bookCard = createEnhancedBookCard(book, index);
        booksGrid.appendChild(bookCard);
    });

    // Hide pagination during search
    const pagination = document.getElementById('booksPagination');
    if (pagination) {
        pagination.style.display = 'none';
    }
}

function createEnhancedBookCard(book, index) {
    const card = document.createElement('div');
    card.className = 'card book-card enhanced';
    card.style.animationDelay = `${index * 0.1}s`;
    
    const title = currentLanguage === 'ar' && book.titleAr ? book.titleAr : book.title;
    const author = currentLanguage === 'ar' && book.authorAr ? book.authorAr : book.author;
    const description = currentLanguage === 'ar' && book.descriptionAr ? book.descriptionAr : book.description;
    
    card.innerHTML = `
        <div class="card-image">
            <img src="${book.image}" alt="${title}" loading="lazy" class="book-cover">
            <div class="card-overlay">
                <button class="overlay-btn" onclick="openBookDetails(${book.id})">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    ${currentLanguage === 'en' ? 'View' : 'عرض'}
                </button>
                <button class="overlay-btn edit-btn" onclick="openEditBookModal(${book.id})">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    ${currentLanguage === 'en' ? 'Edit' : 'تحرير'}
                </button>
            </div>
            <div class="book-badge">
                <span class="rating">★ ${book.rating || 4.5}</span>
            </div>
        </div>
        <div class="card-content">
            <h3 class="card-title">${title}</h3>
            <p class="card-description">${description}</p>
            <div class="card-meta">
                <span class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                    ${author}
                </span>
                <span class="category-stats">${getCategoryName(book.category)}</span>
            </div>
            <div class="book-stats">
                <span class="stat-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7,10 12,15 17,10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    ${book.downloadCount || 0}
                </span>
                <span class="stat-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                    </svg>
                    ${book.fileSize || 'N/A'}
                </span>
            </div>
        </div>
    `;
    
    return card;
}

// Utility functions
function navigateBooks(direction) {
    const totalPages = Math.ceil(books.length / itemsPerPage);
    let newPage = currentBooksPage + direction;
    
    if (newPage < 1) newPage = totalPages;
    if (newPage > totalPages) newPage = 1;
    
    changeBooksPage(newPage);
}

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function scrollToBottom() {
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}

function closeAllModals() {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.classList.remove('active');
    });
    document.getElementById('mobileMenu').classList.remove('active');
    closeFabMenu();
    hideLoading();
    document.body.style.overflow = '';
}

function refreshContent() {
    showToast(
        currentLanguage === 'en' ? 'Refreshing...' : 'جاري التحديث...',
        currentLanguage === 'en' ? 'Content is being refreshed' : 'يتم تحديث المحتوى',
        'info'
    );
    
    // Simulate refresh
    setTimeout(() => {
        location.reload();
    }, 1000);
}

function handleScroll() {
    const navbar = document.querySelector('.navbar');
    const scrollY = window.scrollY;
    
    if (scrollY > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
    
    // Parallax effect for hero section
    const hero = document.querySelector('.hero');
    if (hero) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        hero.style.transform = `translateY(${rate}px)`;
    }
}

// Event listeners
document.addEventListener('click', (event) => {
    const mobileMenu = document.getElementById('mobileMenu');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const fabContainer = document.querySelector('.fab-container');
    
    // Close mobile menu when clicking outside
    if (!mobileMenu.contains(event.target) && !menuBtn.contains(event.target)) {
        mobileMenu.classList.remove('active');
    }
    
    // Close FAB menu when clicking outside
    if (!fabContainer.contains(event.target)) {
        closeFabMenu();
    }
    
    // Close modals when clicking overlay
    if (event.target.classList.contains('modal-overlay')) {
        event.target.classList.remove('active');
        document.body.style.overflow = '';
    }
});

// Keyboard navigation support
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        // Close all modals and menus
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.classList.remove('active');
        });
        document.getElementById('mobileMenu').classList.remove('active');
        closeFabMenu();
        hideLoading();
        document.body.style.overflow = '';
    }
    
    // Pagination keyboard shortcuts
    if (event.target.tagName !== 'INPUT' && event.target.tagName !== 'TEXTAREA') {
        if (event.key === 'ArrowLeft' && currentLanguage === 'en') {
            changeBooksPage(currentBooksPage - 1);
        } else if (event.key === 'ArrowRight' && currentLanguage === 'en') {
            changeBooksPage(currentBooksPage + 1);
        } else if (event.key === 'ArrowLeft' && currentLanguage === 'ar') {
            changeBooksPage(currentBooksPage + 1);
        } else if (event.key === 'ArrowRight' && currentLanguage === 'ar') {
            changeBooksPage(currentBooksPage - 1);
        }
    }
});

// Touch gesture support for mobile
let touchStartY = 0;
let touchEndY = 0;

document.addEventListener('touchstart', (event) => {
    touchStartY = event.changedTouches[0].screenY;
});

document.addEventListener('touchend', (event) => {
    touchEndY = event.changedTouches[0].screenY;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartY - touchEndY;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swiped up - could trigger refresh or load more
        } else {
            // Swiped down - could trigger refresh
        }
    }
}

// Performance optimization - lazy load images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            }
        });
    });

    // Observe images with data-src attribute
    setTimeout(() => {
        const images = document.querySelectorAll('img[data-src]');
        images.forEach(img => imageObserver.observe(img));
    }, 1000);
}

// Error handling for images
document.addEventListener('error', function(event) {
    if (event.target.tagName === 'IMG') {
        event.target.src = 'https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=400';
    }
}, true);

// Add ripple effect to buttons
function createRipple(event) {
    const button = event.currentTarget;
    const circle = document.createElement('span');
    const diameter = Math.max(button.clientWidth, button.clientHeight);
    const radius = diameter / 2;
    
    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
    circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
    circle.classList.add('ripple');
    
    const ripple = button.getElementsByClassName('ripple')[0];
    if (ripple) {
        ripple.remove();
    }
    
    button.appendChild(circle);
    
    setTimeout(() => {
        circle.remove();
    }, 600);
}

// Add ripple effect to all buttons
setTimeout(() => {
    document.querySelectorAll('.btn, .page-btn, .fab').forEach(button => {
        button.addEventListener('click', createRipple);
    });
}, 100);

// Add CSS for ripple effect
const rippleCSS = `
.btn, .page-btn, .fab {
    position: relative;
    overflow: hidden;
}

.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(0);
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

@keyframes slideOutRight {
    to {
        opacity: 0;
        transform: translateX(100%);
    }
}

.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 48px 24px;
    color: var(--text-secondary);
    font-size: 1.125rem;
}
`;

// Inject additional CSS
const style = document.createElement('style');
style.textContent = rippleCSS;
document.head.appendChild(style);

// Initialize data
updateCategoryBookCount();