# MahaYouth.in — VS Code Website Installer

React + Vite frontend for MahaYouth, with SkillBridge as its employment and skilling initiative. Includes career pages/sections, responsive layout, candidate and employer forms, PHP API starter and MySQL schema.

## 1. Requirements
Install **Node.js LTS**, **Git**, and **VS Code**:
- https://nodejs.org/
- https://git-scm.com/downloads
- https://code.visualstudio.com/

## 2. Run in VS Code (Windows)
1. Extract this ZIP.
2. Open the extracted `mahayouth-vscode-installer` folder in VS Code.
3. Double-click `install.bat`, or open Terminal and run:
   ```powershell
   npm install
   npm run dev
   ```
4. Open the local URL shown (usually http://localhost:5173).

## 3. Push to your existing GitHub repository
Replace `YOUR-GITHUB-USERNAME` below with your GitHub username. If your repository already has a README/commit, clone it first, then copy these project files into the cloned folder.
```powershell
git clone https://github.com/YOUR-GITHUB-USERNAME/mahayouth.git
```
Copy project files into the cloned `mahayouth` folder, then:
```powershell
git add .
git commit -m "Create MahaYouth website"
git push origin main
```
If the repo is empty and you use the extracted folder directly:
```powershell
git init
git branch -M main
git add .
git commit -m "Initial MahaYouth website"
git remote add origin https://github.com/YOUR-GITHUB-USERNAME/mahayouth.git
git push -u origin main
```

## 4. Publish a GitHub Pages preview
The included `.github/workflows/deploy.yml` builds and deploys the frontend when you push to `main`. In GitHub, go to **Settings > Pages** and select **GitHub Actions** as the source. Check **Actions** if the build fails. The preview URL should look like `https://YOUR-GITHUB-USERNAME.github.io/mahayouth/`.

GitHub Pages serves only static files. PHP and MySQL do not run on GitHub Pages; the forms display a demo-mode confirmation and do not save information until the Hostinger API is configured.

## 5. Hostinger deployment (later)
1. In Hostinger hPanel, connect `mahayouth.in`, enable SSL and create a MySQL database/user.
2. Import `database/schema.sql` through phpMyAdmin after selecting your database.
3. Edit `api/config.php` with Hostinger database credentials and confirm the allowed origin.
4. Build the site for the root domain:
   ```powershell
   npm run build:hostinger
   ```
5. Upload the **contents** of `dist/` into `public_html/`.
6. Upload `api/` into `public_html/api/`.
7. Create `.env.production` before building with:
   ```
   VITE_API_BASE_URL=https://mahayouth.in/api
   VITE_BASE_PATH=/
   ```
   Then run `npm run build:hostinger` again and upload the updated `dist/` contents.

## Security and launch notes
- Never commit real database passwords to GitHub.
- The PHP API uses prepared statements and basic validation, but this is a starter, not a production-ready recruitment system.
- Before collecting real candidate data, finalise a privacy notice, CAPTCHA/rate limiting, email notifications, secure admin access, data retention policy and backups.
- Images are remote Unsplash URLs and need an internet connection.
- Employment and wage claims are intentionally not presented as verified statistics. Add sourced statistics only after checking the precise definition and source.
