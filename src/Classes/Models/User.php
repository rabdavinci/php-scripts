<?php

namespace App\Models;

class User
{
  private $name;
  private $email;
  private $password;
  private $age;

  public function __construct(
    $name = null,
    $email = null,
    $password = null,
    $age = null
  ) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->age = $age;
  }

  /**
   * Get the value of name
   */

  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of email
   */

  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of pass
   */

  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of pass
   *
   * @return  self
   */

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get the value of age
   */

  public function getAge()
  {
    return $this->age;
  }

  /**
   * Set the value of age
   *
   * @return  self
   */

  public function setAge($age)
  {
    $this->age = $age;

    return $this;
  }
}

?>
