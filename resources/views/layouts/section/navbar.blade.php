<header>
    <nav class="navbar navbar-expand-lg" role="navigation" aria-label="Main navigation">
        <div class="d-flex align-items-center gap-3">
            <button class="navbar-toggler icon-btn d-lg-none" id="hambBtn" aria-label="Open menu" title="Open menu">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="1.6" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
            <a href="index.html" class="navbar-brand">
                <div class="brand-text">
                    <img src="{{ asset('assets/images/logo-black.png') }}" alt="logo">
                </div>
            </a>
        </div>

        <!-- Header actions -->
        <div class="d-flex gap-2 ms-auto" role="group" aria-label="Header actions">
            <!-- Collapse toggle -->
            <button class="icon-btn d-none d-lg-grid" id="collapseBtn" aria-pressed="false" title="Collapse sidebar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path stroke="currentColor" stroke-width="1.6" stroke-linecap="round" d="M9 6l6 6-6 6" />
                </svg>
            </button>
            <!-- Theme Toggle -->
            <button class="icon-btn" id="themeToggle" aria-label="Toggle theme" title="Toggle light/dark mode">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" id="themeIcon">
                    <path stroke="currentColor" stroke-width="1.6"
                        d="M12 17a5 5 0 100-10 5 5 0 000 10zM12 3v2M12 19v2M5 12H3M21 12h-2M6.34 6.34l-1.41 1.41M19.07 19.07l-1.41 1.41" />
                </svg>
            </button>
            <!-- Profile Dropdown -->
            <div class="dropdown profile-dropdown">
                <div class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false" role="button">
                    <div class="profile" id="profileBtn" tabindex="0" title="Account">
                        <div class="avatar">M</div>
                        <div class="name d-none d-md-block">Miller</div>
                    </div>
                </div>

                <ul class="dropdown-menu dropdown-menu-end mt-2">
                    <li>
                        <h6 class="dropdown-header">Settings</h6>
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="fa-regular fa-user"></i> Profile
                            Settings</a></li>
                    <li>
                        <div class="sign-out">
                            <a class="dropdown-item text-danger" href="#"><i
                                    class="fa-solid fa-right-from-bracket"></i> Sign out</a>
                        </div>
                    </li>
                </ul>

            </div>


        </div>
    </nav>
</header>
