document.addEventListener("DOMContentLoaded", function () {
    const chatbotIcon = document.getElementById("chatbot-icon");
    const chatbotContainer = document.getElementById("chatbot-container");
    const closeChatbot = document.getElementById("close-chatbot");
    const chatbox = document.getElementById("chatbox");
    const chatInput = document.getElementById("chat-input");
    const sendButton = document.getElementById("send-btn");

    // Toggle chatbot window
    chatbotIcon.addEventListener("click", function () {
        chatbotContainer.style.display = chatbotContainer.style.display === "block" ? "none" : "block";
    });

    // Close chatbot window
    closeChatbot.addEventListener("click", function () {
        chatbotContainer.style.display = "none";
    });

    sendButton.addEventListener("click", sendMessage);
    chatInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") sendMessage();
    });

    function sendMessage() {
        const userMessage = chatInput.value.trim();
        if (userMessage === "") return;

        appendMessage("You", userMessage);
        chatInput.value = "";

        fetch("chatbot.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: userMessage })
        })
        .then(response => response.json())
        .then(data => {
            appendMessage("Bot", data.reply);
        })
        .catch(error => console.error("Error:", error));
    }

    function appendMessage(sender, text) {
        const messageElement = document.createElement("p");
        messageElement.innerHTML = `<strong>${sender}:</strong> ${text}`;
        chatbox.appendChild(messageElement);
        chatbox.scrollTop = chatbox.scrollHeight;
    }
});
