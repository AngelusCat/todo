FROM node:18

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY . /app

CMD ["npm", "run", "dev"]