FROM nginx:alpine
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY app.js index.html notes.html noteList.css /usr/share/nginx/html/

HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD curl -f http://localhost:3000/notes || exit 1