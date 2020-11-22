Uruchomienie:
- zainstalować zależności (composer install)
- jeśli chcesz używać dockera uruchom w terminalu "docker-compose build", nastepnie "docker-compose up -d"
- jeśli nie chcesz używać dockera możesz uruchomić lokalny serwer, wpisz w terminalu "symfony serve"
- w pliku .env dodać dane do bazy danych (DATABASE_URL="mysql://root:mysql@127.0.0.1:3306/wip?serverVersion=5.7"), jeśli używasz dockera pomiń ten krok
- w pliku .env dodać dane do konta email, użyłem symfony/google-mailer (MAILER_DSN=gmail://USERNAME:PASSWORD@default)
- utworzyć bazę danych i zaimportować tabelę users używając migracji (doctrine:migrations:migrate) lub importować plik users.sql
