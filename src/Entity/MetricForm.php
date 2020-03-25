<?php

namespace App\Entity;

class MetricForm
{
    public $startTime;
    public $endTime;

    public function getStartTime(){
        return $this->startTime();
    }

    public function setStartTime($startTime){
        $this->startTime = $startTime;
    }

    public function getEndTime(){
        return $this->endTime();
    }

    public function setEndTime($endTime){
        $this->endTime = $endTime;
    }

    public function startTime()
    {
    }

    public function endTime()
    {
    }
    public function toArray()
    {
        return [
            'start_time' => $this->getStartTime(),
            'end_time' => $this->getEndTime(),
        ];
    }
}