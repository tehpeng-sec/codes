@echo off
setlocal enabledelayedexpansion

:: Define the output CSV file
set OUTPUT_FILE=system_details.csv

:: Create or overwrite the CSV file with a header
(echo Hostname,Network Details,Serial Number,Model Number) > %OUTPUT_FILE%

:: Retrieve and format the system details
for /f "tokens=2 delims=:" %%A in ('hostname') do set "hostname=%%A"
for /f "tokens=2 delims=:" %%B in ('ipconfig ^| find "IPv4 Address"') do set "ipaddress=%%B"
for /f "delims=" %%C in ('wmic bios get serialnumber ^| findstr /v "SerialNumber"') do set "serialnumber=%%C"
for /f "delims=" %%D in ('wmic csproduct get name ^| findstr /v "Name"') do set "modelnumber=%%D"

:: Append the system details to the CSV file
echo !hostname!,!ipaddress!,!serialnumber!,!modelnumber! >> %OUTPUT_FILE%

:: Display a message
echo System details have been saved to %OUTPUT_FILE%

endlocal
