# Tech Context: Bayswater Laravel Application

**Technologies Used:**
- **Backend:** PHP (Laravel Framework)
- **Frontend:** HTML, CSS (Tailwind CSS), JavaScript (likely Alpine.js or Vue.js via Vite)
- **Database:** To be confirmed (likely MySQL/PostgreSQL)
- **Web Server:** XAMPP (implies Apache or Nginx)
- **Package Managers:** Composer (PHP), npm (JavaScript)
- **Build Tool:** Vite (`vite.config.js`)

**Development Setup:**
- **Environment:** Windows 11 with XAMPP.
- **IDE/Editor:** VS Code.
- **Version Control:** Git (`.gitattributes`, `.gitignore`).

**Technical Constraints:**
- Must run within the XAMPP environment.
- Compatibility with the specific PHP and Node.js versions used by XAMPP and the project dependencies.

**Dependencies:**
- Managed via `composer.json` (PHP) and `package.json` (JS). Key dependencies include Laravel framework, Tailwind CSS, Vite.
- Specific database drivers based on the chosen database.

**Tool Usage Patterns:**
- `artisan`: Laravel command-line tool for tasks like migrations, seeding, route listing, etc.
- `npm run dev`: To run the Vite development server for frontend assets.
- `npm run build`: To build frontend assets for production.
- `composer install/update`: To manage PHP dependencies.
- `npm install/update`: To manage JavaScript dependencies.
- MCP Servers: Integrated via `cline_mcp_settings.json` for extended capabilities.
