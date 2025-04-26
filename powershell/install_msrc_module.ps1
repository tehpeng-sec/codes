### Install the module from the PowerShell Gallery
Install-Module -Name MsrcSecurityUpdates -Scope CurrentUser

### Load the module if PowerShell is at least version 5.1
if ($PSVersionTable.PSVersion -gt [version]'5.1') {
 Import-Module -Name MsrcSecurityUpdates
}