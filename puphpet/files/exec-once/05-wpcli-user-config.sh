#!/usr/bin/env bash
cd /home/vagrant/ && mkdir .wp-cli;
cat << "EOF" > /home/vagrant/.wp-cli/config.yml
path: /var/www/html/wp
debug: false
core config:
  extra-php: |
    define( 'WP_DEBUG', false );
EOF
