<?php

namespace Sanmark\EuphemeLaravelSdk\Models;

class Comment
{
    public $id;
    public $text;
    public $parentID;
    public $extRef;
    public $userID;
    public $createdAt;
    public $updatedAt;
    public $children;

    public function getCreateTime()
    {
        return $this -> createdAt -> diffForHumans();
    }
}