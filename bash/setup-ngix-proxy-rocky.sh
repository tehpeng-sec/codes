#!/bin/bash

# Update system packages
dnf update -y

# Install Nginx
dnf install -y nginx

# Configure Nginx as a reverse proxy
cat <<EOF > /etc/nginx/conf.d/reverse-proxy.conf
server {
    listen 80;
    server_name example.com;

    location / {
        proxy_pass http://backend-server:8080/;
        proxy_set_header Host \$host;
        proxy_set_header X-Real-IP \$remote_addr;
        proxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;
    }
}
EOF

# Test Nginx configuration and restart Nginx
nginx -t && systemctl restart nginx
