document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent actual submission

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const message = document.getElementById("message").value.trim();
    const alert = document.getElementById("alert");

    // Regular expressions
    const nameRegex = /^[A-Za-z\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 

    if (!nameRegex.test(name)) {
        alert.textContent = "Please enter a valid name (letters and spaces only).";
        alert.style.color = "red";
        return;
    }

    if (!emailRegex.test(email)) {
        alert.textContent = "Please enter a valid email address.";
        alert.style.color = "red";
        return;
    }

    if (!passwordRegex.test(password)) {
        alert.textContent = "Password must be at least 8 characters long and contain both letters and numbers.";
        alert.style.color = "red";
        return;
    }

    if (message.length < 10) {
        alert.textContent = "Message must be at least 10 characters long.";
        alert.style.color = "red";
        return;
    }

    alert.textContent = "Form submitted successfully!";
    alert.style.color = "green";

    // Optionally reset form
    // e.target.reset();
});
