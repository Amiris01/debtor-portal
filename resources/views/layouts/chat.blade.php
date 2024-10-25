<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Debtwise - Chat Assistant</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .chat-container {
            height: calc(100vh - 200px);
        }
        .message-container {
            height: calc(100% - 80px);
        }
        .typing-indicator span {
            animation: blink 1.4s infinite both;
        }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes blink {
            0% { opacity: 0.1; }
            20% { opacity: 1; }
            100% { opacity: 0.1; }
        }
        .message {
            max-width: 80%;
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .user-message {
            background-color: #1e40af;
        }
        .bot-message {
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg chat-container">
            <!-- Chat Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                        <i class="fas fa-robot text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">Debtwise Assistant</h2>
                        <div class="flex items-center text-sm text-green-500">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Online
                        </div>
                    </div>
                </div>
                <button id="clearChat" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-trash"></i>
                </button>
            </div>

            <!-- Chat Messages -->
            <div class="message-container p-4 overflow-y-auto" id="messageContainer">
                <!-- Welcome Message -->
                <div class="flex mb-4">
                    <div class="message bot-message rounded-lg p-4 text-gray-700">
                        <p>👋 Hello! I'm your Debtwise Assistant. How can I help you today?</p>
                        <div class="mt-2 text-sm text-gray-500">
                            You can ask me about:
                            <ul class="list-disc ml-4 mt-1">
                                <li>Debt management tips</li>
                                <li>Payment information</li>
                                <li>Legal rights</li>
                                <li>Financial resources</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Typing Indicator (Hidden by default) -->
            <div id="typingIndicator" class="hidden px-4 py-2">
                <div class="flex items-center space-x-2 text-gray-500">
                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="typing-indicator text-gray-400 text-lg">
                        <span>.</span><span>.</span><span>.</span>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="border-t p-4">
                <form id="chatForm" class="flex items-center space-x-4">
                    <div class="flex-1 relative">
                        <input type="text" id="messageInput" class="w-full px-4 py-2 rounded-full border focus:outline-none focus:border-blue-500" placeholder="Type your message here...">
                        <button type="button" id="suggestionBtn" class="absolute right-3 top-2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-lightbulb"></i>
                        </button>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <!-- Quick Suggestions (Hidden by default) -->
            <div id="suggestionBox" class="hidden absolute bottom-20 left-0 right-0 bg-white rounded-lg shadow-lg p-4 mx-4">
                <h4 class="font-semibold mb-2">Common Questions:</h4>
                <div class="grid grid-cols-2 gap-2">
                    <button class="suggestion-btn text-left p-2 hover:bg-gray-100 rounded">What are my rights as a debtor?</button>
                    <button class="suggestion-btn text-left p-2 hover:bg-gray-100 rounded">How can I manage multiple debts?</button>
                    <button class="suggestion-btn text-left p-2 hover:bg-gray-100 rounded">What payment methods are accepted?</button>
                    <button class="suggestion-btn text-left p-2 hover:bg-gray-100 rounded">How to handle debt collectors?</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize
            const messageContainer = $('#messageContainer');
            const chatForm = $('#chatForm');
            const messageInput = $('#messageInput');
            const typingIndicator = $('#typingIndicator');
            const suggestionBox = $('#suggestionBox');
            const suggestionBtn = $('#suggestionBtn');

            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle form submission
            chatForm.on('submit', function(e) {
                e.preventDefault();
                const message = messageInput.val().trim();
                if (message) {
                    sendMessage(message);
                    messageInput.val('');
                }
            });

            // Handle suggestions
            suggestionBtn.on('click', function() {
                suggestionBox.toggleClass('hidden');
            });

            $('.suggestion-btn').on('click', function() {
                const suggestion = $(this).text();
                messageInput.val(suggestion);
                suggestionBox.addClass('hidden');
                chatForm.submit();
            });

            // Clear chat
            $('#clearChat').on('click', function() {
                if (confirm('Are you sure you want to clear the chat history?')) {
                    messageContainer.html('');
                    // Add welcome message back
                    appendBotMessage("👋 Hello! I'm your Debtwise Assistant. How can I help you today?");
                }
            });

            // Handle message sending
            function sendMessage(message) {
                // Append user message
                appendUserMessage(message);

                // Show typing indicator
                typingIndicator.removeClass('hidden');

                // Scroll to bottom
                scrollToBottom();

                // Make AJAX call to backend
                $.ajax({
                    url: '/chatbot/message',
                    method: 'POST',
                    data: { message: message },
                    success: function(response) {
                        // Hide typing indicator
                        typingIndicator.addClass('hidden');

                        // Append bot response
                        appendBotMessage(response.message);

                        // Scroll to bottom
                        scrollToBottom();
                    },
                    error: function() {
                        typingIndicator.addClass('hidden');
                        appendBotMessage("I apologize, but I'm having trouble processing your request right now. Please try again later.");
                        scrollToBottom();
                    }
                });
            }

            // Append user message
            function appendUserMessage(message) {
                const messageHtml = `
                    <div class="flex justify-end mb-4">
                        <div class="message user-message rounded-lg p-4 text-white">
                            ${escapeHtml(message)}
                        </div>
                    </div>
                `;
                messageContainer.append(messageHtml);
            }

            // Append bot message
            function appendBotMessage(message) {
                const messageHtml = `
                    <div class="flex mb-4">
                        <div class="message bot-message rounded-lg p-4 text-gray-700">
                            ${message}
                        </div>
                    </div>
                `;
                messageContainer.append(messageHtml);
            }

            // Utility functions
            function scrollToBottom() {
                messageContainer.scrollTop(messageContainer[0].scrollHeight);
            }

            function escapeHtml(unsafe) {
                return unsafe
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // Handle window resize
            $(window).on('resize', function() {
                scrollToBottom();
            });
        });
    </script>
</body>
</html>
