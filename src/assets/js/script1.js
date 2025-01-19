// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Sticky navigation
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    header.classList.toggle('sticky', window.scrollY > 0);
});

// Search functionality
const searchBar = document.querySelector('.search-bar input');
const searchButton = document.querySelector('.search-bar button');

searchButton.addEventListener('click', () => {
    const searchTerm = searchBar.value.trim();
    if (searchTerm) {
        // Add your search functionality here
        console.log('Searching for:', searchTerm);
    }
});

searchBar.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        const searchTerm = searchBar.value.trim();
        if (searchTerm) {
            // Add your search functionality here
            console.log('Searching for:', searchTerm);
        }
    }
});

// Authentication buttons
const loginBtn = document.querySelector('.login-btn');
const signupBtn = document.querySelector('.signup-btn');

loginBtn.addEventListener('click', () => {
    // Add your login functionality here
    console.log('Login clicked');
});

signupBtn.addEventListener('click', () => {
    // Add your signup functionality here
    console.log('Sign up clicked');
});

// Course card hover effect
const courseCards = document.querySelectorAll('.course-card');

courseCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-10px)';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});

// Add animation on scroll
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.feature-card, .course-card').forEach(element => {
    observer.observe(element);
});
