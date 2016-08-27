<?php

namespace FDF\Controllers;

use FDF\Models\Exercise;
use FDF\Models\Subject;
use FDF\Models\User;

class HomeController extends BaseController
{
    public function returnView()
    {
        include ('/Views/home.php');
    }

    public function generateContent()
    {
        $e = new Exercise();
        $s = new Subject();
        $u = new User();

        $exercises = $e->getForCurrentPeriod();
        foreach ($exercises as $exercise) {
            $subject = $s->select('*', 'id', $exercise['subject_id']);
            $date = strtotime($exercise['run_date']);
            $assistants = $u->getAssistants($exercise['subject_id']);

            $assistantNames = $this->assistantsArrayToString($assistants);

            echo "
            <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title\"><a href=\"/RT5614_Rasko_Lazic/moodle_v2.0/subject?id=".
                $subject['id']
                ."\">".
                $subject['name']
                ."</a></h3>
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
                        ."<br>".
                        $exercise['name']
                        ."
                    </div>
                    <div class=\"col-md-2\">".
                        $assistantNames
                    ."</div>
                </div>
            </div>
        </div>
            ";
        }
    }

    public function assistantsArrayToString($assistants)
    {
        $htmlString = '';
        foreach ($assistants as $assistant) {
            $htmlString .= "<a href=\"/RT5614_Rasko_Lazic/moodle_v2.0/user?id=" . $assistant['id'] . "\">" . $assistant['name'] . "</a><br>";
        }

        return $htmlString;
    }
}