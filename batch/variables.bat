@echo off

set var_1=c:\%computername%_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt

cd \

ECHO Hashed files in C:\Users\adminsys\Downloads
hashdeep64.exe -r -c sha1,sha256,md5 C:\Users\adminsys\Downloads > %var_1%
ECHO:

ECHO Completed
ECHO %var_1%
type %var_1%
ECHO:
pause
exit