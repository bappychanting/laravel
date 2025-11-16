FROM nginx:stable-alpine

# Remove default config
RUN rm /etc/nginx/conf.d/default.conf

# Copy your Nginx config
COPY docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf
