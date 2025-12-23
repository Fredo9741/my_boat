@echo off
REM Script pour exporter les données locales et les déployer sur Railway

echo ==========================================
echo Export et Deploiement des Donnees
echo ==========================================
echo.

REM Étape 1 : Export des données
echo [1/5] Export des donnees locales vers les seeders...
php artisan db:export-to-seeders
if %errorlevel% neq 0 (
    echo Erreur lors de l'export !
    pause
    exit /b 1
)
echo.

REM Étape 2 : Test local
echo [2/5] Test de l'import en local...
echo Voulez-vous tester l'import en local ? (O/N)
set /p test_local="> "
if /i "%test_local%"=="O" (
    echo Attention : Cela va reinitialiser votre base locale !
    echo Confirmer ? (O/N)
    set /p confirm="> "
    if /i "%confirm%"=="O" (
        php artisan migrate:fresh --seed
        if %errorlevel% neq 0 (
            echo Erreur lors du test local !
            pause
            exit /b 1
        )
        echo Test local reussi !
    )
)
echo.

REM Étape 3 : Git add
echo [3/5] Ajout des seeders a Git...
git add database/seeders/
git status --short
echo.

REM Étape 4 : Git commit
echo [4/5] Creation du commit...
echo Entrez le message de commit (ou appuyez sur Entree pour le message par defaut) :
set /p commit_msg="> "
if "%commit_msg%"=="" (
    set commit_msg=Update production seeders with local data
)
git commit -m "%commit_msg%"
if %errorlevel% neq 0 (
    echo Aucun changement a commiter ou erreur lors du commit
    echo.
)

REM Étape 5 : Git push
echo [5/5] Push vers Railway...
echo Voulez-vous pusher vers Railway maintenant ? (O/N)
set /p do_push="> "
if /i "%do_push%"=="O" (
    git push
    if %errorlevel% neq 0 (
        echo Erreur lors du push !
        pause
        exit /b 1
    )
    echo.
    echo ==========================================
    echo Deploiement lance sur Railway !
    echo ==========================================
    echo.
    echo Suivez le deploiement sur : https://railway.app
) else (
    echo Push annule. Vous pouvez le faire manuellement avec : git push
)

echo.
echo Script termine !
pause
