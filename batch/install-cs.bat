@echo off
set PROXY-IP=8.8.8.8
set PROXY-PORT=443
set HF-IP=127.0.0.1
set HF-PORT1=8089
set HF-PORT2=9997

:: Use PowerShell to test the network connection
powershell -command "Test-NetConnection -ComputerName %PROXY-IP% -Port %PROXY-PORT%" | findstr "TcpTestSucceeded: True" >nul

:: TelNet Proxy
if %errorlevel% neq 0 (
    echo Connection to proxy failed
    exit /b 1
) else (
    echo Connection to proxy is successful

    powershell -command "Test-NetConnection -ComputerName %HF-IP% -Port %HF-PORT1%" | findstr "TcpTestSucceeded: True" >nul

    :: TelNet HF
    if %errorlevel% neq 0 (
        echo Connection to HF at port %HF-PORT1% failed
        exit /b 1

    ) else (
        echo Connection to HF at port %HF-PORT1% is successful

        powershell -command "Test-NetConnection -ComputerName %HF-IP% -Port %HF-PORT2%" | findstr "TcpTestSucceeded: True" >nul

        if %errorlevel% neq 0 (
            echo Connection to HF at port %HF-PORT2% failed
            exit /b 1
        ) else (
            echo Connection to HF at port %HF-PORT2% is successful

            :: Install CS
            cmd WindowsSensor.exe /install /quiet /norestart CID=<your CID> APP_PROXYNAME=%PROXY-IP% APP_PROXYPORT=%PROXY-PORT% /log %cd%\%computername%_cs.txt
        )
    )

)