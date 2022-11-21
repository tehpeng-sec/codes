@echo off

set /p username=Please enter username:
set /p password=Please enter password:
set /p keyvault=Please enter keyvault:

az keyvault secret show --name "%username%" --vault-name "%keyvault%" --query "value"
az keyvault secret show --name "%password%" --vault-name "%keyvault%" --query "value"