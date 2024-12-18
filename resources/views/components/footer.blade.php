<footer class="bg-gray-700 text-white py-2 mt-10">
    <div class="container mx-auto px-6">
        <!-- Upper section (Logo and Info) -->
        <div class="flex flex-col md:flex-row justify-between items-center md:items-start">
            <div class="text-center md:text-left mb-6 md:mb-0">
                <img class="h-12 mb-4 mx-auto md:mx-0" src="{{asset('assets/img/logo.png')}}" alt="Logo">
                <p class="text-sm text-gray-400 mb-2">Rajshahi, Bangladesh</p>
                <p class="text-sm text-gray-400">Email: lamislam4444@gmail.com</p>
            </div>

            <!-- Social Media Icons -->
            <div class="flex justify-center md:justify-start gap-6 mb-6 md:mb-0">
                <a href="{{url('https://www.linkedin.com/in/lamislamdev/')}}" target="_blank" class="text-gray-300 hover:text-gray-100 transition-colors duration-300">
                  <img class="h-10" src="{{asset('assets/img/footer/linkedin.svg')}}">
                </a>
                <a href="{{url('https://www.facebook.com/lamislamdev')}}" target="_blank" class="text-gray-300 hover:text-gray-100 transition-colors duration-300">
                    <img class="h-10" src="{{asset('assets/img/footer/facebook.svg')}}">
                </a>
                <a href="{{url('https://https://wa.me/8801933482545')}}" target="_blank" class="text-gray-300 hover:text-gray-100 transition-colors duration-300">
                    <img class="h-10" src="{{asset('assets/img/footer/whatsapp.svg')}}">
                </a>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="flex justify-center md:justify-between md:flex-row flex-col items-center space-y-4 md:space-y-0 mt-6">
            <a href="#" class="text-sm text-gray-400 hover:text-gray-100 transition-colors duration-300">Privacy Policy</a>
            <a href="#" class="text-sm text-gray-400 hover:text-gray-100 transition-colors duration-300">Terms of Service</a>
            <a href="{{url('https://www.linkedin.com/in/lamislamdev/')}}" class="text-sm text-gray-400 hover:text-gray-100 transition-colors duration-300">Contact Me</a>
        </div>

        <!-- Copyright -->
        <div class="mt-6 text-center text-sm text-gray-400">
            <p>&copy; 2024 Lam Islam. All rights reserved.</p>
        </div>
    </div>
</footer>
