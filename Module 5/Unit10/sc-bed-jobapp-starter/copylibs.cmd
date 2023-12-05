echo off

goto(){
# Linux/macOS
echo "Copying"
rm -rf src/client/lib/bootstrap
rm -rf src/client/lib/bootstrap-icons
cp -R vendor/twbs/bootstrap/dist src/client/lib/bootstrap
cp -R vendor/twbs/bootstrap-icons/font src/client/lib/bootstrap-icons
}

goto $@
exit

:(){
rem Windows
rd \s \q src\client\lib\bootstrap
rd \s \q src\client\lib\bootstrap-icons
xcopy vendor\twbs\bootstrap\dist src\client\lib\bootstrap /s /e /y
xcopy vendor\twbs\bootstrap-icons\font src\client\lib\bootstrap-icons /s /e /y
exit