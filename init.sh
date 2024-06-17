docker compose up -d && \
docker compose exec server composer dumpautoload && \
sleep 15  && \
docker compose exec -T db mysql -u root -proot --default-character-set=utf8 main < products.sql && \
docker compose exec -T db mysql -u root -proot --default-character-set=utf8 main < user.sql && \
docker compose exec -T db mysql -u root -proot --default-character-set=utf8 main < user_order.sql
