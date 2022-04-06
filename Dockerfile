# FROM node:latest AS node_base
# WORKDIR /home/node/app
# ADD . /home/node/app

FROM wordpress:latest

## first install node
ENV NODE_VERSION=16.14.0
RUN apt install -y curl
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"

RUN node --version
RUN npm --version

## next, mount our app directory and bootstrap the lerna project
ADD . /root/node/app
RUN chmod +rwx /root
WORKDIR /root/node/app

# separate out npm install so that we can cache it
RUN npm install

RUN npm run build && npm run bootstrap
WORKDIR /var/www/html

## create symlink to the necessary directory
RUN ln -s /root/node/app/packages/wordpress /var/www/html/wp-content/themes/Apple2000e

# RUN "cd /root/node/app && npm install && npm start && cd -"

# COPY --from=node_base /home/node/app /home/node/app
# RUN "mkdir /var/www/html/wp-content/themes/Apple2000e && ln -s /home/node/app/packages/wordpress /var/www/html/wp-content/themes/Apple2000e"
