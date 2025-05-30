document.getElementById("send-button").addEventListener("click", sendMessage);
document.getElementById("user-input").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
});

function sendMessage() {
    let userInput = document.getElementById("user-input").value.trim();
    if (userInput === "") return;

    let chatBox = document.getElementById("chat-box");

    // User Message
    let userMessage = document.createElement("p");
    userMessage.className = "user-message";
    userMessage.textContent = userInput;
    chatBox.appendChild(userMessage);
    
    document.getElementById("user-input").value = "";
    chatBox.scrollTop = chatBox.scrollHeight;

    // Bot Response
    // Example of simulating a quick response from the bot
    setTimeout(() => {
        let botMessage = document.createElement("p");
        botMessage.className = "bot-message";
        botMessage.textContent = "Can you tell me more about the issue you're facing? (e.g., wiring, outlet issues)";
        chatBox.appendChild(botMessage);
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 1000);

}

function getBotResponse(input) {
    input = input.toLowerCase();
    if (input.includes("hello") || input.includes("hi")) {
        return "Hello! How can I assist you today?";
    } else if (input.includes("electrician") || input.includes("repair")) {
        return "We provide electrical repair services. Please share more details.";
    } else if (input.includes("price") || input.includes("cost")) {
        return "Our pricing depends on the service required. Would you like a quote?";
    } else {
        return "Thank you for your message! Our team will contact you soon.";
    }
}
