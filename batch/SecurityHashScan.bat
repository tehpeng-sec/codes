@echo off

rem delete results older than 180 days
forfiles -p "C:\SecurityHashScan" -s -m *.txt -d -180 -c "cmd /c del @path"

set C_Hash=c:\%computername%_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt
set C_Excluded=c:\%computername%_C_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt
set C_Result=c:\%computername%_Result_C_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt

set D_Hash=c:\%computername%_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt
set D_Excluded=c:\%computername%_D_drive_excluded_%date:~10,4%%date:~4,2%%date:~7,2%.txt
set D_Result=c:\%computername%_Result_D_drive_%date:~10,4%%date:~4,2%%date:~7,2%.txt

cd\

ECHO Hashing all files in C drive to SHA1, SHA256 and MD5.
hashdeep64.exe -r -c sha1,sha256,md5 c:\ > %C_Hash% 2> %C_Excluded%
ECHO:

hashdeep64.exe -r -c sha1,sha256,md5 D:\ > %D_Hash% 2> %D_Excluded%
ECHO:

ECHO Compared hashes
findstr /g:c:\SecurityHashScan\hash.txt %C_Hash% > %C_Result%
findstr /g:c:\SecurityHashScan\hash.txt %D_Hash% > %D_Result%

ECHO:
ECHO Moving hashed files to SECURITY HASH SCAN folder...
md c:\SecurityHashScan\
MOVE %C_Hash% C:\SecurityHashScan\
MOVE %C_Excluded% C:\SecurityHashScan\
MOVE %C_Result% C:\SecurityHashScan\

MOVE %D_Hash% C:\SecurityHashScan\
MOVE %D_Excluded% C:\SecurityHashScan\
MOVE %D_Result% C:\SecurityHashScan\

ECHO:
ECHO Completed. 
ECHO:
ECHO Go to C:\SecurityHashScan and check the result file:-
ECHO - %C_Result%
type %C_Result%
ECHO - %D_Result%
type %D_Result%
ECHO: 
pause
exit