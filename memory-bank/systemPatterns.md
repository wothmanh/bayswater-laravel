# System Patterns: Bayswater Laravel Application

**Architecture:** Standard Laravel MVC (Model-View-Controller).

**Key Technical Decisions:**
- **Framework:** Laravel (PHP)
- **Frontend:** Blade templates, likely with Tailwind CSS and potentially Alpine.js or Vue.js (based on typical Laravel setups and `vite.config.js`).
- **Database:** Relational database (MySQL/PostgreSQL typical for Laravel, specific type defined in `.env` or `config/database.php`). Eloquent ORM is used for database interaction (`app/Models`).
- **Routing:** Defined in `routes/web.php` and `routes/auth.php`.
- **Middleware:** Used for request filtering (e.g., authentication, authorization - see `app/Http/Kernel.php`, `app/Http/Middleware/IsAdmin.php`).
- **Services:** Business logic encapsulated in service classes (e.g., `app/Services/FeeCalculatorService.php`).

**Design Patterns:**
- MVC
- Repository Pattern (Potentially, needs confirmation)
- Service Container for dependency injection
- Facades for static-like access to services
- Observer Pattern (Potentially via Eloquent events)

**Component Relationships:**
- `Controllers` handle requests, interact with `Models` (often via `Services`), and return `Views`.
- `Models` represent database tables and handle data logic.
- `Views` (Blade templates) render the UI.
- `Middleware` intercepts requests before they reach controllers.

**Critical Implementation Paths:**
- User Authentication (`routes/auth.php`, `app/Http/Controllers/Auth/`)
- Quotation Generation (Involves multiple models like `Course`, `Accommodation`, `DiscountRule`, and likely the `FeeCalculatorService`).
- Admin CRUD operations for core data entities (e.g., `Courses`, `Schools`).
