<?php 
namespace modules\socialnews\services;

use Craft;
use craft\base\Component;
use GuzzleHttp\Client;

class SocialNewsService extends Component
{
    private Client $client;

    public function init(): void
    {
        parent::init();

        $this->client = Craft::createGuzzleClient([
            'timeout' => 4,
        ]);
    }

    public function getMastodonPosts(string $instance, string $accountId, int $limit = 5): array
    {
        try {
            $response = $this->client->get("https://{$instance}/api/v1/accounts/{$accountId}/statuses", [
                'query' => ['limit' => $limit]
            ]);


            return json_decode($response->getBody(), true);
        } catch (\Throwable $e) {
            Craft::error("Mastodon API error: " . $e->getMessage(), __METHOD__);
            return [];
        }
    }

    public function getXPosts(string $apiBearerToken, string $userId, int $limit = 5): array
    {
        try {
            $response = $this->client->get("https://api.twitter.com/2/users/{$userId}/tweets", [
                'headers' => [
                    'Authorization' => "Bearer {$apiBearerToken}",
                ],
                'query' => [
                    'max_results' => $limit,
                ]
            ]);

            return json_decode($response->getBody(), true)['data'] ?? [];
        } catch (\Throwable $e) {
            Craft::error("Twitter API error: " . $e->getMessage(), __METHOD__);
            return [];
        }
    }
}
