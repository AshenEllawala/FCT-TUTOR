document.addEventListener('DOMContentLoaded', () => {
    const tutorCardsContainer = document.getElementById('tutorCardsContainer');

    // Sample data for tutors
    const tutors = [
        { name: "P.Sahani Amami", email: "sahani-ct21002@gmail.kln.ac", avatar: "" },
        { name: "K.L. Perera", email: "perera.k@university.edu", avatar: "" },
        { name: "A.B. Silva", email: "silva.a@example.com", avatar: "" },
        { name: "J.N. Fernando", email: "fernando.j@academia.org", avatar: "" },
        { name: "C.D. Ranasinghe", email: "rana.c@email.com", avatar: "" },
        { name: "M.R. Jayasinghe", email: "jayasinghe.m@tutor.edu", avatar: "" },
    ];

    // Function to create a single tutor card HTML
    function createTutorCard(tutor) {
        const card = document.createElement('div');
        card.classList.add('tutor-card');

        card.innerHTML = `
            <div class="tutor-avatar">
                ${tutor.avatar ? `<img src="${tutor.avatar}" alt="${tutor.name}">` : ''}
            </div>
            <div class="tutor-info">
                <h3>${tutor.name}</h3>
                <p>${tutor.email}</p>
                <button class="view-profile-btn">View Profile</button>
            </div>
        `;

        // Add event listener to the "View Profile" button
        const viewProfileBtn = card.querySelector('.view-profile-btn');
        viewProfileBtn.addEventListener('click', () => {
            // You can redirect to a tutor profile page or show a modal
            window.location.href = `tutor_profile.html?name=${encodeURIComponent(tutor.name)}`;
        });

        return card;
    }

    // Function to render all tutor cards
    function renderTutorCards() {
        tutorCardsContainer.innerHTML = ''; // Clear existing cards
        
        if (tutors.length === 0) {
            tutorCardsContainer.innerHTML = '<p style="text-align: center; color: #666; grid-column: 1/-1;">No tutors available at the moment.</p>';
            return;
        }

        tutors.forEach(tutor => {
            tutorCardsContainer.appendChild(createTutorCard(tutor));
        });
    }

    // Initial render
    renderTutorCards();
});