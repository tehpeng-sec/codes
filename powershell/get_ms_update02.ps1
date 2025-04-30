### Install the module from the PowerShell Gallery (must be run as Admin)
Install-Module -Name MsrcSecurityUpdates -Force
Import-module MsrcSecurityUpdates
$monthOfInterest = '2025-Apr'

Get-MsrcCvrfDocument -ID $monthOfInterest -Verbose | Get-MsrcSecurityBulletinHtml -Verbose | Out-File /Users/swamps/Development/vscode/codes/MSRCAprilSecurityUpdates.html