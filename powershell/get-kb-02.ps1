$serverName = "azlogrevpr01"
$updates = Invoke-Command -ComputerName $serverName -ScriptBlock {Get-WmiObject -Class "Win32_QuickFixEngineering"}

foreach ($update in $updates) {
    $hotfixID = $update.HotFixID
    $description = $update.Description
    $installedOn = $update.InstalledOn

    Write-Output "Update: $hotfixID"
    Write-Output "Description: $description"
    Write-Output "Installed On: $installedOn"
    Write-Output ""
}