<?php defined("SYSPATH") OR die("No Direct Script Access");

class Model_Artist extends ORM
{
  protected $_table_name = 'artists';
  protected $_primary_key = 'artist_id';
}
