<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panelry Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.ico" type="image/x-icon">
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/icons/fontawesome/css/solid.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets') }}/plugin/select2/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/board.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/chat.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Theme Toggle -->
    <div class="theme-toggle">
        <button class="theme-btn" id="themeToggle">
            <i class="bi bi-sun" id="themeIcon"></i>
        </button>
    </div>
    <div class="auth-container" id="loginPage">
        <div class="form-side">
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your Panelry account</p>
            </div>

            <form class="auth-form" id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="loginEmail">Email Address</label>
                    <input type="email" class="form-input" id="loginEmail" placeholder="you@example.com" required>
                    <div class="error-message" id="emailError" style="display: none;">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Please enter a valid email address</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loginPassword">Password</label>
                    <input type="password" class="form-input" id="loginPassword" placeholder="Enter your password"
                        required>
                    <button type="button" class="password-toggle" id="loginPasswordToggle">
                        <i class="bi bi-eye"></i>
                    </button>
                    <div class="error-message" id="passwordError" style="display: none;">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Password must be at least 8 characters</span>
                    </div>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me for 30 days</label>
                    <a href="forgot-password.html" class="form-link ms-auto">Forgot password?</a>
                </div>

                <button type="submit" class="btn-primary" id="loginBtn">
                    <span>Sign In</span>
                </button>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/plugin/chart/chart.js"></script>
    <script src="{{ asset('assets') }}/plugin/select2/js/select2.min.js"></script>
    <script src="{{ asset('assets') }}/js/chart.js"></script>
    <script src="{{ asset('assets') }}/js/chat.js"></script>
    <script src="{{ asset('assets') }}/js/board.js"></script>
    <script src="{{ asset('assets') }}/js/script.js"></script>
</body>

</html>
