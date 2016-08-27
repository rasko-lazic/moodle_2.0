<?php

namespace FDF\Controllers;

use FDF\Models\Exercise;
use FDF\Models\Subject;
use FDF\Models\User;

class SubjectController extends BaseController
{
    /**
     * @var array Array that holds the subject we are showing in controller
     */
    static protected $subject;

    public function returnView()
    {
        $s = new Subject();
        self::$subject = $s->select('*', 'id', $this->query['id']);

        is_null(self::$subject) ? $this->respondNotFound() : include ('/Views/subject.php');
    }

    public function getTitle()
    {
        return self::$subject['name'];
    }

    public function generateContent()
    {
        $e = new Exercise();
//        $u = new User();

        $exercises = $e->select('*', 'subject_id', self::$subject['id']);
        foreach ($exercises as $exercise) {
            $date = strtotime($exercise['run_date']);
            echo "
            <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title\">".
                $exercise['name']
                ."</h3>
            </div>
            <div class=\"panel-body\">
                <div class=\"row\">
                    <div class=\"col-md-1\">
                        Kratak opis:
                    </div>
                    <div class=\"col-md-7\">" .
                $exercise['description']
                . "</div>
                    <div class=\"col-md-2\">
                        Datum: ".
                        date('d.m.Y H:i', $date)
                        ."<br>
                        Laboratorija: ".
                        $exercise['location']
                        ."<br>
                    </div>
                    <div class=\"col-md-2\">
                    </div>
                </div>
            </div>
        </div>
            ";
        }
    }

    public function getAssistantContent()
    {
        $u = new User();
        $assistants = $u->getAssistants(self::$subject['id']);

        foreach ($assistants as $assistant) {
            echo "
            <a href=\"/RT5614_Rasko_Lazic/moodle_v2.0/user?id=" . $assistant['id'] . "\">" . $assistant['name'] . "</a><br>
            Email: <a href=\"mailto:" . $assistant['email'] . "\">" . $assistant['email'] . "</a><br><br>";
        }
    }

}