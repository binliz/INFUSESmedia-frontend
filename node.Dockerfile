FROM node:lts-alpine

ENV NODE_ENV=develop

WORKDIR /app

COPY ./src/package.json /app/package.json
COPY ./src/package-lock.json /app/package-lock.json
COPY ./src /app

RUN npm install

RUN chown -R node:node /app/node_modules
RUN npm ci
EXPOSE 8000
# start app
CMD ["npm", "run", "dev"]
