## Deploy

Что нужно:
- Ubuntu 24.04.1 LTS (Desktop, 64-bit);
- Docker version 28.0.1, build 068a01e;
- Docker Compose version v2.33.1.

1. создаем папку app и переходим в нее: `mkdir app && cd app`;

2. клонируем репозиторий: `git clone https://github.com/AngelusCat/todo.git`;

3. переносим содержимое todo в папку app, а саму папку todo удаляем;

4. собираем приложение: `sudo docker compose up --build`;

5. *костыль, идем в контейнер с backend и выполняем composer install:
- `sudo docker ps -a`;
- `sudo docker exec -ti <CONTAINER_ID> sh`;
- `composer install`;
- `exit`.

открываем браузер и переходим по адресу: `http://localhost:5173`.
