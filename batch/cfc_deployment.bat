@echo off
set PROXY-IP=8.8.8.8
set PROXY-PORT=443
set HF-IP=127.0.0.1
set HF-PORT1=8089
set HF-PORT2=9997

:: Use PowerShell to test Proxy connection
powershell -command "Test-NetConnection -ComputerName %PROXY-IP% -Port %PROXY-PORT%" | findstr "TcpTestSucceeded: True" >nul

:: TelNet Proxy
if %errorlevel% neq 0 (
    echo Connection to proxy failed
    exit /b 1
) else (
    echo Connection to proxy is successful
)

:: Use PowerShell to test Heavy Forwarder connection
powershell -command "Test-NetConnection -ComputerName %HF-IP% -Port %HF-PORT1%" | findstr "TcpTestSucceeded: True" >nul

:: TelNet HF
if %errorlevel% neq 0 (
    echo Connection to HF failed at %HF-PORT1%.
    exit /b 1
) else (
    echo Connection to proxy is successful at %HF-PORT1%.
)

powershell -command "Test-NetConnection -ComputerName %HF-IP% -Port %HF-PORT2%" | findstr "TcpTestSucceeded: True" >nul

if %errorlevel% neq 0 (
    echo Connection to HF failed at %HF-PORT2%.
    exit /b 1
) else (
    echo Connection to proxy is successful at %HF-PORT2%.
)