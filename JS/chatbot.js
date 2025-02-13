document.addEventListener("DOMContentLoaded", function () {
    const chatbox = document.getElementById("chatbox");
    const chatInput = document.getElementById("chat-input");
    const sendButton = document.getElementById("send-btn");

    sendButton.addEventListener("click", function () {
        const userMessage = chatInput.value.trim();
        if (userMessage === "") return;

        appendMessage("You", userMessage);
        chatInput.value = "";

        // Send message to PHP backend
        fetch("chatbot.php", {
            method: "POST",
            body: JSON.stringify({ message: userMessage }),
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.json())
        .then(data => {
            appendMessage("Bot", data.reply);
        })
        .catch(error => console.error("Error:", error));
    });

    function appendMessage(sender, text) {
        const messageElement = document.createElement("p");
        messageElement.innerHTML = `<strong>${sender}:</strong> ${text}`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }
});
