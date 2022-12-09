$sourceRG = "RG-NoNPrd"
$sourceDiskName = "AZCMKDE02_OsDisk_1_bbd35480f26c45d1af3d48327b04e7f4"
$targetDiskName = "azcmkdecopylinux02"
$targetRG = "RG-NoNPrd"
$targetLocate = "Southeast Asia"
#Expected value for OS is either "Windows" or "Linux"
$targetOS = "Linux"

$sourceDisk = Get-AzDisk -ResourceGroupName $sourceRG -DiskName $sourceDiskName

# Adding the sizeInBytes with the 512 offset, and the -Upload flag
$targetDiskconfig = New-AzDiskConfig -SkuName 'Standard_LRS' -osType $targetOS -UploadSizeInBytes $($sourceDisk.DiskSizeBytes+512) -Location $targetLocate -CreateOption 'Upload' -Zone 1 -HyperVGeneration V1

$targetDisk = New-AzDisk -ResourceGroupName $targetRG -DiskName $targetDiskName -Disk $targetDiskconfig 

$sourceDiskSas = Grant-AzDiskAccess -ResourceGroupName $sourceRG -DiskName $sourceDiskName -DurationInSecond 86400 -Access 'Read'

$targetDiskSas = Grant-AzDiskAccess -ResourceGroupName $targetRG -DiskName $targetDiskName -DurationInSecond 86400 -Access 'Write'

C:\Users\adminpss\Desktop\azcopy_windows_amd64_10.12.1\azcopy_windows_amd64_10.12.1\azcopy copy $sourceDiskSas.AccessSAS $targetDiskSas.AccessSAS --blob-type PageBlob

Revoke-AzDiskAccess -ResourceGroupName $sourceRG -DiskName $sourceDiskName

Revoke-AzDiskAccess -ResourceGroupName $targetRG -DiskName $targetDiskName 