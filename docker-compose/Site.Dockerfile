# base image
FROM node:16.20.0-alpine
MAINTAINER Dimitar Hristov <Dimitar.N.Hristov@gmail.com>

# set working directory
WORKDIR /app

#add '/app/node_modules/.bin' to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install and cache app dependencies
COPY package*.json /app/

RUN yarn
RUN yarn add @vue/cli -g

# start app
CMD 'yarn dev'