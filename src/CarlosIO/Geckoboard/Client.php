<?php

namespace CarlosIO\Geckoboard;

use GuzzleHttp\Client as Guzzle;
use CarlosIO\Geckoboard\Widgets\Widget;
use GuzzleHttp\RequestOptions;

/**
 * Class Client.
 */
class Client
{
    const URI = 'https://push.geckoboard.com';
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;
    /**
     * @var string
     */
    protected $api;

    /**
     * Construct a new Geckoboard Client.
     *
     * @param array $config Client configuration settings.
     */
    public function __construct(array $config = [])
    {
        $this->api = '';
        $this->client = new Guzzle($config);
    }

    /**
     * @param string|null $key
     *
     * @return array|mixed
     */
    public function getGuzzleConfig($key = null)
    {
        return $this->client->getConfig($key);
    }

    /**
     * Set Geckoboard API key.
     *
     * @param $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->api = $apiKey;

        return $this;
    }

    /**
     * Get Geckoboard API key.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->api;
    }

    /**
     * Send the widget info to Geckboard.
     *
     * @param $widget
     *
     * @return $this
     */
    public function push($widget)
    {
        $this->pushWidgets(
            $this->getWidgetsArray($widget)
        );

        return $this;
    }

    /**
     * @param $widget
     *
     * @return array
     */
    private function getWidgetsArray($widget)
    {
        $widgets = $widget;
        if (!is_array($widget)) {
            $widgets = array($widget);
        }

        return $widgets;
    }

    /**
     * @param $widgets
     */
    private function pushWidgets($widgets)
    {
        foreach ($widgets as $widget) {
            $this->pushWidget($widget);
        }
    }

    /**
     * @param $widget
     */
    private function pushWidget(Widget $widget)
    {
        $url = sprintf('%s/v1/send/%s', self::URI, $widget->getId());

        $this->client->request(
            'POST',
            $url,
            [
                RequestOptions::JSON => [
                    'api_key' => $this->getApiKey(),
                    'data' => $widget->getData(),
                ],
            ]
        );
    }
}
