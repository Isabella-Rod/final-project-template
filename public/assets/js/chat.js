document.addEventListener("DOMContentLoaded", () => {
    const chatInput = document.getElementById("chat-input"); 
    const chatSubmit = document.getElementById("chat-submit"); 
    const chatHistory = document.querySelector(".chat-messages"); 
    const chatOptions = document.querySelectorAll(".chat-option"); 

    async function sendMessage(message) {
        const userBubble = document.createElement("div");
        userBubble.className = "chat-bubble user";
        userBubble.innerText = message;
        chatHistory.appendChild(userBubble);

        const botBubble = document.createElement("div");
        botBubble.className = "chat-bubble bot";
        botBubble.innerText = "Thinking...";
        chatHistory.appendChild(botBubble);

        chatHistory.scrollTop = chatHistory.scrollHeight;

        try {
            const response = await fetch('/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message }),
            });

            const data = await response.json();
            botBubble.innerText = data.response || "Sorry, something went wrong!";
        } catch (error) {
            botBubble.innerText = "Error: Unable to connect to the server.";
        }

        chatHistory.scrollTop = chatHistory.scrollHeight;
    }

    chatSubmit.addEventListener("click", () => {
        const message = chatInput.value.trim();
        if (message) {
            sendMessage(message); 
            chatInput.value = ""; 
        }
    });

    chatInput.addEventListener("keypress", (event) => {
        if (event.key === "Enter" && !event.shiftKey) {
            event.preventDefault(); 
            const message = chatInput.value.trim();
            if (message) {
                sendMessage(message); 
                chatInput.value = ""; 
        }
    }
    });

    chatOptions.forEach(option => {
        option.addEventListener("click", () => {
            const message = option.innerText; 
            sendMessage(message); 
        });
    });
});

