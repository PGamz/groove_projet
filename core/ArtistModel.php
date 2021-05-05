<?php


namespace app\core;


use app\core\db\DbModel;

abstract class ArtistModel extends DbModel
{
    abstract public function getArtistName(): string;
    abstract public function getDescription(): string;
}