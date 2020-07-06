<?php

class TechnicalException extends Exception
{
}

class UserFriendlyException extends Exception
{
}

function saveSomething($input)
{
  if (empty($input['name'])) {
    throw new UserFriendlyException('Name was empty');
  }

  $db = new DB();
  try {
    $db->getSomeRowThatWillJoin();
  } catch (Exception $e) {
    throw new TechnicalException($e->getMessage());
  }
}

function indexController()
{
  try {
    saveSomething(['name' => '']);
  } catch (UserFriendlyException $e) {
    return json_encode([
      'ok' => false,
      'error' => $e->getMessage(),
    ]);
  } catch (TechnicalException $e) {
    Log::save($e);
    return json_encode([
      'ok' => false,
      'error' => 'Some technical exception',
    ]);
  } catch (Exception $e) {
    Log::save($e);
    return json_encode([
      'ok' => false,
      'error' => 'Please contact the developer',
    ]);
  }
}
