<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Debtwise - Knowledge Portal</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    .hero-section {
        background: linear-gradient(135deg, #2e1065 0%, #7e22ce 100%);
    }

    .card-hover:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }

    .chat-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .chat-widget.minimized {
        width: 60px;
        height: 60px;
    }

    .chat-widget.expanded {
        width: 380px;
        height: 600px;
    }

    .chat-messages {
        height: calc(100% - 120px);
        overflow-y: auto;
    }

    .typing-indicator span {
        animation: blink 1.4s infinite both;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes blink {
        0% {
            opacity: 0.1;
        }

        20% {
            opacity: 1;
        }

        100% {
            opacity: 0.1;
        }
    }

    .chat-message {
        max-width: 80%;
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #ef4444;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
