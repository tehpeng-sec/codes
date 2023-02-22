#!/bin/bash

# Update system packages
apt-get update

# Install Nginx
apt-get install -y nginx

# Configure Nginx as a reverse proxy
cat <<EOF > /etc/nginx/sites-available/reverse-proxy.conf
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

# Link the reverse-proxy.conf file to the sites-enabled directory
ln -s /etc/nginx/sites-available/reverse-proxy.conf /etc/nginx/sites-enabled/

# Test Nginx configuration and restart Nginx
nginx -t && systemctl restart nginx
