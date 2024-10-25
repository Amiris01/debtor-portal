<!DOCTYPE html>
<html lang="en">
<head>
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
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-purple-600">
                        <img src="{{ asset('debtwise-word.png') }}" alt="Debtwise Logo" class="h-8">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-white hover:text-purple-600 no-underline">Home</a>
                    <a href="#" class="text-white hover:text-purple-600 no-underline">Resources</a>
                    <a href="#" class="text-white hover:text-purple-600 no-underline">Legal Rights</a>
                    <a href="#" class="text-white hover:text-purple-600 no-underline">Contact</a>
                    <a href="/login"><button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Login</button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-white py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Take Control of Your Financial Future</h1>
                    <p class="text-xl mb-8">Learn about your rights, manage your debt, and make informed financial decisions.</p>
                    <div class="flex space-x-4">
                        <button class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition duration-200">Get Started</button>
                        <a href="#" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition duration-200 no-underline">Learn More</a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center md:justify-end">
                    <img src="{{ asset('debtwise-logo.png') }}" width="400px" class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Cards -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md card-hover">
                <div class="text-purple-600 mb-4">
                    <i class="fas fa-money-bill-wave text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Payment Information</h3>
                <p class="text-gray-600 mb-4">Learn about payment methods, schedules, and handling late fees.</p>
                <a href="#" class="text-purple-600 hover:text-purple-800 no-underline">Learn more →</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md card-hover">
                <div class="text-purple-600 mb-4">
                    <i class="fas fa-book-reader text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Debt Education</h3>
                <p class="text-gray-600 mb-4">Understanding different types of debt and management strategies.</p>
                <a href="#" class="text-purple-600 hover:text-purple-800 no-underline">Learn more →</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md card-hover">
                <div class="text-purple-600 mb-4">
                    <i class="fas fa-balance-scale text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Legal Rights</h3>
                <p class="text-gray-600 mb-4">Know your rights and protections under debt collection laws.</p>
                <a href="#" class="text-purple-600 hover:text-purple-800 no-underline">Learn more →</a>
            </div>
        </div>
    </div>

    <!-- Featured Resources -->
    <div class="bg-purple-50 py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-8 text-center">Featured Resources</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Resource Cards -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md card-hover">
                    <img src="{{ asset('debttype.jpg') }}" alt="Debt Management" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-2">Understanding Debt Types</h3>
                        <p class="text-gray-600 mb-4">Learn about secured and unsecured debt, and how they affect you.</p>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Read More</button>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md card-hover">
                    <img src="{{ asset('baddebt.jfif') }}" alt="Debt Management" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-2">Consequences of Unpaid Debt</h3>
                        <p class="text-gray-600 mb-4">Learn about consequences of bad debt management, and how they affect you.</p>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Read More</button>
                    </div>
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-md card-hover">
                    <img src="{{ asset('debtmanagement.jfif') }}" alt="Debt Management" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="font-semibold text-xl mb-2">Managing and Reducing Debt</h3>
                        <p class="text-gray-600 mb-4">Learn about how to manage and reduce your debt.</p>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold mb-6 text-center">Need Help?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <i class="fas fa-phone text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                    <p class="text-gray-600">1-800-DEBTWISE</p>
                    <p class="text-gray-600">Mon-Fri: 9AM-5PM</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-envelope text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                    <p class="text-gray-600">support@debtwise.com</p>
                    <p class="text-gray-600">24/7 Support</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-comments text-4xl text-purple-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Live Chat</h3>
                    <p class="text-gray-600">Chat with an expert</p>
                    <a href="/chat"><button class="mt-2 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Start Chat</button></a>
                </div>
            </div>
        </div>
    </div>

    @include('components.chat-widget')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-xl font-semibold mb-4">About Debtwise</h4>
                    <p class="text-gray-400">Empowering individuals with knowledge and resources to manage their debt effectively.</p>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Resources</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Legal Rights</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 Debtwise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 500);
            });

            $(window).scroll(function() {
                $('.card-hover').each(function() {
                    if ($(this).isInViewport()) {
                        $(this).addClass('animate__animated animate__fadeInUp');
                    }
                });
            });

            $.fn.isInViewport = function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                return elementBottom > viewportTop && elementTop < viewportBottom;
            };
        });
    </script>
</body>
</html>
