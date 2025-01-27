# Menu items backend


## Installation

1. Clone respository

2. Copy src/.env.example to src/.env with the following command

```bash
cp src/.env.example src/.env
```

3. Install dependencies

```bash
yarn
/*OR*/
npm install
```
4Run the following commands to set up the database and fetch the data

```bash
php artisan migrate:fresh --seed
```

You can rerun this script at any time to completely refresh the data.

5Run the following commands to begin the server locally

```bash
php artisan serve
```

6Start coding :)
