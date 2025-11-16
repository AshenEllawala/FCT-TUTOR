// Get form elements
const form = document.getElementById('registrationForm');
const clearBtn = document.getElementById('clearBtn');
const successMessage = document.getElementById('successMessage');

// Form submit event
form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const formData = {
        studentNo: document.getElementById('studentNo').value,
        fullName: document.getElementById('fullName').value,
        email: document.getElementById('email').value,
        academicYear: document.getElementById('academicYear').value,
        degreeProgram: document.getElementById('degreeProgram').value,
        userName: document.getElementById('userName').value,
        password: document.getElementById('password').value
    };

    // Log form data to console
    console.log('Form submitted:', formData);
    
    // Show success message
    successMessage.classList.add('show');
    
    // Hide success message after 3 seconds
    setTimeout(() => {
        successMessage.classList.remove('show');
    }, 3000);

    // Clear form
    form.reset();
});

// Clear button event
clearBtn.addEventListener('click', function() {
    form.reset();
    successMessage.classList.remove('show');
    console.log('Form cleared');
});

// Add input animation on focus
const inputs = document.querySelectorAll('input');
inputs.forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'translateX(5px)';
        this.parentElement.style.transition = 'transform 0.3s';
    });

    input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'translateX(0)';
    });
});

// Optional: Email validation
document.getElementById('email').addEventListener('blur', function() {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (this.value && !emailPattern.test(this.value)) {
        this.style.borderColor = '#f44336';
    } else {
        this.style.borderColor = '#e0e0e0';
    }
});