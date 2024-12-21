<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI-Powered Smart Calculator | Solve Math Instantly</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Experience the future of calculations with our AI-powered smart calculator. Solve equations, math problems, and more with speed and accuracy. Try it online for free!">
    <meta name="keywords" content="AI calculator, smart calculator, math solver, online calculator, AI math tool">
    <meta name="author" content="Lam Islam">

    <!-- Open Graph / Social Media -->
    <meta property="og:title" content="AI-Powered Smart Calculator | Solve Math Instantly">
    <meta property="og:description" content="Solve math problems, equations, and calculations with our advanced AI-powered smart calculator. Perfect for students, professionals, and engineers.">
    <meta property="og:image" content="{{asset('assets/img/appImage.png')}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:type" content="website">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="AI-Powered Smart Calculator">
    <meta name="twitter:description" content="Try our AI-powered calculator to solve equations and math problems instantly. Available online for free.">
    <meta name="twitter:image" content="{{asset('assets/img/appImage.png')}}">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/logo.png')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/coustom.css')}}">

    <!-- Structured Data for Rich Snippets -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "AI-Powered Smart Calculator",
            "url": "{{url()->current()}}",
            "description": "An AI-powered calculator to solve equations, math problems, and calculations with precision and ease.",
            "applicationCategory": "EducationalApplication",
            "operatingSystem": "Web",
            "author": {
            "@type": "Person",
            "name": "Lam Islam",
            "url": "{{url('/')}}"
        },
        "image": "{{asset('assets/img/appImage.png')}}",
        "offers": {
            "@type": "Offer",
            "price": "0.00",
            "priceCurrency": "USD",
            "availability": "https://schema.org/InStock"
        }
    }
    </script>
</head>
<body class="bg-gray-950 overscroll-y-contain font-[Poppins]">

<!-- Include Components -->
@yield('component')

<!-- Footer -->
@include('components.footer')

<!-- Scripts -->
<link rel="stylesheet" href="{{asset('assets/js/app.js')}}">
<script src="{{asset('assets/js/axios.min.js')}}"></script>
<script src="{{asset('assets/js/marked.min.js')}}"></script>
</body>
</html>
