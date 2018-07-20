<?php

namespace Sanmark\EuphemeLaravelSdk;

interface iUserHelper
{
    public function getAuthUserID();

    public function getUserNameFromID($userID);

}