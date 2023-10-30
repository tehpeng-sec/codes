#!/bin/bash

# Declare Details
proxy_ip="google.com"
proxy_port="443"
hf_ip="127.0.0.1"
hf_port1="8089"
hf_port2="9997"

# Test Connection To Proxy
if telnet "$proxy_ip" "$proxy_port"; then
    echo "Connection to proxy is successful"
    
else
    echo "Connection to proxy failed"
fi