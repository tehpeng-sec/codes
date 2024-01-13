# Create an object to store system information
$systemInfo = [PSCustomObject]@{
    Hostname = $env:COMPUTERNAME
    IPAddresses = (Get-NetIPAddress | Where-Object { $_.AddressFamily -eq 'IPv4' }).IPAddress
    SerialNumber = (Get-WmiObject -Class Win32_BIOS).SerialNumber
    BIOSVersion = (Get-WmiObject -Class Win32_BIOS).Version
    InstalledPatches = Get-HotFix | Select-Object -Property HotFixID, InstalledOn
    InstalledPrograms = Get-Package | Select-Object Name, Version, ProviderName
}

# Convert the object to JSON
$jsonSystemInfo = $systemInfo | ConvertTo-Json -Depth 5

# Save the JSON to a file
$jsonSystemInfo | Out-File -FilePath "SystemInfo.json"
