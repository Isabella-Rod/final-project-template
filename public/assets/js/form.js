document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contact-form");

    if (contactForm) {
        contactForm.addEventListener("submit", async (event) => {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData(contactForm);
            const formObject = Object.fromEntries(formData.entries());

            console.log("Form data being sent:", formObject); // Log data for debugging

            try {
                const response = await fetch('/submit-contact', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formObject), // Send JSON data
                });

                const result = await response.json();
                console.log("Server response:", result); // Debug response

                if (result.success) {
                    alert(result.message);
                    contactForm.reset();
                } else {
                    alert(result.message || 'Something went wrong.');
                }
            } catch (error) {
                console.error('Error submitting the form:', error);
                alert('An error occurred.');
            }
        });
    } else {
        console.error("Contact form not found.");
    }
});
