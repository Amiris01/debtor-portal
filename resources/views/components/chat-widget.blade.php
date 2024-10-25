<div
    x-data="{
        isOpen: false,
        messages: [],
        newMessage: '',
        isTyping: false,
        unreadCount: 0,

        init() {
            if (sessionStorage.getItem('chatMessages')) {
                this.messages = JSON.parse(sessionStorage.getItem('chatMessages'));
            }

            if (sessionStorage.getItem('isChatOpen')) {
                this.isOpen = JSON.parse(sessionStorage.getItem('isChatOpen'));
            }

            this.$watch('messages', (value) => {
                this.$nextTick(() => {
                    this.$refs.chatMessages.scrollTop = this.$refs.chatMessages.scrollHeight;
                });

                sessionStorage.setItem('chatMessages', JSON.stringify(this.messages));
            });

            this.$watch('isOpen', (value) => {
                sessionStorage.setItem('isChatOpen', JSON.stringify(this.isOpen));
            });
        },

        sendMessage() {
            if (this.newMessage.trim() === '') return;

            this.messages.push({
                type: 'user',
                content: this.newMessage.trim()
            });

            const messageToSend = this.newMessage.trim();
            this.newMessage = '';
            this.isTyping = true;

            $.post('/chatbot/send', {
                message: messageToSend,
                user_id: 'user123',
                _token: '{{ csrf_token() }}'
            }).done((response) => {
                this.isTyping = false;

                response.forEach(msg => {
                    if (msg.text) {
                        this.messages.push({
                            type: 'agent',
                            content: msg.text
                        });
                    }
                });

                sessionStorage.setItem('chatMessages', JSON.stringify(this.messages));
            }).fail(() => {
                this.isTyping = false;
                this.messages.push({
                    type: 'agent',
                    content: 'Sorry, there was an error sending your message. Please try again.'
                });
            });
        }
    }"
    class="chat-widget fixed bottom-6 right-6 z-50 shadow-2xl"
    :class="isOpen ? 'expanded' : 'minimized'"
>


    <!-- Chat Header -->
    <div class="bg-purple-600 text-white p-2 py-0 rounded-t-lg flex justify-between items-center shadow-md">
        <template x-if="!isOpen">
            <button
                @click="isOpen = true"
                class="w-14 h-14 flex items-center justify-center rounded-full bg-purple-600 hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 shadow-lg transform hover:scale-105 transition-transform"
            >
                <i class="fas fa-comments text-2xl"></i>
                <div
                    x-show="unreadCount > 0"
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full animate-pulse"
                    x-text="unreadCount"
                ></div>
            </button>
        </template>
        <template x-if="isOpen">
            <div class="flex justify-between items-center w-full">
                <div class="flex items-center gap-2">
                    <div class="bg-white p-1.5 rounded-full">
                        <i class="fas fa-comments text-purple-600"></i>
                    </div>
                    <div class="-mt-0.5" style="margin-top: 15px;">
                        <p class="font-semibold leading-tight" style="margin-bottom: 0px;">Chat Support</p>
                        <p class="text-xs text-purple-200 leading-tight">We typically reply within seconds</p>
                    </div>
                </div>
                <button
                    @click="isOpen = false"
                    class="p-1.5 hover:bg-purple-700 rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </template>
    </div>

    <!-- Chat Content -->
    <template x-if="isOpen">
        <div class="bg-white rounded-b-lg flex flex-col chat-content">
            <!-- Messages Container -->
            <div
                x-ref="chatMessages"
                class="flex-1 p-3 space-y-4 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-gray-100"
            >
                <!-- Welcome Message -->
                <div class="text-center text-gray-500 text-sm border-b border-gray-100">
                    <p class="mb-1">Welcome to Debtwise Support</p>
                    <p>How can we help you today?</p>
                </div>

                <template x-for="(message, index) in messages" :key="index">
                    <div
                        class="chat-message flex"
                        :class="message.type === 'user' ? 'justify-end' : 'justify-start'"
                    >
                        <div class="flex items-end gap-2 max-w-[80%]">
                            <template x-if="message.type === 'agent'">
                                <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-headset text-purple-600 text-xs"></i>
                                </div>
                            </template>
                            <div
                                class="rounded-2xl p-2 shadow-sm"
                                :class="message.type === 'user' ? 'bg-purple-600 text-white rounded-tr-none' : 'bg-gray-100 text-gray-800 rounded-tl-none'"
                            >
                                <div x-text="message.content" class="text-sm"></div>
                            </div>
                            <template x-if="message.type === 'user'">
                                <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-purple-600 text-xs"></i>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Typing Indicator -->
                <div
                    x-show="isTyping"
                    class="flex items-center space-x-2 text-gray-500"
                >
                    <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-headset text-purple-600 text-xs"></i>
                    </div>
                    <div class="bg-gray-100 rounded-2xl p-2">
                        <div class="typing-indicator text-sm">
                            Agent is typing
                            <span>.</span>
                            <span>.</span>
                            <span>.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <div class="border-t bg-gray-50 p-2 rounded-b-lg">
                <form @submit.prevent="sendMessage" class="relative">
                    <div class="flex items-center space-x-2">
                        <div class="relative flex-1">
                            <input
                                type="text"
                                x-model="newMessage"
                                class="w-full rounded-full border-2 border-gray-200 px-4 py-2 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 text-gray-700 bg-white"
                                placeholder="Type your message"
                            >
                        </div>
                        <button
                            type="submit"
                            class="bg-purple-600 text-white p-2 rounded-full hover:bg-purple-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2"
                        >
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <style>
        .chat-widget {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .chat-widget.minimized {
            width: 60px;
            height: 60px;
        }

        .chat-widget.expanded {
            width: min(420px, calc(100vw - 48px));
            height: min(700px, calc(100vh - 48px));
        }

        @media (max-width: 640px) {
            .chat-widget.expanded {
                width: 100vw;
                height: 100vh;
                right: 0 !important;
                bottom: 0 !important;
            }
        }

        .chat-content {
            height: calc(100% - 48px);
        }

        .chat-messages::-webkit-scrollbar {
            width: 5px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 5px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #ccc;
        }

        .typing-indicator span {
            animation: blink 1.4s infinite both;
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: currentColor;
            margin: 0 1px;
        }

        @keyframes blink {
            0%, 100% { opacity: 0.2; }
            20% { opacity: 1; }
        }

        .chat-widget.minimized {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            overflow: hidden;
        }

        .chat-widget button {
            transition: all 0.3s ease;
        }

        .chat-widget button:hover {
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
        }
    </style>
</div>
