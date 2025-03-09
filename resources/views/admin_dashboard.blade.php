<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Dashboard') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Component -->
        <x-admin.sidebar :activePage="Route::currentRouteName()"/>

        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="javascript:;">{{ config('app.name', 'DASHBOARD') }}</a>
                    </div>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                   
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->

            <!-- Dynamic Content Loader -->
        

            @php
    $messages = [
        "Believe in yourself and all that you are. 💡",
        "Small progress is still progress. Keep going! 📈",
        "Your hard work will pay off. Stay consistent! 💪",
        "Every day is a new opportunity to learn something new. 🎯",
        "The future belongs to those who prepare for it today. 🚀",
        "Success is the sum of small efforts repeated daily. 🔄",
        "Dream big, work hard, and make it happen! 🌟",
        "Mistakes are proof that you are trying. Keep going! 🔥",
        "The only limit to your impact is your imagination. 🌍",
        "Don’t stop until you’re proud. Keep pushing! 🏆",
        "Your mindset determines your success. Think positive! 🌈",
        "Strive for progress, not perfection. 🛤️",
        "Difficult roads often lead to beautiful destinations. 🏔️",
        "Work hard in silence, let success make the noise. 🔊",
        "Winners never quit, and quitters never win. 🏁",
        "Start where you are. Use what you have. Do what you can. 💪",
        "Stay hungry for knowledge, stay foolish for success. 📚",
        "Opportunities don’t happen. You create them. 🔑",
        "Push yourself, because no one else will do it for you. ⚡",
        "Learn from yesterday, live for today, hope for tomorrow. 🌅",
        "Discipline is choosing what you want most over what you want now. 🎯",
        "Your time is now. Make every second count. ⏳",
        "Success starts with self-discipline. 🏋️",
        "Great things never come from comfort zones. 🚀",
        "If you believe in yourself, anything is possible. 💫",
        "Hard work beats talent when talent doesn’t work hard. 🎓",
        "Don’t be afraid of failure. Be afraid of not trying. 🔥",
        "Keep your face always toward the sunshine. 🌞",
        "One day or day one? You decide. ⏳",
        "Doubt kills more dreams than failure ever will. 🚧",
        "Consistency is the key to mastery. 🔑",
        "You are capable of more than you know. 💡",
        "Don’t compare your journey to anyone else’s. 🌍",
        "Growth begins at the end of your comfort zone. 🌱",
        "You don’t have to be perfect to be amazing. 💙",
        "Knowledge is power. Keep learning every day. 📚",
        "Turn your obstacles into opportunities. 🔄",
        "The best way to predict the future is to create it. 🎨",
        "Your only competition is who you were yesterday. 🏃",
        "Fall seven times, stand up eight. 💪",
        "Every expert was once a beginner. Start now! 🚀",
        "Your success is determined by your daily habits. 📆",
        "A year from now, you’ll wish you started today. 🕰️",
        "If it doesn’t challenge you, it won’t change you. 🔥",
        "Education is the passport to the future. 🎓",
        "Take the risk or lose the chance. 🎲",
        "Act as if what you do makes a difference. It does! 💡",
        "Make yourself proud every single day. 🏅",
        "Believe in the power of yet—I haven’t mastered it *yet*! 🔄",
    ];
    $randomMessage = $messages[array_rand($messages)];
@endphp



            <div id="dynamic-content" class="content welcome-message p-4 bg-light rounded shadow-sm">
                <h2 class="text-primary">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-muted">{{ $randomMessage }}</p>
            </div>
            <div id="dynamic-content">
    <!-- Loaded component will appear here -->
            </div>


        </div>
    </div>

    <!-- Core JS Files -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/paper-dashboard.min.js?v=2.0.1') }}"></script>
    <script src="{{ asset('assets/demo/demo.js') }}"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- AJAX Loading Script -->
    <script>
    function loadComponent(element) {
        var componentUrl = $(element).data("component");
        $("#dynamic-content").html("<p>Loading...</p>");


        sessionStorage.setItem("activeComponent", componentUrl);

        $.ajax({
            url: componentUrl,
            type: "GET",
            success: function (data) {
                $("#dynamic-content").html(data);
            },
            error: function () {
                $("#dynamic-content").html("<p>Error loading content.</p>");
            }
        });
        $(".nav li").removeClass("active");
        $(element).parent().addClass("active");
    }


    $(document).ready(function () {
        var activeComponent = sessionStorage.getItem("activeComponent");
        if (activeComponent) {
            loadComponent($(`[data-component="${activeComponent}"]`));
        }
    });
</script>


</body>
</html>
