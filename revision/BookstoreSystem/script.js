// Ask before deleting a book record
function confirmDelete() {
    return confirm("Are you sure you want to delete this book?");
}

// Basic client-side check on the registration form
function checkRegister(form) {
    if (form.password.value.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }
    if (form.password.value !== form.confirm.value) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}
