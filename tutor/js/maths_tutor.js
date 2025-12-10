document.addEventListener('DOMContentLoaded', () => {
    const tutorCardsContainer = document.getElementById('tutorCardsContainer');

    // Sample data for tutors
    const tutors = [
        { name: "P.Sahani Amami", email: "sahani-ct21002@gmail.kln.ac", avatar: "", rating: 4.9, experience: "3 years" },
        { name: "K.L. Perera", email: "perera.k@university.edu", avatar: "", rating: 4.7, experience: "2 years" },
        { name: "A.B. Silva", email: "silva.a@example.com", avatar: "", rating: 4.8, experience: "4 years" },
        { name: "J.N. Fernando", email: "fernando.j@academia.org", avatar: "", rating: 4.6, experience: "2 years" },
        { name: "C.D. Ranasinghe", email: "rana.c@email.com", avatar: "", rating: 4.9, experience: "5 years" },
        { name: "M.R. Jayasinghe", email: "jayasinghe.m@tutor.edu", avatar: "", rating: 4.8, experience: "3 years" },
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
                <p class="tutor-email">${tutor.email}</p>
                <div class="tutor-meta">
                    <span class="rating">⭐ ${tutor.rating}</span>
               
                </div>
                <button class="book-session-btn">Book Session</button>
            </div>
        `;

        // Add event listener to the "Book Session" button
        const bookSessionBtn = card.querySelector('.book-session-btn');
        bookSessionBtn.addEventListener('click', () => {
            showBookingModal(tutor);
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

    // Function to show booking modal
    function showBookingModal(tutor) {
        const modal = document.createElement('div');
        modal.className = 'booking-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Book Session with ${tutor.name}</h2>
                <form class="booking-form" id="bookingForm">
                    <div class="form-group">
                        <label>Tutor:</label>
                        <input type="text" value="${tutor.name}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Your Name:</label>
                        <input type="text" id="studentName" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" id="studentEmail" required>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" id="sessionDate" required>
                    </div>
                    <div class="form-group">
                        <label>Time:</label>
                        <select id="sessionTime" required>
                            <option value="">Select Time</option>
                            <option value="8:00 AM">8:00 AM</option>
                            <option value="10:00 AM">10:00 AM</option>
                            <option value="12:00 PM">12:00 PM</option>
                            <option value="2:00 PM">2:00 PM</option>
                            <option value="4:00 PM">4:00 PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Duration:</label>
                        <select id="sessionDuration" required>
                            <option value="">Select Duration</option>
                            <option value="1 hour">1 hour</option>
                            <option value="1.5 hours">1.5 hours</option>
                            <option value="2 hours">2 hours</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Message (Optional):</label>
                        <textarea id="sessionMessage" rows="3" placeholder="Any specific topics you want to cover?"></textarea>
                    </div>
                    <button type="submit" class="submit-booking-btn">Confirm Booking</button>
                </form>
            </div>
        `;

        document.body.appendChild(modal);

        // Close modal functionality
        const closeBtn = modal.querySelector('.close-modal');
        closeBtn.addEventListener('click', () => {
            modal.remove();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });

        // Handle form submission
        const bookingForm = modal.querySelector('#bookingForm');
        bookingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const bookingData = {
                tutor: tutor.name,
                tutorEmail: tutor.email,
                studentName: document.getElementById('studentName').value,
                studentEmail: document.getElementById('studentEmail').value,
                date: document.getElementById('sessionDate').value,
                time: document.getElementById('sessionTime').value,
                duration: document.getElementById('sessionDuration').value,
                message: document.getElementById('sessionMessage').value
            };

            console.log('Booking Data:', bookingData);
            
            alert(`Session booked successfully with ${tutor.name}!\nDate: ${bookingData.date}\nTime: ${bookingData.time}\nDuration: ${bookingData.duration}`);
            
            modal.remove();
        });
    }

    // Initial render
    renderTutorCards();
});