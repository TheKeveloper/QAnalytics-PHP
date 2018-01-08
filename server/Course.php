<?php
    abstract class Season{
        const Fall = 0;
        const Spring = 1;

        static function toStr($season){
            if($season == Season::Fall){
                return "Fall";
            }
            else if($season == Season::Spring){
                return "Spring";
            }
        }
    }
    class Semester{
        public $season = 0;
        public $year = 0;

        function __construct($season, $year){
            $this->season = $season;
            $this->year = $year;
        }

        function toStr(){
            return (Season::toStr($this->season)." ".$this->year);
        }

        static function compare($a, $b){
            if($a->year != $b->year){
                return $a->year - $b->year;
            }
            else{
                return $b->season - $a->season;
            }
        }
    }

    class Info{
        public $semester;
        public $enrollment;
        public $recommend;
        public $workload;

        function __construct($semester, $enrollment, $recommend, $workload){
            $this->semester = $semester;
            $this->enrollment = $enrollment;
            $this->recommend = $recommend;
            $this->workload = $workload;
        }

        function adjust_workload(){
            if($this->semester->year > 2014 || ($this->semester->year == 2014 && $this->semester->year == Season::Fall)){
                $this->workload = $this->workload * 3.0 / 13.0;
                if($this->workload > 5) $this->workload = 5;
                else if($this->workload < 1)$this->workload = 1;

                $this->workload = round($this->workload, 2);
            }
            return $this;
        }
    }
    class Course{
        public $code = "";
        public $name = "";
        public $infos = array();

        function __construct($code, $name = ""){
            $this->code = $code;
            $this->name = $name;
        }

        function load($conn){
            $cmd = $conn->prepare("SELECT * FROM courses WHERE code = ?;");
            $cmd->bind_param("s", $this->code);

            $cmd->execute();

            $result = $cmd->get_result();

            $n = 0;
            while($row = $result->fetch_assoc()){
                if($n == 0){
                    $this->name = $row["name"];
                    $n++;
                }
                array_push($this->infos, (new Info(new Semester($row["semester"], $row["year"]), $row["enrollment"], $row["recommend"], $row["workload"]))->adjust_workload());
            }

            usort($this->infos, ["Semester", "compare"]);
        }

        static function get_courses_simple($conn, $minSems = 2){
            $courses = array();
            $cmd = $conn->prepare("SELECT code, name, count(code) as c FROM courses GROUP BY code, name HAVING c >= ? ORDER BY code ASC;");
            $cmd->bind_param("i", $minSems);

            $cmd->execute();
            $result = $cmd->get_result();
            while($result && $row = $result->fetch_assoc()){
                array_push($courses, new Course($row["code"], $row["name"]));
            }
            return $courses;
        }

        static function search_courses($conn, $search, $minSems = 2){
            $courses = array();
        }

    }
?>