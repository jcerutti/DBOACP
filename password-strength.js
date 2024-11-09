document.getElementById('password').addEventListener('input', function() {
    var password = this.value;
    var strengthStatus = document.getElementById('password-strength-status');
    var strengthText = document.getElementById('password-strength-status-text');

    if (password.length === 0) {
        strengthStatus.style.width = '0%';
        strengthText.innerHTML = '';
    } else {
        var strength = checkPasswordStrength(password);
        displayStrength(strength, strengthStatus, strengthText);
    }
});

function checkPasswordStrength(password) {
    var strength = 0;
    if (password.length >= 5) strength++;
    if (/[A-Za-z]/.test(password) && /\d/.test(password)) strength++;
    if (password.length >= 10) strength++;
    return strength;
}

function displayStrength(strength, statusElement, textElement) {
    var strengthText = '';
    var strengthColor = '';

    switch (strength) {
        case 0:
            strengthText = '';
            strengthColor = 'transparent';
            break;
        case 1:
            strengthText = 'Contraseña débil';
            strengthColor = '#e74c3c';
            break;
        case 2:
            strengthText = 'Contraseña media';
            strengthColor = '#f39c12';
            break;
        case 3:
            strengthText = 'Contraseña fuerte';
            strengthColor = '#2ecc71';
            break;
    }

    statusElement.style.width = (strength * 33) + '%';
    statusElement.style.backgroundColor = strengthColor;
    textElement.innerHTML = strengthText;
}

document.getElementById('toggle-password').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});

document.getElementById('toggle-confirm-password').addEventListener('click', function() {
    var confirmPasswordField = document.getElementById('confirm_password');
    if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';
    } else {
        confirmPasswordField.type = 'password';
    }
});
