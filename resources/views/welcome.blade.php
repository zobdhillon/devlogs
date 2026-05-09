<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevLogs — Track your learning journey</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:700,800|plus-jakarta-sans:400,500,600"
            rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="page devlog-bg">

        {{-- Starfield --}}
        <div class="stars" aria-hidden="true">
            <div class="star star-1"></div>
            <div class="star star-2"></div>
            <div class="star star-3"></div>
            <div class="star star-4"></div>
            <div class="star star-5"></div>
            <div class="star star-6"></div>
            <div class="star star-7"></div>
            <div class="star star-8"></div>
            <div class="star star-9"></div>
            <div class="star star-10"></div>
            <div class="star star-11"></div>
            <div class="star star-12"></div>
        </div>

        {{-- ===================== ABOVE THE FOLD ===================== --}}

        <div class="welcome-top">
            {{-- Navbar --}}
            <nav class="welcome-nav">
                <x-logo />
                <div class="welcome-nav-btns">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-ghost">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                        <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                    @endauth
                </div>
            </nav>

            {{-- Hero --}}
            <section class="welcome-hero">
                <div class="welcome-radial" aria-hidden="true"></div>

                <h1 class="welcome-h1">
                    Track your<br>
                    <span class="welcome-h1-accent">learning journey</span>
                </h1>

                <p class="welcome-tagline">
                    Log your progress, set goals, save resources and share<br>
                    your developer story with the world.
                </p>

                <a href="#demo" class="btn-primary btn-lg welcome-demo-btn">
                    See a demo
                    <span class="welcome-demo-arr" aria-hidden="true">↓</span>
                </a>

                <div class="welcome-scroll-hint" aria-hidden="true">
                    <div class="welcome-scroll-line"></div>
                    <span class="welcome-scroll-label">scroll to explore</span>
                </div>
            </section>
        </div>

        {{-- ===================== BELOW THE FOLD — DEMO ===================== --}}

        <section class="welcome-demo-section" id="demo">

            <p class="welcome-demo-eyebrow">Live demo</p>
            <h2 class="welcome-demo-title">See how it all <span class="welcome-demo-title-accent">works</span></h2>

            {{-- Top row: Topics + Recent Logs --}}
            <div class="welcome-demo-grid">

                {{-- Topics progress --}}
                <div class="welcome-demo-card">
                    <div class="welcome-demo-titlebar">
                        <span class="titlebar-dot dot-terracotta"></span>
                        <span class="titlebar-dot dot-muted"></span>
                        <span class="titlebar-dot dot-accent"></span>
                        <span class="titlebar-label">My Topics</span>
                    </div>
                    <div class="welcome-demo-body">
                        <div class="topic-progress-row">
                            <span class="topic-progress-name" style="color: #7c6af0;">React</span>
                            <div class="topic-progress-track">
                                <div class="topic-progress-fill" style="width: 78%; background: #7c6af0;"></div>
                            </div>
                            <span class="topic-progress-pct">78%</span>
                        </div>
                        <div class="topic-progress-row">
                            <span class="topic-progress-name" style="color: #c4785a;">Laravel</span>
                            <div class="topic-progress-track">
                                <div class="topic-progress-fill" style="width: 65%; background: #c4785a;"></div>
                            </div>
                            <span class="topic-progress-pct">65%</span>
                        </div>
                        <div class="topic-progress-row">
                            <span class="topic-progress-name" style="color: #9b92b8;">Vue 3</span>
                            <div class="topic-progress-track">
                                <div class="topic-progress-fill" style="width: 38%; background: #9b92b8;"></div>
                            </div>
                            <span class="topic-progress-pct">38%</span>
                        </div>
                        <div class="topic-progress-row">
                            <span class="topic-progress-name" style="color: #9b92b8;">JavaScript</span>
                            <div class="topic-progress-track">
                                <div class="topic-progress-fill" style="width: 52%; background: #4a4168;"></div>
                            </div>
                            <span class="topic-progress-pct">52%</span>
                        </div>
                        <div class="topic-progress-row">
                            <span class="topic-progress-name" style="color: #9b92b8;">TypeScript</span>
                            <div class="topic-progress-track">
                                <div class="topic-progress-fill" style="width: 20%; background: #9b92b8;"></div>
                            </div>
                            <span class="topic-progress-pct">20%</span>
                        </div>
                    </div>
                </div>

                {{-- Recent Logs --}}
                <div class="welcome-demo-card">
                    <div class="welcome-demo-titlebar">
                        <span class="titlebar-dot dot-terracotta"></span>
                        <span class="titlebar-dot dot-muted"></span>
                        <span class="titlebar-dot dot-accent"></span>
                        <span class="titlebar-label">Recent Logs</span>
                    </div>
                    <div class="welcome-demo-body">
                        <div class="demo-log-row">
                            <span class="demo-log-dot" style="background: #7c6af0;"></span>
                            <div class="demo-log-content">
                                <div class="demo-log-title">Finished React hooks deep dive</div>
                                <div class="demo-log-meta">React &middot; 2 hours ago &middot; mood 5/5</div>
                            </div>
                        </div>
                        <div class="demo-log-row">
                            <span class="demo-log-dot" style="background: #c4785a;"></span>
                            <div class="demo-log-content">
                                <div class="demo-log-title">Set up Laravel Breeze auth flow</div>
                                <div class="demo-log-meta">Laravel &middot; yesterday &middot; mood 4/5</div>
                            </div>
                        </div>
                        <div class="demo-log-row">
                            <span class="demo-log-dot" style="background: #9b92b8;"></span>
                            <div class="demo-log-content">
                                <div class="demo-log-title">Explored Vue 3 Composition API</div>
                                <div class="demo-log-meta">Vue 3 &middot; 2 days ago &middot; mood 3/5</div>
                            </div>
                        </div>
                        <div class="demo-log-row">
                            <span class="demo-log-dot" style="background: #4a4168;"></span>
                            <div class="demo-log-content">
                                <div class="demo-log-title">JS async/await patterns</div>
                                <div class="demo-log-meta">JavaScript &middot; 3 days ago &middot; mood 4/5</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Full-width Dashboard preview --}}
            <div class="welcome-demo-card welcome-demo-card-full">
                <div class="welcome-demo-titlebar">
                    <span class="titlebar-dot dot-terracotta"></span>
                    <span class="titlebar-dot dot-muted"></span>
                    <span class="titlebar-dot dot-accent"></span>
                    <span class="titlebar-label">Dashboard — @ali_dev</span>
                </div>
                <div class="welcome-demo-body">

                    {{-- Stats row --}}
                    <div class="demo-stats-row">
                        <div class="demo-stat">
                            <div class="demo-stat-number">24</div>
                            <div class="demo-stat-label">Total logs</div>
                        </div>
                        <div class="demo-stat">
                            <div class="demo-stat-number" style="color: #7c6af0;">5</div>
                            <div class="demo-stat-label">Active topics</div>
                        </div>
                        <div class="demo-stat">
                            <div class="demo-stat-number" style="color: #c4785a;">3</div>
                            <div class="demo-stat-label">Goals due soon</div>
                        </div>
                    </div>

                    {{-- Goals + Resources --}}
                    <div class="demo-dash-columns">

                        <div class="demo-dash-col">
                            <div class="demo-col-heading">Goals</div>
                            <div class="demo-goal-row">
                                <span class="demo-goal-check demo-goal-done" aria-label="completed"></span>
                                <span class="demo-goal-label">Complete React course</span>
                                <span class="demo-goal-date">Done</span>
                            </div>
                            <div class="demo-goal-row">
                                <span class="demo-goal-check demo-goal-open" aria-label="pending"></span>
                                <span class="demo-goal-label">Build Laravel API</span>
                                <span class="demo-goal-date">Jun 15</span>
                            </div>
                            <div class="demo-goal-row">
                                <span class="demo-goal-check demo-goal-open" aria-label="pending"></span>
                                <span class="demo-goal-label">Ship public profile</span>
                                <span class="demo-goal-date">Jun 30</span>
                            </div>
                            <div class="demo-goal-row">
                                <span class="demo-goal-check demo-goal-open" aria-label="pending"></span>
                                <span class="demo-goal-label">Learn TypeScript basics</span>
                                <span class="demo-goal-date">Jul 10</span>
                            </div>
                        </div>

                        <div class="demo-dash-col">
                            <div class="demo-col-heading">Saved Resources</div>
                            <div class="demo-log-row">
                                <span class="demo-log-dot" style="background: #7c6af0;"></span>
                                <div class="demo-log-content">
                                    <div class="demo-log-title">React docs — useEffect</div>
                                    <div class="demo-log-meta">docs &middot; React</div>
                                </div>
                            </div>
                            <div class="demo-log-row">
                                <span class="demo-log-dot" style="background: #c4785a;"></span>
                                <div class="demo-log-content">
                                    <div class="demo-log-title">Laracasts — Livewire v3</div>
                                    <div class="demo-log-meta">video &middot; Laravel</div>
                                </div>
                            </div>
                            <div class="demo-log-row">
                                <span class="demo-log-dot" style="background: #9b92b8;"></span>
                                <div class="demo-log-content">
                                    <div class="demo-log-title">Vue 3 migration guide</div>
                                    <div class="demo-log-meta">article &middot; Vue 3</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="welcome-demo-cta pt-6 flex justify-center">
                <a href="{{ route('register') }}" class="btn-primary btn-lg">Get Started — it's free →</a>
            </div>
        </section>

    </body>

</html>
