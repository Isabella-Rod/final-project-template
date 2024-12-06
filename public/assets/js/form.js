document.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contact-form");

    if (contactForm) {
        contactForm.addEventListener("submit", async (event) => {
            event.preventDefault(); 

            const formData = new FormData(contactForm);
            const formObject = Object.fromEntries(formData.entries());

            console.log("Form data being sent:", formObject); 

            try {
                const response = await fetch('/submit-contact', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formObject),
                });

                const result = await response.json();
                console.log("Server response:", result); 
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
