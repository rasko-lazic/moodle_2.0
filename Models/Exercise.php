<?php

namespace FDF\Models;

use FDF\Core\Model;

class Exercise extends Model
{

    public function validate($data)
    {
        // TODO: Implement validate() method.
    }

    public function getForCurrentPeriod()
    {
        $start = $this->dateFormat(strtotime('monday this week'));
        $end = $this->dateFormat(strtotime('sunday this week'));

        return $this->getForPeriod($start, $end);
    }

    public function dateFormat($date)
    {
        return date('Y-m-d H:i:s', $date);
    }

    public function getForPeriod($periodStart, $periodEnd)
    {
        return $this->customQuery("SELECT * FROM `exercise` WHERE `run_date` BETWEEN '$periodStart' AND '$periodEnd'");
    }
}