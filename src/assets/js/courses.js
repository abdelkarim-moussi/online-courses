// DOM Elements
const coursesGrid = document.querySelector('.grid');
const searchInput = document.querySelector('input[placeholder="Search courses..."]');
const sortSelect = document.querySelector('select');
const priceRange = document.querySelector('input[type="range"]');
const filterCheckboxes = document.querySelectorAll('input[type="checkbox"]');
const applyFiltersBtn = document.querySelector('button.w-full.bg-blue-600');

// Initialize the page
document.addEventListener('DOMContentLoaded', () => {
    renderCourses(courses);
    setupEventListeners();
});

// Render course cards
function renderCourses(coursesToRender) {
    const courseCards = coursesToRender.map(course => `
        <a href="course-details.html?id=${course.id}" class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            <img src="${course.image}" alt="${course.title}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">${course.title}</h3>
                <p class="text-gray-600 mb-2">By ${course.instructor}</p>
                <div class="flex items-center mb-2">
                    <div class="text-yellow-400">
                        ${generateStarRating(course.rating)}
                    </div>
                    <span class="ml-2 text-gray-600">${course.rating} (${course.reviews.toLocaleString()} reviews)</span>
                </div>
                <p class="text-xl font-bold text-blue-600">$${course.price.toFixed(2)}</p>
            </div>
        </a>
    `).join('');

    coursesGrid.innerHTML = courseCards;
}

// Generate star rating HTML
function generateStarRating(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;
    let stars = '';

    for (let i = 0; i < 5; i++) {
        if (i < fullStars) {
            stars += '<i class="fas fa-star"></i>';
        } else if (i === fullStars && hasHalfStar) {
            stars += '<i class="fas fa-star-half-alt"></i>';
        } else {
            stars += '<i class="far fa-star"></i>';
        }
    }

    return stars;
}

// Setup event listeners
function setupEventListeners() {
    // Search functionality
    searchInput.addEventListener('input', debounce(() => {
        filterAndSortCourses();
    }, 300));

    // Sort functionality
    sortSelect.addEventListener('change', () => {
        filterAndSortCourses();
    });

    // Price range
    priceRange.addEventListener('input', (e) => {
        const priceLabel = e.target.nextElementSibling.lastElementChild;
        priceLabel.textContent = `$${e.target.value}`;
        filterAndSortCourses();
    });

    // Apply filters button
    applyFiltersBtn.addEventListener('click', () => {
        filterAndSortCourses();
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.md\\:hidden');
    const navLinks = document.querySelector('.hidden.md\\:flex');
    
    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('hidden');
    });
}

// Filter and sort courses
function filterAndSortCourses() {
    let filteredCourses = [...courses];

    // Apply search filter
    const searchTerm = searchInput.value.toLowerCase();
    if (searchTerm) {
        filteredCourses = filteredCourses.filter(course =>
            course.title.toLowerCase().includes(searchTerm) ||
            course.instructor.toLowerCase().includes(searchTerm)
        );
    }

    // Apply category and level filters
    const selectedFilters = Array.from(filterCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.nextElementSibling.textContent.toLowerCase());

    if (selectedFilters.length > 0) {
        filteredCourses = filteredCourses.filter(course =>
            selectedFilters.includes(course.category) ||
            selectedFilters.includes(course.level) ||
            selectedFilters.includes(course.rating.toFixed(1) + ' & up')
        );
    }

    // Apply price filter
    const maxPrice = parseInt(priceRange.value);
    filteredCourses = filteredCourses.filter(course => course.price <= maxPrice);

    // Apply sorting
    const sortValue = sortSelect.value.toLowerCase();
    switch (sortValue) {
        case 'price: low to high':
            filteredCourses.sort((a, b) => a.price - b.price);
            break;
        case 'price: high to low':
            filteredCourses.sort((a, b) => b.price - a.price);
            break;
        case 'highest rated':
            filteredCourses.sort((a, b) => b.rating - a.rating);
            break;
        case 'newest':
            // In a real application, you would sort by date
            break;
        default: // 'most popular'
            filteredCourses.sort((a, b) => b.reviews - a.reviews);
    }

    renderCourses(filteredCourses);
}

// Debounce function for search input
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
