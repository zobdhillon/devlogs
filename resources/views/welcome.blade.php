<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevLogs — Track your learning journey</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:700,800|plus-jakarta-sans:400,500,600"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="page">

        {{-- Orbs --}}
        <div class="orb orb-tl" aria-hidden="true"></div>
        <div class="orb orb-tr" aria-hidden="true"></div>
        <div class="orb orb-br" aria-hidden="true"></div>
        <div class="orb orb-bl" aria-hidden="true"></div>

        {{-- NAV --}}
        <nav class="welcome-nav">
            <x-logo-sm />
            <div class="welcome-nav-btns">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-ghost">Log in</a>
                    <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                @endauth
            </div>
        </nav>

        {{-- HERO --}}
        <section class="welcome-hero">
            <h1 class="welcome-h1">
                Track your<br>
                <span class="welcome-h1-accent">learning journey</span>
            </h1>
            <p class="welcome-tagline">
                Log your progress, set goals, save resources and share your developer story with the world.
            </p>
            <div class="welcome-hero-btns">
                <a href="{{ route('register') }}" class="btn-lg btn-lg-primary">Get Started — it's free →</a>
                <a href="#demo" class="btn-lg btn-lg-ghost">See how it works ↓</a>
            </div>
        </section>

        {{-- DEMO --}}
        <section class="welcome-demo" id="demo">
            <div class="demo-label">
                <div class="demo-label-dot"></div> Live demo
            </div>
            <h2 class="demo-title">See how it all <span class="demo-title-accent">works</span></h2>
            <p class="demo-sub">Track progress, manage goals and stay in flow — all in one place.</p>

            {{-- Top grid: Topics + Logs --}}
            <div class="demo-grid">

                {{-- Topics --}}
                <div class="demo-card">
                    <div class="demo-titlebar">
                        <span class="titlebar-dot dot-orange"></span>
                        <span class="titlebar-dot dot-muted"></span>
                        <span class="titlebar-dot dot-purple"></span>
                        <span class="titlebar-label">My Topics</span>
                    </div>
                    <div class="demo-body">
                        <div class="topic-row">
                            <div class="topic-icon" style="background:rgba(97,218,251,0.12)"><i
                                    class="devicon-react-original colored" style="font-size:17px"></i></div>
                            <span class="topic-name">React</span>
                            <div class="topic-track">
                                <div class="topic-fill"
                                    style="width:78%;background:linear-gradient(90deg,#a855f7,#7c3aed);box-shadow:0 0 8px rgba(168,85,247,0.6)">
                                </div>
                            </div>
                            <span class="topic-pct">78%</span>
                        </div>
                        <div class="topic-row">
                            <div class="topic-icon" style="background:rgba(255,45,32,0.12)"><i
                                    class="devicon-laravel-plain colored" style="font-size:17px"></i></div>
                            <span class="topic-name" style="color:#f97316">Laravel</span>
                            <div class="topic-track">
                                <div class="topic-fill"
                                    style="width:65%;background:linear-gradient(90deg,#f97316,#ea580c);box-shadow:0 0 8px rgba(249,115,22,0.5)">
                                </div>
                            </div>
                            <span class="topic-pct">65%</span>
                        </div>
                        <div class="topic-row">
                            <div class="topic-icon" style="background:rgba(65,184,131,0.12)"><i
                                    class="devicon-vuejs-plain colored" style="font-size:17px"></i></div>
                            <span class="topic-name">Vue 3</span>
                            <div class="topic-track">
                                <div class="topic-fill"
                                    style="width:38%;background:#41b883;box-shadow:0 0 6px rgba(65,184,131,0.4)"></div>
                            </div>
                            <span class="topic-pct">38%</span>
                        </div>
                        <div class="topic-row">
                            <div class="topic-icon" style="background:rgba(247,223,30,0.12)"><i
                                    class="devicon-javascript-plain colored" style="font-size:17px"></i></div>
                            <span class="topic-name">JavaScript</span>
                            <div class="topic-track">
                                <div class="topic-fill"
                                    style="width:52%;background:#f7df1e;box-shadow:0 0 6px rgba(247,223,30,0.3)"></div>
                            </div>
                            <span class="topic-pct">52%</span>
                        </div>
                        <div class="topic-row">
                            <div class="topic-icon" style="background:rgba(49,120,198,0.12)"><i
                                    class="devicon-typescript-plain colored" style="font-size:17px"></i></div>
                            <span class="topic-name">TypeScript</span>
                            <div class="topic-track">
                                <div class="topic-fill"
                                    style="width:20%;background:#3178c6;box-shadow:0 0 6px rgba(49,120,198,0.4)"></div>
                            </div>
                            <span class="topic-pct">20%</span>
                        </div>
                    </div>
                </div>

                {{-- Recent Logs --}}
                <div class="demo-card">
                    <div class="demo-titlebar">
                        <span class="titlebar-dot dot-orange"></span>
                        <span class="titlebar-dot dot-muted"></span>
                        <span class="titlebar-dot dot-purple"></span>
                        <span class="titlebar-label">Recent Logs</span>
                    </div>
                    <div class="demo-body">
                        <div class="log-row">
                            <span class="log-dot" style="background:#a855f7;box-shadow:0 0 8px #a855f7"></span>
                            <div>
                                <div class="log-title">Finished React hooks deep dive</div>
                                <div class="log-meta">React · 2 hours ago · mood 5/5</div>
                            </div>
                        </div>
                        <div class="log-row">
                            <span class="log-dot" style="background:#f97316;box-shadow:0 0 8px #f97316"></span>
                            <div>
                                <div class="log-title">Set up Laravel Breeze auth flow</div>
                                <div class="log-meta">Laravel · yesterday · mood 4/5</div>
                            </div>
                        </div>
                        <div class="log-row">
                            <span class="log-dot" style="background:#41b883;box-shadow:0 0 6px #41b883"></span>
                            <div>
                                <div class="log-title">Explored Vue 3 Composition API</div>
                                <div class="log-meta">Vue 3 · 2 days ago · mood 3/5</div>
                            </div>
                        </div>
                        <div class="log-row">
                            <span class="log-dot"
                                style="background:#f7df1e;box-shadow:0 0 6px rgba(247,223,30,0.6)"></span>
                            <div>
                                <div class="log-title">JS async/await patterns</div>
                                <div class="log-meta">JavaScript · 3 days ago · mood 4/5</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Full width Dashboard --}}
            <div class="demo-card demo-card-full">
                <div class="demo-titlebar">
                    <span class="titlebar-dot dot-orange"></span>
                    <span class="titlebar-dot dot-muted"></span>
                    <span class="titlebar-dot dot-purple"></span>
                    <span class="titlebar-label">Dashboard — @zobia_dev</span>
                </div>
                <div class="demo-body">
                    <div class="demo-stats">
                        <div class="demo-stat">
                            <div class="demo-stat-icon"
                                style="background:rgba(168,85,247,0.2);box-shadow:0 0 12px rgba(168,85,247,0.2)">📝
                            </div>
                            <div>
                                <div class="demo-stat-num">24</div>
                                <div class="demo-stat-label">Total logs</div>
                            </div>
                        </div>
                        <div class="demo-stat">
                            <div class="demo-stat-icon"
                                style="background:rgba(168,85,247,0.2);box-shadow:0 0 12px rgba(168,85,247,0.2)">📚
                            </div>
                            <div>
                                <div class="demo-stat-num"
                                    style="color:#a855f7;text-shadow:0 0 20px rgba(168,85,247,0.5)">5</div>
                                <div class="demo-stat-label">Active topics</div>
                            </div>
                        </div>
                        <div class="demo-stat">
                            <div class="demo-stat-icon"
                                style="background:rgba(249,115,22,0.2);box-shadow:0 0 12px rgba(249,115,22,0.2)">🎯
                            </div>
                            <div>
                                <div class="demo-stat-num"
                                    style="color:#f97316;text-shadow:0 0 20px rgba(249,115,22,0.5)">3</div>
                                <div class="demo-stat-label">Goals due soon</div>
                            </div>
                        </div>
                    </div>
                    <div class="demo-dash-cols">
                        <div>
                            <div class="demo-col-heading">Goals</div>
                            <div class="demo-goal-row"><span class="demo-goal-check demo-goal-done-check"></span><span
                                    class="demo-goal-label demo-goal-label-done">Complete React course</span><span
                                    class="demo-goal-date demo-goal-date-done">Done</span></div>
                            <div class="demo-goal-row"><span class="demo-goal-check"></span><span
                                    class="demo-goal-label">Build Laravel API</span><span class="demo-goal-date">Jun
                                    15</span></div>
                            <div class="demo-goal-row"><span class="demo-goal-check"></span><span
                                    class="demo-goal-label">Ship public profile</span><span class="demo-goal-date">Jun
                                    30</span></div>
                            <div class="demo-goal-row"><span class="demo-goal-check"></span><span
                                    class="demo-goal-label">Learn TypeScript basics</span><span
                                    class="demo-goal-date">Jul 10</span></div>
                        </div>
                        <div>
                            <div class="demo-col-heading">Saved Resources</div>
                            <div class="log-row"><span class="log-dot"
                                    style="background:#a855f7;box-shadow:0 0 8px #a855f7"></span>
                                <div>
                                    <div class="log-title">React docs — useEffect</div>
                                    <div class="log-meta">docs · React</div>
                                </div>
                            </div>
                            <div class="log-row"><span class="log-dot"
                                    style="background:#f97316;box-shadow:0 0 8px #f97316"></span>
                                <div>
                                    <div class="log-title">Laracasts — Livewire v3</div>
                                    <div class="log-meta">video · Laravel</div>
                                </div>
                            </div>
                            <div class="log-row"><span class="log-dot"
                                    style="background:#41b883;box-shadow:0 0 6px #41b883"></span>
                                <div>
                                    <div class="log-title">Vue 3 migration guide</div>
                                    <div class="log-meta">article · Vue 3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Glow CTA --}}
            <div class="glow-btn-wrap">
                <a href="{{ route('register') }}" class="glow-btn">Get Started — it's free →</a>
            </div>

        </section>

    </body>

</html>
