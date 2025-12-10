// ===== Course Card Navigation =====

// Add click event to all course cards
document.addEventListener('DOMContentLoaded', () => {
  const courseCards = document.querySelectorAll('.course-card');
  
  courseCards.forEach(card => {
    card.addEventListener('click', () => {
      const courseTitle = card.getAttribute('data-title');
      
      // Map course titles to their respective tutor pages
      const coursePages = {
        'Mathematics For Technology': 'maths_tutor.html',
        'Physics For Technology': 'physics_tutor.html',
        'Statics For Technology': 'statics_tutor.html',
        'Computer Network': 'network_tutor.html',
        'Structure Programming': 'programming_tutor.html'
      };
      
      // Navigate to the corresponding page
      if (coursePages[courseTitle]) {
        window.location.href = coursePages[courseTitle];
      }
    });
    
    // Add pointer cursor on hover
    card.style.cursor = 'pointer';
  });
});

