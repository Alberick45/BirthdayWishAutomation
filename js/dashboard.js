// // script.js
// document.addEventListener("DOMContentLoaded", function () {
//     const sections = document.querySelectorAll(".cont");
//     sections[0].style.display = "block"; // Show the first section by default

//     document.querySelectorAll(".nav-item a").forEach((link) => {
//         link.addEventListener("click", function (e) {
//             e.preventDefault();
//             const targetSectionId = link.getAttribute("href");
//             sections.forEach((section) => {
//                 section.style.display = "none"; // Hide all sections
//             });
//             document.querySelector(targetSectionId).style.display = "block"; // Show the clicked section
//         });
//     });
// });

(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()

