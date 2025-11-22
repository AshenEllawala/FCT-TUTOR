// When clicking the primary button
document.querySelector(".primary-btn")?.addEventListener("click", () => {
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


// ===== Course Card Click Navigation =====
document.addEventListener('DOMContentLoaded', () => {
  const courseCards = document.querySelectorAll('.course-card');
  
  courseCards.forEach(card => {
    // Add pointer cursor
    card.style.cursor = 'pointer';
    
    // Add click event listener
    card.addEventListener('click', () => {
      const courseTitle = card.getAttribute('data-title');
      
      // Map course titles to their respective tutor pages
      const coursePages = {
        'Mathematics For Technology': 'maths_tutor.html',
        'Physics For Technology': 'p6_tutor.html',
        'Statics For Technology': 'statics_tutor.html',
        'Computer Network': 'network_tutor.html',
        'Structure Programming': 'programming_tutor.html'
      };
      
      // Navigate to the corresponding page
      if (coursePages[courseTitle]) {
        window.location.href = coursePages[courseTitle];
      }
    });
  });
});
