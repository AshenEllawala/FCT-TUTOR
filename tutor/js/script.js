// When clicking the primary button
document.querySelector(".primary-btn").addEventListener("click", () => {
  alert("Welcome to FCT Tutor!");
});


// ===== Highlight Active Nav Link Based on Page =====

// Get the current page name (example: "about.html")
const currentPage = window.location.pathname.split("/").pop();

// Select all nav links
const navLinks = document.querySelectorAll(".nav-links a");

// Loop through each link and set the active class
navLinks.forEach(link => {
  if (link.getAttribute("href") === currentPage) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});


