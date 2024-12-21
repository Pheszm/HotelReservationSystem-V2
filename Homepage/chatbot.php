<style>
    /* Basic styles for chatbot */
    #chatbot {
    display: none;
    position: fixed;
    bottom: 0;
    right: 0;
    width: 300px;
    height: 400px;
    background-color: white;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    z-index: 10000;
}

    #chatbot header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    /* Style for the Send button */
#sendButton {
    padding: 6px 15px;
    margin-left: 10px;
    border: none;
    border-radius: 5px;
    background-color: #ffc800;
    color: black;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
    position: relative;
    bottom: 20px;
}

#sendButton:hover {
    background-color: #ffc800;
}
.chat-input {
    display: flex;
    align-items: center;
    padding: 10px;
    border-top: 1px solid #ccc;
    background-color: #f9f9f9;
}

/* Style for the input field */
#userInput {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}
    #chatbot .close-btn {
        cursor: pointer;
    }

    #chatbot .chat-content {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
    }

    #chatbot input {
        width: calc(100% - 20px);
        padding: 10px;
        margin-top: -45px;
    }

    .bot-profile,
    .user-profile {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        /* Makes it a circle */
        margin-right: 10px;
        object-fit: cover;
        /* Ensure images fit properly */
    }

    .bot span {
        display: inline-block;
        max-width: 80%;
    }

    .bot {
        justify-content: flex-start;
        /* Align bot messages to the left */
        text-align: left;
        margin-bottom: 20px;
    }

    /* User message styling */
    .user {
        justify-content: flex-end;
        /* Align user messages to the right */
        text-align: right;
        margin-bottom: 20px;

    }   
</style>
<!-- Chatbot Button -->
<img id="chatbotbtn" src="assets/img/ChatBotImg.png" class="position-fixed bottom-0 end-0 m-4" alt="Chatbot Button">

<!-- Chatbot popup -->
<div id="chatbot">
    <header>
        Chat with Assistant Bot
    </header>
    <div class="chat-content" id="chatContent">
        <!-- Messages will appear here -->
    </div>
    <div class="chat-input">
        <input type="text" id="userInput" placeholder="Type a message...">
        <button id="sendButton">  >   </button>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatbotBtn = document.getElementById('chatbotbtn');
    const chatbot = document.getElementById('chatbot');
    const userInput = document.getElementById('userInput');
    const sendButton = document.getElementById('sendButton');
    const chatContent = document.getElementById('chatContent');

    // Open chatbot when button is clicked
    chatbotBtn.addEventListener('click', function () {
        chatbot.style.display = chatbot.style.display === 'none' || chatbot.style.display === '' ? 'block' : 'none';
    });

    // Function to detect repeated words
    function isRepeatingWords(input) {
        const words = input.split(/\s+/);
        const length = words.length;

        if (length === 0) return false;

        for (let i = 0; i < length; i++) {
            if (i < length - 1 && words[i] === words[i + 1]) return true;
            if (i < length - 2 && words[i] === words[i + 2] && words[i + 1] === words[i + 3]) return true;
            if (i < length - 3 && words[i] === words[i + 3] && words[i + 1] === words[i + 4] && words[i + 2] === words[i + 5]) return true;
        }
        return false;
    }

    // Function to send a message
    function sendMessage() {
        const userInputValue = userInput.value.trim();
        if (userInputValue === '') return;

        if (isRepeatingWords(userInputValue)) {
            alert("Warning: It seems you're repeating words. Please ask a valid question.");
            return;
        }

        userInput.value = '';
        displayMessage(userInputValue, 'user');
        getBotResponse(userInputValue.toLowerCase());
    }

    // Add functionality for the "Enter" key
    userInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    // Add functionality for the Send button
    sendButton.addEventListener('click', sendMessage);

    async function getBotResponse(userInput) {
        try {
            let responseMessage;

            if (userInput.includes("hello") || userInput.includes("hi")) {
                responseMessage = "Hello! How can I assist you today?";
            } else if (userInput.includes("how") || userInput.includes("book")) {
                responseMessage = "To book a room, please visit our website or call our reservation desk at (123) 456-7890.";
            } else if (userInput.includes("what to do")) {
                responseMessage = "You can explore local attractions, dine at our restaurant, and enjoy amenities like our spa and pool.";
            } else if (userInput.includes("check in")) {
                responseMessage = "Check-in time is 3:00 PM. Early check-in may be available, please contact the front desk.";
            } else if (userInput.includes("check out")) {
                responseMessage = "Check-out time is 11:00 AM. Late check-out may be available upon request.";
            } else if (userInput.includes("amenities")) {
                responseMessage = "Our hotel offers free Wi-Fi, a gym, a swimming pool, and a restaurant.";
            } else if (userInput.includes("restaurant hours")) {
                responseMessage = "The restaurant is open from 7:00 AM to 10:00 PM daily.";
            } else if (userInput.includes("contact us")) {
                responseMessage = "You can contact us by calling (123) 456-7890 or emailing info@hotel.com.";
            } else if (userInput.includes("payment methods")) {
                responseMessage = "We accept major credit cards, PayPal, and bank transfers.";
            } else if (userInput.includes("pets allowed")) {
                responseMessage = "We do allow pets, subject to certain restrictions. Please contact us for more details.";
            } else if (userInput === "help") {
                responseMessage = "Here are the commands you can use: 'hello' or 'hi', 'how to book', 'what to do', 'check in', 'check out', 'amenities', 'restaurant hours', 'contact us', 'payment methods', 'pets allowed'.";
            } else {
                responseMessage = "Sorry, I could not understand your question. Please try again later.";
            }

            displayMessage(responseMessage, 'bot');
        } catch (error) {
            console.error('Error:', error);
            displayMessage('Sorry, something went wrong. Please try again later.', 'bot');
        }
    }

     // Close chatbot when clicking outside the chatbot box
     document.addEventListener('click', function (event) {
        const isClickInside = chatbot.contains(event.target) || chatbotBtn.contains(event.target);
        if (!isClickInside) {
            chatbot.style.display = 'none';
        }
    });
    function displayMessage(message, type) {
    const chatContent = document.getElementById('chatContent');
    const newMessage = document.createElement('div');
    newMessage.classList.add(type);

    if (type === 'bot') {
        // Create the bot message structure with a placeholder for typing
        newMessage.innerHTML = `
            <img src="assets/img/ChatBotImg.png" class="bot-profile" alt="Bot Profile">
            <span id="typing"></span>
        `;

        chatContent.appendChild(newMessage); // Append the bot message to the chat content

        const typingSpan = newMessage.querySelector('#typing'); // Reference the typing span
        let index = 0;

        // Typing effect: display one character at a time
        const typingInterval = setInterval(() => {
            typingSpan.textContent += message.charAt(index);
            index++;

            if (index === message.length) {
                clearInterval(typingInterval); // Stop typing when the message is fully displayed
            }
        }, 20); // Adjust this interval for typing speed (lower value = faster typing)
    } else {
        // Create the user message
        const tempDiv = document.createElement('div');
        tempDiv.innerText = message; // Escape any HTML tags

        newMessage.innerHTML = `
            <img src="assets/img/Guest.png" class="user-profile" alt="User Profile">
            <span>${tempDiv.innerText}</span>
        `;

        chatContent.appendChild(newMessage); // Append the user message to the chat content
    }

    // Scroll to the bottom of the chat content to show the latest message
    chatContent.scrollTop = chatContent.scrollHeight;
}
function toggleChatbot() {
        chatbot.style.display = 'none';
    }
});

</script>
