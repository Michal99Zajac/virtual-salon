const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const surnameInput = form.querySelector('input[name="surname"]');
const nameInput = form.querySelector('input[name="name"]');
const passwordInput = form.querySelector('input[name="pwdrepeat"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function isKindOfName(name) {
    return /^[a-zA-Z]+(\s{0,1}[a-zA-Z])*$/.test(name);
}

function arePasswordsSame(pwd, pwdRepeat) {
    return pwd === pwdRepeat;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('invalid') : element.classList.remove('invalid');
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validateName() {
    setTimeout(function () {
            markValidation(nameInput, isKindOfName(nameInput.value));
        },
        1000
    );
}

function validateSurname() {
    setTimeout(function () {
            markValidation(surnameInput, isKindOfName(surnameInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                passwordInput.previousElementSibling.value,
                passwordInput.value
            );
            markValidation(passwordInput, condition);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
nameInput.addEventListener('keyup', validateName);
surnameInput.addEventListener('keyup', validateSurname);
passwordInput.addEventListener('keyup', validatePassword);
