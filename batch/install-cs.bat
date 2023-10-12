@echo off
set HOST=8.8.8.8
set PORT=443

:: Use PowerShell to test the network connection
powershell -command "Test-NetConnection -ComputerName %HOST% -Port %PORT%" | findstr "TcpTestSucceeded: True" >nul

:: Check the errorlevel to see if the connection was successful
if %errorlevel% neq 0 (
    echo Test-NetConnection to %HOST%:%PORT% failed.
    exit /b 1
) else (
    echo Test-NetConnection to %HOST%:%PORT% was successful.
    ping %HOST%
)

:: Continue with the rest of your script here