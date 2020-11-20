Uruchomienie:
- zainstalować zależności (composer install)
- uruchomić lokalny serwer (symfony serve)
- w pliku .env dodać dane do bazy danych (DATABASE_URL="mysql://root:mysql@127.0.0.1:3306/wip?serverVersion=5.7")
- w pliku .env dodać dane do konta email, użyłem symfony/google-mailer (MAILER_DSN=gmail://USERNAME:PASSWORD@default)
- utworzyć bazę danych i zaimportowac tabelę users używając migracji (doctrine:migrations:migrate) lub importować plik users.sql
