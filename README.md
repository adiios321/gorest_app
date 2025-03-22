# GoRest App

Aplikacja Symfony 5 pobierająca dane użytkowników z zewnętrznego API [gorest.co.in](https://gorest.co.in/).  
Pozwala na przeglądanie, wyszukiwanie i edytowanie danych użytkowników przez AJAX (jQuery).  

## Stack technologiczny

- Symfony 5
- PHP 8.1 (Docker)
- Docker Compose
- jQuery + AJAX
- GoRest API: https://gorest.co.in/public/v2/users

---

## Jak uruchomić projekt

### 1. Sklonuj repozytorium
```
git clone https://github.com/adiios321/gorest-app.git
cd gorest-app
composer install
```

2. Skonfiguruj zmienne środowiskowe
Utwórz plik .env w katalogu głównym projektu:
```
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=e5866b0e0fddb53af40e445c500d23e2

###> symfony/messenger ###
MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0

###> symfony/mailer ###
MAILER_DSN=null://null
### BAZA DANYCH ###
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=gorest
MYSQL_USER=symfony
MYSQL_PASSWORD=password
DATABASE_URL="mysql://${MYSQL_USER}:${MYSQL_PASSWORD}@database:33060/${MYSQL_DATABASE}?serverVersion=8.0"

GOREST_API_URL=https://gorest.co.in/public/v2
GOREST_TOKEN=YOUR_TOKEN
```
Token możesz wygenerować po zalogowaniu się na https://gorest.co.in/consumer/login

3. Uruchom Docker
Zbuduj kontenery:
```
docker-compose up --build -d
```

4. Otwórz aplikację w przeglądarce
http://localhost:8000

## Funkcjonalności
- Lista użytkowników z API
- Wyszukiwanie po imieniu
- Edycja imienia i e-maila
- Potwierdzenie przed zapisem
- Zapis przez AJAX bez przeładowania strony
- Stylizacja przez style.css


## Dla odświeżenia listy, należy wcisnąć przycisk "Szukaj" z pustym polem tekstowym


 ## TODO / Możliwe rozszerzenia
 Dodawanie użytkowników

 Usuwanie użytkowników

 Paginacja

 Testy PHPUnit / Cypress

 Modal zamiast confirm()