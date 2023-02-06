$newdir = New-Item -ItemType Directory -Path ".\$((Get-Date).ToString('dd-MM-yyyy'))"

$A = Get-Content -Path C:\checkkb\Servers.txt

$A | ForEach-Object {
    Invoke-Command -ComputerName $_ -ScriptBlock{Get-HotFix | where {$_.InstalledOn -gt (get-date).AddDays(-30)} | sort InstalledOn} > $newdir\$_.txt
}