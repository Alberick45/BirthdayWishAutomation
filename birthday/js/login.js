(function () {
  'use strict'
// Sending login request to the login.php
document.getElementById("signin-btn").addEventListener("submit", function(event) {
  event.preventDefault();

  // Get the username and password from the form
  var phone = document.getElementById("phone").value;
  var password = document.getElementById("password").value;

  // Send an AJAX request to the PHP script
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "login.php", true);
  xhr.setRequestHeader("Content-Type", "WishMe Project/index.html");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.success) {
        // Login successful, redirect to the user_account
        window.location.href = "user_account.php";
      } else {
        // Login failed, display an error message
        document.getElementById(".invalid-feedback").innerHTML = "Invalid phone number or password";
      }
    }
  };
  xhr.send("phone=" + phone + "&password=" + password);
});
})()
