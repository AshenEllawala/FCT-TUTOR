// Get form element
const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');

// Handle form submission
loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();
    
    // Basic validation
    if (!username || !password) {
        alert('Please fill in all fields');
        return;
    }
    
    // Here you would typically send data to a server
    console.log('Login attempt:', {
        username: username,
        password: password
    });
    
    // Navigate to index.html
    window.location.href = 'index.html';
});


// Input validation feedback
usernameInput.addEventListener('blur', function() {
    if (this.value.trim() === '') {
        this.style.borderColor = '#ff6b6b';
    } else {
        this.style.borderColor = '#e0e0e0';
    }
});

passwordInput.addEventListener('blur', function() {
    if (this.value.trim() === '') {
        this.style.borderColor = '#ff6b6b';
    } else {
        this.style.borderColor = '#e0e0e0';
    }
});

// Reset border color on focus
usernameInput.addEventListener('focus', function() {
    this.style.borderColor = '#ff9147';
});

passwordInput.addEventListener('focus', function() {
    this.style.borderColor = '#ff9147';
});

// Handle forgot password link
const forgotPasswordLink = document.querySelector('.form-links .link:first-child');
forgotPasswordLink.addEventListener('click', function(e) {
    e.preventDefault();
    alert('Password recovery would be implemented here');
});

// Handle create account link
const createAccountLink = document.querySelector('.form-links .link:last-child');
createAccountLink.addEventListener('click', function(e) {
    e.preventDefault();
    alert('Account creation would be implemented here');
});