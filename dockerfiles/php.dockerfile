FROM dunglas/frankenphp:php8.3

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN delgroup dialout

RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

# Install ekstensi PHP yang diperlukan
RUN install-php-extensions pdo pdo_mysql redis

# Set permissions (sesuaikan dengan kebutuhan)
RUN chown -R laravel:laravel /var/www/html

# Copy Caddyfile (pastikan file ini ada di host)
COPY ./Caddyfile /etc/caddy/Caddyfile

USER laravel

# Command untuk menjalankan FrankenPHP
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
