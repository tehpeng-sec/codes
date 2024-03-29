# Enter Resource Group of VM
$sourceRG = "" 

# Enter the name of CMK encrypted disk
$sourceDiskName = "" # Enter the name of CMK encrypted disk

# Enter the name of the new disk. This disk will be PMK encrypted 
$targetDiskName = "" 

# Enter the Resounce Group of the new disk
$targetRG = "" 

# Enter the location (Default: South East Asia)
$targetLocate = ""

$sourceDisk = Get-AzDisk -ResourceGroupName $sourceRG -DiskName $sourceDiskName

# Adding the sizeInBytes with the 512 offset, and the -Upload flag
$targetDiskconfig = New-AzDiskConfig -SkuName 'Standard_LRS' -osType $sourceDisk.OsType -UploadSizeInBytes $sourceDisk.DiskSizeBytes+512 -Location $targetLocate -CreateOption 'Upload' -Zone $sourceDisk.Zone -HyperVGeneration $sourceDisk.HyperVGeneration

$targetDisk = New-AzDisk -ResourceGroupName $targetRG -DiskName $targetDiskName -Disk $targetDiskconfig 

$sourceDiskSas = Grant-AzDiskAccess -ResourceGroupName $sourceRG -DiskName $sourceDiskName -DurationInSecond 86400 -Access 'Read'

$targetDiskSas = Grant-AzDiskAccess -ResourceGroupName $targetRG -DiskName $targetDiskName -DurationInSecond 86400 -Access 'Write'

# Change the location of the azcopy based on your location
C:\azcopy\azcopy copy $sourceDiskSas.AccessSAS $targetDiskSas.AccessSAS --blob-type PageBlob

Revoke-AzDiskAccess -ResourceGroupName $sourceRG -DiskName $sourceDiskName

Revoke-AzDiskAccess -ResourceGroupName $targetRG -DiskName $targetDiskName