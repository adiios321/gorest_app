<?php

namespace App\Http;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GoRestApiClient
{
  private HttpClientInterface $client;
  private string $token;
  private string $baseUrl;

  public function __construct(HttpClientInterface $client, string $token, string $baseUrl)
  {
    $this->client = $client;
    $this->token = $token;
    $this->baseUrl = $baseUrl;
  }

  public function request(string $method, string $uri, array $options = []): array
  {
    $options['headers']['Authorization'] = 'Bearer ' . $this->token;
    $options['headers']['Accept'] = 'application/json';

    try {
      $response = $this->client->request($method, $this->baseUrl . $uri, $options);
      return $response->toArray();
    } catch (TransportExceptionInterface $e) {
      throw new \RuntimeException('Błąd połączenia z API');
    }
  }
}
