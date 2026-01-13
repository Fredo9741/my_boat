#!/usr/bin/env python3
"""
Script pour scraper les bateaux du backoffice MyBoat
et générer automatiquement un BateauSeeder Laravel

Requirements:
    pip install selenium webdriver-manager

Usage:
    1. Copiez ce fichier vers scrape_backoffice.py
    2. Remplacez USERNAME et PASSWORD par vos identifiants
    3. Exécutez: python scripts/scrape_backoffice.py
"""

import json
import time
import re
from datetime import datetime
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from webdriver_manager.chrome import ChromeDriverManager

# Configuration
BACKOFFICE_URL = "https://www.myboat-oi.com/backoffice/bateaux/"
LOGIN_URL = "https://www.myboat-oi.com/login"
USERNAME = "YOUR_USERNAME_HERE"  # ⚠️ REMPLACEZ PAR VOTRE USERNAME
PASSWORD = "YOUR_PASSWORD_HERE"  # ⚠️ REMPLACEZ PAR VOTRE PASSWORD

# ... reste du code inchangé ...
# (Le reste du fichier reste identique, seuls les credentials sont remplacés)
