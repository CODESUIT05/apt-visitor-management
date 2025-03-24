// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    // Form Validation for Visitor Registration
    const visitorForm = document.querySelector('.visitor-form-section form');
    if (visitorForm) {
        visitorForm.addEventListener('submit', function (e) {
            let isValid = true;

            // Validate Name
            const nameInput = document.querySelector('input[name="name"]');
            if (!nameInput.value.trim()) {
                alert('Please enter your name.');
                isValid = false;
            }

            // Validate Phone Number
            const phoneInput = document.querySelector('input[name="phone"]');
            const phonePattern = /^[0-9]{10}$/; // 10-digit phone number
            if (!phonePattern.test(phoneInput.value)) {
                alert('Please enter a valid 10-digit phone number.');
                isValid = false;
            }

            // Validate Email (Optional)
            const emailInput = document.querySelector('input[name="email"]');
            if (emailInput.value && !validateEmail(emailInput.value)) {
                alert('Please enter a valid email address.');
                isValid = false;
            }

            // Validate Purpose
            const purposeInput = document.querySelector('textarea[name="purpose"]');
            if (!purposeInput.value.trim()) {
                alert('Please specify the purpose of your visit.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }

    // Smooth Scroll for Anchor Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Toggle Dark Mode
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        });

        // Check Local Storage for Dark Mode Preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }
    }

    // Show/Hide Password in Reset Password Form
    const passwordInput = document.querySelector('input[type="password"]');
    const togglePassword = document.querySelector('#toggle-password');
    if (passwordInput && togglePassword) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });
    }
});

// Helper Function: Validate Email Format
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}