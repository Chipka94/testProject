# Easy CSV
Это упрощенный каталогизатор книг. Позволяет просмотреть содержимое CSV файла в простом виде

# Требования
* php 7
* mysql-5.6
* apache сервер
* Composer
* CSV(через Composer)
* Twig(через Composer)
* PDO
* ZipArchive

# Установка
* Скачать, распаковать проект в папку apache сервера (../www); переименовать на "testproject.com"
* Скопировать config файл сервера (../config/testproject.com.conf) в папку сервера (../apache2/sites-available)
* В файле "testproject.com.conf" сменить директиву 'DocumentRoot' на абсолютный путь к папке проекта
* Выполнить команду "a2ensite testproject.com.conf"
* В файле "hosts" вставить строку "127.0.0.1 testproject.com"
* Через консоль выполнить команду "composer install" в папке проекта; выполниться установка необходимых библиотек
* Через консоль MySQL выполнить миграцию БД - 1)"mysql -u login -p database"; 2) "source path/to/sql/db.sql"
* В файле dbSettings.php(../config/dbSettings.php) указать параметры подключения к БД
* Запустить сервер и перейти по адресу "testproject.com", загрузить zip архив
* Готово к использованию!
