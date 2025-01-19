// Get course ID from URL parameter
const urlParams = new URLSearchParams(window.location.search);
const courseId = urlParams.get('id');

// Sample course data (in a real application, this would come from a backend API)
const courseDetails = {
    1: {
        title: 'Advanced JavaScript Course',
        instructor: 'John Smith',
        description: 'Master modern JavaScript with advanced concepts, design patterns, and real-world applications.',
        image: 'https://via.placeholder.com/640x360',
        price: 89.99,
        rating: 4.5,
        reviews: 2345,
        students: 12345,
        duration: '20 hours',
        language: 'English',
        lastUpdated: '2025-01',
        learningPoints: [
            'Advanced JavaScript concepts and ES6+ features',
            'Object-oriented programming in JavaScript',
            'Asynchronous programming with Promises',
            'Modern JavaScript design patterns',
            'Error handling and debugging techniques',
            'Performance optimization strategies'
        ],
        requirements: [
            'Basic knowledge of JavaScript and ES6',
            'Understanding of HTML and CSS',
            'A code editor (VS Code recommended)',
            'Enthusiasm to learn advanced concepts'
        ],
        fullDescription: `
            This comprehensive course will take you on a journey through advanced JavaScript concepts
            and modern development practices. You'll learn everything from advanced ES6+ features to
            complex design patterns used in professional development.

            Throughout the course, you'll work on real-world projects that will help you master:
            - Advanced scope and closures
            - Prototypal inheritance
            - Async/await patterns
            - Modern JavaScript tooling

            By the end of this course, you'll have the skills and confidence to build complex
            applications using advanced JavaScript concepts.
        `,
        sections: [
            {
                title: 'Introduction to Advanced JavaScript',
                lectures: 4,
                duration: '45min'
            },
            {
                title: 'Object-Oriented Programming',
                lectures: 6,
                duration: '1h 15min'
            },
            {
                title: 'Asynchronous Programming',
                lectures: 5,
                duration: '1h 30min'
            }
        ],
        instructor: {
            name: 'John Smith',
            title: 'Senior JavaScript Developer',
            rating: 4.8,
            students: 50000,
            courses: 15,
            image: 'https://via.placeholder.com/100'
        }
    }
    // Add more courses as needed
};

// Function to load course details
function loadCourseDetails() {
    if (!courseId || !courseDetails[courseId]) {
        // Handle invalid course ID
        window.location.href = 'courses.html';
        return;
    }

    const course = courseDetails[courseId];

    // Update page title
    document.title = `${course.title} - EduHub`;

    // Update course header information
    document.getElementById('courseTitle').textContent = course.title;
    document.getElementById('courseDescription').textContent = course.description;
    document.getElementById('courseInstructor').textContent = `By ${course.instructor.name}`;
    document.getElementById('coursePrice').textContent = `$${course.price.toFixed(2)}`;

    // Update learning points
    const learningPoints = document.querySelector('#what-you-will-learn .grid');
    if (learningPoints) {
        learningPoints.innerHTML = course.learningPoints.map(point => `
            <div class="flex items-start">
                <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                <span>${point}</span>
            </div>
        `).join('');
    }

    // Handle course content sections toggle
    const contentButtons = document.querySelectorAll('.course-content button');
    contentButtons.forEach(button => {
        button.addEventListener('click', () => {
            const icon = button.querySelector('i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
            // Add logic to show/hide content
        });
    });
}

// Initialize the page
document.addEventListener('DOMContentLoaded', loadCourseDetails);

// Handle enrollment button click
document.querySelector('button:contains("Enroll Now")').addEventListener('click', () => {
    // Add enrollment logic here
    alert('Enrollment functionality will be implemented here');
});

// Handle wishlist button click
document.querySelector('button:contains("Add to Wishlist")').addEventListener('click', () => {
    // Add wishlist logic here
    alert('Wishlist functionality will be implemented here');
});

// Handle share buttons
document.querySelectorAll('.share-buttons a').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        // Add sharing logic here
        const platform = button.getAttribute('data-platform');
        // Implement sharing for each platform
    });
});
