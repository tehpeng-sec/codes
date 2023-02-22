@echo off
echo Retrieving installed Windows updates...
wmic qfe list full /format:htable > "%userprofile%\Desktop\InstalledUpdates.html"
echo Installed updates saved to desktop as InstalledUpdates.html