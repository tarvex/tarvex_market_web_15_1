FROM node:23.5.0-alpine

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Install dependencies (including libssl3)
RUN apk add --no-cache \
    libssl3 \
    && npm install --global npm@latest

# Set NODE_OPTIONS to resolve OpenSSL issue
ENV NODE_OPTIONS=--openssl-legacy-provider

# Check node, npm, yarn versions, and current user
RUN echo "node version:   $(node -v)\n"
RUN echo "npm version:    $(npm -v)\n"
RUN echo "yarn version:   $(yarn -v)\n"
RUN echo "user:           $(whoami)\n"

