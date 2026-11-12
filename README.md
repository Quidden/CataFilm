# CataFilm
Coursework №6  A server-based web application for keeping your own film buff’s diary (a simplified version of Letterboxd)

## Running the project
### Initial setup
```bash
cp .env.example .env   # skip if .env already exists
touch database/database.sqlite && chmod 666 database/database.sqlite # skip if the file already exists

```
### Development

```bash
docker compose -f compose.dev.yaml up --build -d     

docker compose exec workspace composer install
docker compose exec workspace php artisan migrate
docker compose exec workspace php artisan db:seed
```

The development applocation is accesible at **http://localhost:8000**.
### Production
```bash
docker compose -f compose.prod.yaml up --build -d   
```
The production applocation is accesible at **http://localhost:80**.

## API documentation (Swagger)

Once the app is running:

- Swagger UI: http://localhost:8000/api/documentation
- Raw OpenAPI JSON: http://localhost:8000/docs/api-docs.json

The docs are generated from `@OA\*` annotations in `app/Annotations/Api` and `app/Http/Controllers/Api`. In local development, `L5_SWAGGER_GENERATE_ALWAYS=true` (set in `.env`) makes them regenerate automatically on every request, so no manual step is needed after changing annotations. (rebuild the image as noted above).
