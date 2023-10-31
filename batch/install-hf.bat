@echo off
setlocal

/L*v logfile.txt

AGREETOLICENSE=yes SPLUNKUSERNAME=SplunkAdmin SPLUNKPASSWORD=Ch@ng3d!

:: Define the path to the Splunk Heavy Forwarder installer
set SPLUNK_INSTALLER=splunkforwarder-<version>-<platform>.msi /L*v logfile.txt

:: Define the installation directory
set INSTALL_DIR=C:\Program Files\SplunkUniversalForwarder

:: Define the admin password (change to your desired password)
set ADMIN_PASSWORD=your_password

:: Install Splunk Heavy Forwarder
msiexec /i %SPLUNK_INSTALLER% AGREETOLICENSE=Yes INSTALLDIR="%INSTALL_DIR%" /quiet

:: Start Splunk and accept the license
"%INSTALL_DIR%\bin\splunk" start --accept-license

:: Set Splunk to start on boot
"%INSTALL_DIR%\bin\splunk" enable boot-start

:: Change the admin password
"%INSTALL_DIR%\bin\splunk" edit user admin -password %ADMIN_PASSWORD%

:: Restart Splunk
"%INSTALL_DIR%\bin\splunk" restart

:: Display a message
echo Splunk Heavy Forwarder installation is complete.

endlocal
