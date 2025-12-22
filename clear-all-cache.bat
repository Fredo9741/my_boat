@echo off
echo ==========================================
echo   VIDAGE DE TOUS LES CACHES
echo ==========================================
echo.

echo [1/5] Vidage du cache de configuration Laravel...
php artisan config:clear
echo.

echo [2/5] Vidage du cache d'application Laravel...
php artisan cache:clear
echo.

echo [3/5] Vidage du cache des vues Blade...
php artisan view:clear
echo.

echo [4/5] Vidage du cache des routes...
php artisan route:clear
echo.

echo [5/5] Tentative de vidage du cache OPcache...
php -r "if (function_exists('opcache_reset')) { opcache_reset(); echo 'OPcache vide avec succes!\n'; } else { echo 'OPcache non disponible en CLI.\n'; }"
echo.

echo ==========================================
echo   TOUS LES CACHES ONT ETE VIDES !
echo ==========================================
echo.
echo Pour vider OPcache via le navigateur :
echo http://localhost/my_boat/public/clear-opcache.php
echo.

pause
