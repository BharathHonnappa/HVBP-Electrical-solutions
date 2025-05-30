document.getElementById("send-button").addEventListener("click", sendMessage);

function sendMessage() {
    let userInput = document.getElementById("user-input").value;
    if (userInput.trim() === "") return;

    let chatBox = document.getElementById("chat-box");
    let userMessage = document.createElement("p");
    userMessage.textContent = "You: " + userInput;
    chatBox.appendChild(userMessage);

    document.getElementById("user-input").value = "";

    setTimeout(() => {
        let botMessage = document.createElement("p");
        botMessage.textContent = "Bot: Thank you for your issue. We'll resolve it soon!";
        chatBox.appendChild(botMessage);
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 1000);
}
