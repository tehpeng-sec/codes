Install-Module -Name MsrcSecurityUpdates -Force
Import-Module -Name MsrcSecurityUpdates -Force

$monthOfInterest = "2025-Apr"

$CVEsWanted = @(
        "CVE-2025-27477", 
        "CVE-2025-27478"
        )
$Output_Location = "/Users/swamps/Development/vscode/codes/powershell/"

$CVRFDoc = Get-MsrcCvrfDocument -ID $monthOfInterest -Verbose
$CVRFHtmlProperties = @{
    Vulnerability = $CVRFDoc.Vulnerability | Where-Object {$_.CVE -in $CVEsWanted}
    ProductTree = $CVRFDoc.ProductTree
    DocumentTracking = $CVRFDoc.DocumentTracking
    DocumentTitle = $CVRFDoc.DocumentTitle
}

Get-MsrcSecurityBulletinHtml @CVRFHtmlProperties -Verbose | Out-File $Output_Location