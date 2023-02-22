$servers = "azlogrevpr01"
$results = @()

foreach ($server in $servers) {
    $updates = Invoke-Command -ComputerName $server -ScriptBlock {Get-WmiObject -Class "Win32_QuickFixEngineering"}

    foreach ($update in $updates) {
        $hotfixID = $update.HotFixID
        $description = $update.Description
        $installedOn = $update.InstalledOn

        $result = @{
            Server = $server
            Update = $hotfixID
            Description = $description
            InstalledOn = $installedOn
        }

        $results += $result
    }
}

$results | Format-Table Server, Update, Description, InstalledOn
