@echo off

rem delete results older than 180 days
forfiles -p "C:\SecurityHashScan" -s -m *.txt -d -180 -c "cmd /c del @path"


ECHO:
cd\
ECHO Hashing all files in C drive to SHA1, SHA256 and MD5.
ECHO Please be patient as this will take a while ...
hashdeep64.exe -r -c sha1,sha256,md5 c:\ > c:\%computername%_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt 2> C:\%computername%_C_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt
ECHO:

ECHO Hashing all files in D drive to SHA1, SHA256 and MD5.
ECHO Please be patient as this will take a while ...
hashdeep64.exe -r -c sha1,sha256,md5 D:\ > c:\%computername%_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt 2> C:\%computername%_D_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt
ECHO:

REM ECHO Hashing all files in E drive to SHA1, SHA256 and MD5.
REM ECHO Please be patient as this will take a while ...
REM hashdeep64.exe -r -c sha1,sha256,md5 E:\ > c:\%computername%_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt 2> C:\%computername%_E_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt
REM ECHO:

ECHO Comparing hashes...
findstr /g:c:\SecurityHashScan\hash.txt c:\%computername%_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt > c:\%computername%_Result_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt
findstr /g:c:\SecurityHashScan\hash.txt c:\%computername%_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt > c:\%computername%_Result_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt
REM findstr /g:c:\SecurityHashScan\hash.txt c:\%computername%_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt > c:\%computername%_Result_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt

ECHO:
ECHO Moving hashed files to SECURITY HASH SCAN folder...
md c:\SecurityHashScan\

MOVE c:\%computername%_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
MOVE c:\%computername%_C_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
MOVE c:\%computername%_Result_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\

MOVE c:\%computername%_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
MOVE c:\%computername%_D_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
MOVE c:\%computername%_Result_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\

REM MOVE c:\%computername%_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
REM MOVE c:\%computername%_E_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\
REM MOVE c:\%computername%_Result_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt C:\SecurityHashScan\

ECHO:
ECHO Completed. 
ECHO:
ECHO Go to C:\SecurityHashScan and check the result file:-
ECHO  - "%computername%_Result_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt"
ECHO  - "%computername%_Result_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt"
REM ECHO  - "%computername%_Result_E_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt"
dir /o-d C:\SecurityHashScan\
ECHO:
pause
exit
