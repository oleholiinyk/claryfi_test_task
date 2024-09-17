FROM node:20 AS build

WORKDIR /var/www/claryfi/app

COPY package*.json ./
RUN npm install

COPY . .

RUN npm run build

FROM nginx:alpine as build-stage

COPY --from=build /var/www/claryfi/app/dist /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
