@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../spatie/browsershot/bin/phantomjs
php "%BIN_TARGET%" %*
