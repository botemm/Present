@echo off
cd /d "%~dp0"
set "PHP_TEMP=%~dp0home\AppData\temp"
if not exist "%PHP_TEMP%" mkdir "%PHP_TEMP%"
Modules\PHP\PHP_7.3-x64\php.exe -d upload_tmp_dir="%PHP_TEMP%" -d sys_temp_dir="%PHP_TEMP%" -d session.save_path="%PHP_TEMP%" -S 0.0.0.0:8000 -t home