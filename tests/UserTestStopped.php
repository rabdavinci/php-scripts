<?php
require './src/Classes/Models/User.php';

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  private $user;

  protected function setUp(): void
  {
    $this->user = new \App\Models\User();
    $this->user->setAge(33);
  }

  protected function tearDown(): void
  {
  }

  /**
   */
  public function testAge1()
  {
    $this->assertSame(33, $this->user->getAge());
    return 33;
  }

  /**
   * @depends testAge1
   */
  public function testAge2($age)
  {
    $this->assertEquals($age, 33);
  }

  /*public function userProvider()
  {
    return 33;
  }*/
}
