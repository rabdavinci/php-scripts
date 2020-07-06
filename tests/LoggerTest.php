<?php
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
  private $http;

  protected function setUp(): void
  {
    $this->http = new GuzzleHttp\Client();
  }

  protected function tearDown(): void
  {
    $this->http = null;
  }

  public function testGet()
  {
    $response = $this->http->request(
      'GET',
      "http://log.local/logger.php?param=value"
    );

    $this->assertEquals(200, $response->getStatusCode());

    $body = $response->getBody();

    $this->assertRegexp('/param/', $body);
    $this->assertRegexp('/value/', $body);
  }

  public function testPost()
  {
    $response = $this->http->request('POST', 'http://log.local/logger.php', [
      'form_params' => [
        'param' => 'value',
      ],
    ]);

    $body = $response->getBody();

    $this->assertRegexp('/param/', $body);
    $this->assertRegexp('/value/', $body);
  }

  public function testGetPost()
  {
    $response = $this->http->request(
      'POST',
      'http://log.local/logger.php?get_param=get_value',
      [
        'form_params' => [
          'param' => 'value',
        ],
      ]
    );

    $body = $response->getBody();

    $this->assertRegexp('/param/', $body);
    $this->assertRegexp('/value/', $body);

    $this->assertRegexp('/Query String Parametres/', $body);
  }
}

?>
