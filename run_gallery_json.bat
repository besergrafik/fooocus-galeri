@echo off
cd /d %~dp0
echo [✔] Klasör: %CD%
echo [🔁] JSON oluşturuluyor...
python generate_gallery_json.py
pause
