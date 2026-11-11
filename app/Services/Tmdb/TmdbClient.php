<?php
namespace App\Services\Tmdb;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class TmdbClient
{
    private string $baseUrl;
    private string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.tmdb.base_url');
        $this->token = config('services.tmdb.token');
        if (empty($this->token)) {
            throw new RuntimeException('TMDb API token is not configured.');
        }
    }

    private function get(string $endpoint, array $params = []): array
    {
        $response = Http::withToken($this->token)
            ->acceptJson()
            ->timeout(15)
            ->get(
                $this->baseUrl . '/' . ltrim($endpoint, '/'),
                $params
            );
        $response->throw();
        $data = $response->json();
        if (!is_array($data)) {
            throw new RuntimeException('Invalid response from TMDb API.');
        }
        return $data;
    }

    public function search(string $query, array $params = []): array
    {
        return $this->get('search/movie', [
                'query' => $query
            ] + $params);
    }

    public function getMovieDetails(int $movieId): array
    {
        return $this->get("movie/{$movieId}");
    }

    public function getGenres(): array
    {
        return $this->get('genre/movie/list');
    }
}
