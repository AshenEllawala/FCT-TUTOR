// ===== Session Tabs Functionality =====

document.addEventListener('DOMContentLoaded', () => {
  const tabButtons = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');

  tabButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetTab = button.getAttribute('data-tab');

      // Remove active class from all tabs and contents
      tabButtons.forEach(btn => btn.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));

      // Add active class to clicked tab and corresponding content
      button.classList.add('active');
      document.getElementById(targetTab).classList.add('active');
    });
  });

  // Add event listeners to action buttons
  const joinButtons = document.querySelectorAll('.btn-primary');
  const rescheduleButtons = document.querySelectorAll('.btn-secondary');

  joinButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const buttonText = btn.textContent.trim();
      
      if (buttonText === 'Join Session') {
        alert('Joining session... (This would open video call or meeting room)');
      } else if (buttonText === 'Book Again') {
        alert('Redirecting to booking page...');
        window.location.href = 'find_tutor.html';
      }
    });
  });

  rescheduleButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const buttonText = btn.textContent.trim();
      
      if (buttonText === 'Reschedule') {
        alert('Opening reschedule form... (Calendar picker would appear)');
      } else if (buttonText === 'Rate Tutor') {
        alert('Opening rating form... (Star rating modal would appear)');
      } else if (buttonText === 'View Details') {
        alert('Viewing session details...');
      }
    });
  });

  // Add hover effect to session cards
  const sessionCards = document.querySelectorAll('.session-card');
  sessionCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.cursor = 'default';
    });
  });
});
