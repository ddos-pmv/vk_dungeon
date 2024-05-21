# vk_dungeon
Тестовое задание на стажировку

# Не успел доделать! Пожалуйста, если вы смотрите и я не успел доделать полноценную игру, дайте еще день-два.
# Напишите на почту или телеграмм @workpmv

## Ожидаемы результат
PHP код API, который обрабатывает игровой сценарий:
1. Загружает извне информацию о подземелье в некотором формате.
2. Помещает игрока в стартовую комнату.
3. Обрабатывает перемещения игрока (вводятся извне), до тех пор пока игрок не достигнет выхода.
4. Сохраняет итоговые очки игрока после выхода.

## Реализация
- Исопльзовался микрофреймиворк Flight, для более удобной работы с роутингом
- Данные о комнатах сохраняются в формате JSONB

## Инструкция по запуску
- Скачать репозиторий;
- В папке bd/ лежит дамп бд, его нужно импортировать;
- Установить зависимости;
- настроить .env
```
composer install
```
- Настроить бд и файл окружения (еще не доделал, поэтму конфиг бд не прикрепляю).
- Все эндпоинты доступны по .../public/<endpoint>

## Описание эндпоинтов
- ### "/loadConfig" , method: POST, body:json
  Валидация и сохрание карты;
  **Карта должна:**
    - Быть описана в json;
    - Иметь поля start и end, означают начальную и финальную комнаты
    - Иметь массив rooms, с описаниями комнат
      Пример можно посмотреть в data/dungeon_config.json
- ### "/start" , method: POST, body:empty
    - Сохраняет комнаты и начальную позицию игрока в бд

