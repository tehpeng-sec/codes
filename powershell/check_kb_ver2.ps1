$newdir = New-Item -ItemType Directory -Path ".\$((Get-Date).ToString('dd-MM-yyyy'))"

$A = Get-Content -Path C:\checkkb\Servers.txt

$A | ForEach-Object {
    Invoke-Command -ComputerName $_ -ScriptBlock{Get-HotFix | where {$_.InstalledOn -gt "09/01/2022" -AND $_.InstalledOn -lt "09/30/2022" } | sort InstalledOn} > $newdir\$_.txt
}