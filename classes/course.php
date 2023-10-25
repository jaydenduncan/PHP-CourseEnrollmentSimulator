<?php
class Course {
    private $id;
    private $abbreviation;
    private $courseNumber;
    private $title;
    private $description;
    private $creditHours;

    public function __construct($id, $abbr, $courseNum, $title, $desc, $creditHrs) {
        $this->id = $id;
        $this->abbreviation = $abbr;
        $this->courseNumber = $courseNum;
        $this->title = $title;
        $this->description = $desc;
        $this->creditHours = $creditHrs;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setAbbreviation($abbr) {
        $this->abbreviation = $abbr;
    }

    public function getAbbreviation() {
        return $this->abbreviation;
    }

    public function setCourseNumber($courseNum) {
        $this->courseNumber = $courseNum;
    }

    public function getCourseNumber() {
        return $this->courseNumber;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setDescription($desc) {
        $this->description = $desc;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setCreditHours($creditHrs) {
        $this->creditHours = $creditHrs;
    }

    public function getCreditHours() {
        return $this->creditHours;
    }

    public function __toString() {
        return (
            "Course: " . $this->abbreviation . " " . $this->courseNumber . "<br>" . 
            "Title: " . $this->title . "<br>" . 
            "Description: " . $this->description . "<br>" . 
            "Credit Hours: " . $this->creditHours . "<br>"
        );
    }
}