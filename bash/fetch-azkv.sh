#!/bin/bash

echo Username: 
read username
echo Password: 
read password
echo Key Vault Name:
read kv_name

cr_username = az keyvault secret show --name "$username" --vault-name "$kv_name" --query "value"
cr_password = az keyvault secret show --name "$password" --vault-name "$kv_name" --query "value"

echo $cr_username
echo $cr_password