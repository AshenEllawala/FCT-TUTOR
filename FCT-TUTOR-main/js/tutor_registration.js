// Check if user selected tutor role
const selectedRole = localStorage.getItem('selectedRole');
if (selectedRole !== 'tutor') {
    // Redirect back to role selection if not a tutor
    alert('Please select "I am a Tutor" to access this page.');
    window.location.href = 'user_role.html';
}

// Get form elements
const form = document.getElementById('registrationForm');
const clearBtn = document.getElementById('clearBtn');
const successMessage = document.getElementById('successMessage');

// Form submit event
/*form.addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form values
    const formData = {
        tutorId: document.getElementById('tutorid').value,
        username: document.getElementById('username').value,
        password: document.getElementById('password').value,
        email: document.getElementById('email').value,
        courseId: document.getElementById('courseid').value
    };

    // Log form data to console
    console.log('Tutor form submitted:', formData);

    // Show success message
    successMessage.classList.add('show');

    // Hide success message after 3 seconds
    setTimeout(() => {
        successMessage.classList.remove('show');
    }, 3000);

    // Clear form
    form.reset();
});
*/
// Clear button event
clearBtn.addEventListener('click', function () {
    form.reset();
    successMessage.classList.remove('show');
    console.log('Form cleared');
});

// Add input animation on focus
const inputs = document.querySelectorAll('input');
inputs.forEach(input => {
    input.addEventListener('focus', function () {
        this.parentElement.style.transform = 'translateX(5px)';
        this.parentElement.style.transition = 'transform 0.3s';
    });

    input.addEventListener('blur', function () {
        this.parentElement.style.transform = 'translateX(0)';
    });
});

// Optional: Email validation
document.getElementById('email').addEventListener('blur', function () {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value && !emailPattern.test(this.value)) {
        this.style.borderColor = '#f44336';
    } else {
        this.style.borderColor = '#e0e0e0';
    }
});
