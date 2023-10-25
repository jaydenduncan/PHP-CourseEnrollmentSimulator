<?php
class StudentClass {
    private $id;
    private $course;
    private $section;
    private $instructor;
    private $startTime;
    private $endTime;
    private $activeDays;
    private $type;

    public function __construct($id, $course, $section, $instructor, $st, $et, $days, $type) {
        $this->id = $id;
        $this->course = $course;
        $this->section = $section;
        $this->instructor = $instructor;

        $this->startTime = $st;
        $this->endTime = $et;

        if(empty($days))
            $this->activeDays = "*";
        else
            $this->activeDays = $days;

        $this->type = $type;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setCourse($course) {
        $this->course = $course;
    }

    public function getCourse() {
        return $this->course;
    }

    public function setSection($section) {
        $this->section = $section;
    }

    public function getSection() {
        return $this->section;
    }

    public function setInstructor($instr) {
        $this->instructor = $instr;
    }

    public function getInstructor() {
        return $this->instructor;
    }

    public function setStartTime($st) {
        $this->startTime = $st;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setEndTime($et) {
        $this->endTime = $et;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setActiveDays($days) {
        $this->activeDays = $days;
    }

    public function getActiveDays() {
        return $this->activeDays;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function __toString() {
        $dateTimeImmutable = new DateTimeImmutable();

        if(!($this->type==="ONL")) {
            $stFormatted = $dateTimeImmutable->setTimestamp($this->startTime)->format('h:i A');
            $etFormatted = $dateTimeImmutable->setTimestamp($this->endTime)->format('h:i A');
        }
        elseif($this->type==="ONL") {
            $stFormatted = "WWW";
            $etFormatted = "WWW";
        }

        return (
             $this->course . "<br>" . 
             "Section: " . $this->section . "<br>" . 
             "Instructor: " . $this->instructor . "<br>" . 
             "From: " . $stFormatted . "<br>" . 
             "To: " . $etFormatted . "<br>" . 
             "Active Days: " . $this->activeDays . "<br>" . 
             "Class Type: " . $this->type . "<br><br>"
        );
    }
}