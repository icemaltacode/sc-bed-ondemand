echo off

goto(){
# Linux/macOS
cd src/client
php -S localhost:8001 index.php
}

goto $@
exit

:(){
rem Windows
cd src\client
php -S localhost:8001 index.php
exit