
# Odsustvo Tracker Aplikacija

Ova aplikacija je napravljena koristeci Laravel za backend i Vue.js za frontend. Cilj aplikacije je omoguciti registraciju i pregled odsustva radnika.

## Zahtjevi

- PHP 7.4 ili noviji
- Composer
- Node.js i npm
- MySQL

## Instalacija

### 1. Kloniranje

```bash
git clone https://github.com/IcyHarka/teneo-test.git
cd teneo-test
```

### 2. Postavljanje Laravel-a

#### a. Instalacija

```bash
cd absence-tracker-be
composer install
```

#### b. Kopiranje `.env` fajla

Kopirajte `.env.example` u `.env`:

```bash
cp .env.example .env
```

#### c. Postavljanje env file-a

Unutar `.env` file ako vec nije, postavite bazu:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=odsustva
DB_USERNAME=root
DB_PASSWORD=
```

#### d. Generate app kljuca

```bash
php artisan key:generate
```

#### e. Pokretanje migracija i seed-ova

```bash
php artisan migrate --seed
```

#### f. Pokretanje BE

Pokrenite Laravel:

```bash
php artisan serve
```

### 3. Postavljanje Vue.js Frontend-a

#### a. Instalacija

```bash
cd absence-tracker
npm install
```

#### b. Pokretanje Vue.js-a

```bash
npm run dev
```

### API Rute

- `GET /api/absences` - Dohvati sva odsustva
- `POST /api/absences` - Registruj novo odsustvo
- `GET /api/absences/{id}` - Dohvati odsustvo po ID-u
- `PUT /api/absences/{id}` - Ažuriraj odsustvo po ID-u
- `DELETE /api/absences/{id}` - Obriši odsustvo po ID-u
- `POST /api/absences/archive` - Arhiviraj sva odsustva
- `GET /api/archive` - Dohvati arhivirana odsustva
- `GET /api/absence-types` - Dohvati vrste odsustava

## Autor

- [Haris Becirhodzic](https://github.com/IcyHarka)
