# DevLog — Context Capsule v4

## Project
**Name:** DevLogs | **Stack:** Laravel 13 + Blade + Tailwind + Alpine.js + MySQL | **Local URL:** `devlogs.test` | **Path:** `/var/www/html/DevLogs` | **GitHub:** connected

---

## Design System
**Theme:** Dark vivid glow — NOT light, NOT flat dark. Deep purple-black with glowing accents.

**Colors:**
- Background: `#08060f`
- Cards: `rgba(12,8,24,0.8)`
- Border: `rgba(168,85,247,0.15)`
- Text: `#f0ece8`
- Muted: `#8b7fa8`
- Primary: `#a855f7` (purple)
- Accent: `#f97316` (orange)
- Glow purple: `rgba(168,85,247,0.5)`
- Glow orange: `rgba(249,115,22,0.4)`

**Fonts:** Space Grotesk (headings/logo) + Plus Jakarta Sans (body) — Bunny Fonts

**Visual Style:**
- Dot grid background (`page::before`)
- Vivid glowing orbs (`.orb-tl`, `.orb-tr`, `.orb-br`, `.orb-bl`)
- Orb bottom values set to `0` (not negative — caused extra space bug)
- Glowing card borders
- Floating pill navbar (`.app-nav`)
- Tech icons via devicons CDN

---

## CSS Architecture — STRICT RULES
- **NO `<style>` tags in ANY blade file** — exception: EasyMDE overrides added to `app.css`
- **NO inline `style=""` for layout** — use Tailwind utilities
- **`style=""` only allowed for** dynamic values (colors from DB, glow colors)
- **`app.css`** → complex custom styles
- **Tailwind** → layout, spacing, flex, grid, padding, margin, text size

**Key CSS classes:**
- `.page` → welcome page wrapper
- `.orb`, `.orb-tl/tr/br/bl` → glow orbs (bottom:0, not negative)
- `.dash-card` → dark glowing card
- `.dash-add-btn` → small purple action button
- `.dash-badge`, `.dash-badge-active/paused/completed` → status badges
- `.dash-streak`, `.dash-streak-num` → streak widget
- `.btn-ghost`, `.btn-primary` → nav buttons
- `.btn-lg`, `.btn-lg-primary`, `.btn-lg-ghost` → hero buttons
- `.glow-btn`, `.glow-btn-wrap` → big CTA button
- `.auth-card`, `.auth-input`, `.auth-label` → auth form styles
- `.auth-input-username` → username field with `padding-left:24px` for @ prefix
- `.auth-page`, `.auth-wrap`, `.auth-brand` → auth layout
- `.app-nav`, `.nav-link`, `.nav-link-active` → navbar
- `.nav-avatar`, `.nav-user-btn`, `.nav-mobile` → nav elements
- `.welcome-nav`, `.welcome-hero`, `.welcome-h1` → welcome page
- `.demo-card`, `.demo-titlebar`, `.demo-body` → welcome demo cards
- `.topic-color-swatch` → color preset picker
- `.topic-action-btn`, `.topic-delete-btn` → topic edit/delete buttons
- `.custom-select-dropdown`, `.custom-select-option` → Alpine dropdown
- `.icon-picker-grid` → icon dropdown (scrollbar hidden)
- `.topic-color-picker` → color input
- EasyMDE dark theme styles in `app.css`

---

## Database Schema ✅
```
users       — id, name, username (unique), bio, email, password, timestamps
topics      — id, user_id, name, color, icon, status (active/paused/completed), progress, timestamps
logs        — id, user_id, topic_id (nullable), title, body, mood (1-5), timestamps
goals       — id, user_id, topic_id (nullable), title, deadline, is_completed, completed_at, timestamps
resources   — id, user_id, topic_id (nullable), title, url, type (video/article/course/docs), timestamps
```

**Note:** `progress` is in `Topic $fillable` but not used yet — waiting for goals to be fully built.

## Models & Relationships ✅
```php
User → hasMany Topic, Log, Goal, Resource
Topic → belongsTo User
Log/Goal/Resource → belongsTo User + Topic
```
**Important:** `Resource` model aliased in `User.php`:
```php
use App\Models\Resource as UserResource;
public function resources() { return $this->hasMany(UserResource::class); }
```

---

## Routes (`routes/web.php`) ✅
```php
Route::get('/', function () { return view('welcome'); });
Route::get('/u/{username}', [PublicProfileController::class, 'show'])->name('profile.public');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('topics', TopicController::class);
    Route::resource('logs', LogController::class);
    Route::resource('goals', GoalController::class);
    Route::resource('resources', ResourceController::class);
});

require __DIR__ . '/auth.php';
```

---

