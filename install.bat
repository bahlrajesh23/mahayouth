@echo off
title MahaYouth Website Installer
echo === MahaYouth.in Website Installer ===
where node >nul 2>nul
if errorlevel 1 (echo Install Node.js LTS from https://nodejs.org/ then retry.& pause & exit /b 1)
where npm >nul 2>nul
if errorlevel 1 (echo npm not found. Reinstall Node.js LTS.& pause & exit /b 1)
node --version
npm --version
call npm install
if errorlevel 1 (echo npm install failed. Check internet and retry.& pause & exit /b 1)
call npm run dev
pause
