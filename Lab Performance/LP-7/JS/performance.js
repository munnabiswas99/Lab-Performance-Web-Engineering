document.getElementById("studentForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const batch = document.getElementById("batch").value.trim();
  const hobbies = document.getElementById("hobbies").value.trim();
  const pass = document.getElementById("pass").value;
  const confirmPass = document.getElementById("confirmPass").value;
  const alert = document.getElementById("alert");

  // Regex patterns
  const emailRegex = /^[a-zA-Z._%+-]+[0-9]{4,}@diu\.edu\.bd$/;
  const batchRegex = /^[0-9]{2,3}_[A-Z]$/;
  const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[#]).{6,}$/;

  // Email validation
  if (!emailRegex.test(email)) {
    alert.textContent = "Email must be a valid @diu.edu.bd address.";
    alert.style.color = "red";
    return;
  }

  // Batch validation
  if (!batchRegex.test(batch)) {
    alert.textContent = "Batch format must be like 61-J.";
    alert.style.color = "red";
    return;
  }

  // Hobbies validation
  const hobbyList = hobbies.split(",").map(h => h.trim().toLowerCase());
  if (hobbyList.length !== 5 || !hobbyList.includes("painting")) {
    alert.textContent = "Enter 5 hobbies and one must be 'painting'.";
    alert.style.color = "red";
    return;
  }

  // Password validation
  if (!passRegex.test(pass)) {
    alert.textContent = "Password must include uppercase, lowercase, and '#'.";
    alert.style.color = "red";
    return;
  }

  // Confirm password
  if (pass !== confirmPass) {
    alert.textContent = "Passwords do not match.";
    alert.style.color = "red";
    return;
  }

  // Success
  alert.textContent = "Form submitted successfully!";
  alert.style.color = "green";
});