## Controllers ✅
- **DashboardController** — greeting, stats, topics, logs, goals, logsThisWeek
- **TopicController** — index, store, edit, update, destroy + TopicPolicy
- **LogController** — index, create, store, show, edit, update, destroy + LogPolicy + `use AuthorizesRequests`
- **GoalController** — index, store, edit, update (with toggle_complete), destroy + GoalPolicy + `use AuthorizesRequests`
- **ResourceController** — index, create, store, edit, update, destroy + ResourcePolicy
- **ProfileController** — Breeze default (edit, update, destroy) — handles name, username, bio, email
- **PublicProfileController** — show() — fetches user by username, passes topics, logs (last 5), completedGoals (last 5), stats

**All policies:** TopicPolicy, LogPolicy, GoalPolicy, ResourcePolicy ✅
**Auto-discovered** by Laravel — no manual registration needed.

---

## Views ✅ (all built)
```
welcome.blade.php                          ✅
layouts/app.blade.php                      ✅ uses <x-app-layout>
layouts/guest.blade.php                    ✅
layouts/navigation.blade.php               ✅ custom dropdown (no x-dropdown component)
layouts/public.blade.php                   ❌ → moved to components/public-layout.blade.php
components/public-layout.blade.php         ✅ standalone no-navbar layout for public profile
dashboard.blade.php                        ✅
auth/login.blade.php                       ✅ restyled — remember me + forgot password inline
auth/register.blade.php                    ✅
topics/index.blade.php                     ✅ icon picker + fetch delete
topics/edit.blade.php                      ✅ icon picker
logs/index.blade.php                       ✅ mood emoji + fetch delete
logs/create.blade.php                      ✅ EasyMDE + topic dropdown + emoji mood
logs/edit.blade.php                        ✅ same as create, pre-populated
logs/show.blade.php                        ✅ marked.js markdown render
goals/index.blade.php                      ✅ fetch toggle + fetch delete
goals/edit.blade.php                       ✅
resources/index.blade.php                  ✅
resources/create.blade.php                 ✅
resources/edit.blade.php                   ✅
profile/edit.blade.php                     ✅ name, username, bio, email, password, danger zone
profile/show.blade.php                     ✅ public profile using <x-app-layout>
profile/partials/update-profile-information-form.blade.php ✅ includes username + bio
profile/partials/update-password-form.blade.php            ✅
profile/partials/delete-user-form.blade.php                ✅ custom Alpine modal
```

---

## Navigation ✅
- Custom dropdown (replaced Breeze `x-dropdown` component)
- Avatar style: Option I — circular purple initials + green online dot + name + chevron
- Dropdown shows: user name, @username, Profile, Public Profile, Log Out
- Log Out hover turns red
- Nav wrapper has `z-index:9999` to fix stacking context issues with Alpine dropdowns on topics/goals pages
- `@{{ Auth::user()->username }}` written as `{{ '@' . Auth::user()->username }}` to avoid Blade escaping

---

## Logo ✅
Colors fixed to match design system:
- `#c4785a` → `#f97316` (orange accent)
- `#7c6af0` → `#a855f7` (purple primary)
- Text: `DEV` in `#f0ece8`, `LOGS` in `#f97316`

---

## Key Patterns & Gotchas
- **Layout:** All views use `<x-app-layout>` — NOT `@extends`. Using `@extends` causes `Undefined variable $slot`
- **Alpine JSON:** Pass topics to dropdowns via `data-topics` HTML attribute + `JSON.parse(this.$el.dataset.topics)` in `init()` — avoids Blade/Alpine quote conflicts
- **Fetch delete:** Each deletable row has `x-data="{ deleted: false }"` + `x-show="!deleted"` + fetch POST with `_method: DELETE`
- **Goal toggle:** Fetch PUT with `toggle_complete: 1` — updates `is_completed` + `completed_at` server side, flips Alpine state client side
- **Mood emojis:** `[1=>'😴', 2=>'😑', 3=>'🤔', 4=>'😄', 5=>'⚡']` — used in index, show, create, edit
- **Policy auth:** All controllers use `use AuthorizesRequests` trait (not in base Controller in Laravel 13)
- **Resource model:** Aliased as `UserResource` in controllers to avoid Laravel MCP conflict
- **EasyMDE:** CDN loaded in create/edit blade files, styles in `app.css`
- **marked.js:** CDN loaded in logs/show for markdown rendering
- **Share button:** Uses `execCommand('copy')` fallback for non-HTTPS local dev (`devlogs.test`)
- **Public profile share button:** Shows "Share Profile" to own profile owner, "Create your DevLog →" to guests/other users
- **Orbs:** `bottom: 0` not negative values — negative caused extra space below page

---

## Timezone
`Asia/Karachi` in `config/app.php` ✅

---

## Session / Remember Me
- Remember me checkbox in login ✅
- Add `SESSION_LIFETIME=43200` to `.env` for 30-day remember me

---

## What's NOT Done ❌
- Flash success/error messages (global)
- Progress bars on topics (waiting until goals logic solidified)
- Mobile polish pass
- Favicon
- Deployment to Railway

## Next Priority Order
1. Flash messages globally
2. Favicon
3. Mobile polish
4. Deploy to Railway

---

## How to Resume
Start new chat, paste this capsule and say **"resume DevLogs project"** — ready to continue instantly! 😊