<?php

namespace FDF\Models;

use FDF\Core\Model;

class User extends Model
{
    public function validate($data)
    {
        // TODO: Implement validate() method.
    }

    public function getAssistants($subjectId)
    {
        return $this->customQuery('SELECT * FROM user WHERE id IN (SELECT user_id FROM subject_user WHERE subject_id =' . $subjectId . ')');
    }
}