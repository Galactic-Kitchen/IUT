FROM node:23.10.0-alpine3.21

WORKDIR /app

RUN addgroup -S appgroup && adduser -S appuser -G appgroup

COPY package.json .
COPY package-lock.json .

RUN npm install --production

COPY app.js .

EXPOSE 3000:3000

USER appuser

CMD ["node", "app.js"]
