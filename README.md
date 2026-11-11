# CataFilm
Coursework №6  A server-based web application for keeping your own film buff’s diary (a simplified version of Letterboxd)

## Running the project

```bash
cp .env.example .env   # skip if .env already exists
touch database/database.sqlite   # skip if the file already exists
chmod 666 database/database.sqlite

docker compose up -d --build

docker compose exec app php artisan key:generate   # skip if APP_KEY is already set in .env
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

The app is served on **http://localhost:8000**.

Notes:
- `.env` and `database/database.sqlite` are bind-mounted into the `app` container; everything else (code, `vendor/`) baked int the image. so **any code change requires `docker compose up -d --build`**.

## API documentation (Swagger)

Once the app is running:

- Swagger UI: http://localhost:8000/api/documentation
- Raw OpenAPI JSON: http://localhost:8000/docs/api-docs.json

The docs are generated from `@OA\*` annotations in `app/Annotations/Api` and `app/Http/Controllers/Api`. In local development, `L5_SWAGGER_GENERATE_ALWAYS=true` (set in `.env`) makes them regenerate automatically on every request, so no manual step is needed after changing annotations. (rebuild the image as noted above).
