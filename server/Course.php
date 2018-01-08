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

        function equals($s){
            return $this->year == $s->year && $this->season == $s->season;
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
            if($this->semester->year > 2014 || ($this->semester->year == 2014 && $this->semester->season == Season::Fall)){
                $this->workload = $this->workload * 3.0 / 8.0;
                if($this->workload > 5) $this->workload = 5;
                else if($this->workload < 1)$this->workload = 1;

                $this->workload = round($this->workload, 2);
            }
            return $this;
        }
    }

    function info_compare($a, $b){
        if($a->semester->year != $b->semester->year){
            return $a->semester->year < $b->semester->year ? -1 : 1;
        }
        else{
            return $b->semester->season - $a->semester->season;
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

            usort($this->infos, "info_compare"); 
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

            $search = "%" . strtoupper(str_replace(" ", "%", $search)) . "%";
            $search = Course::parse_common($search);
            $cmd = $conn->prepare("SELECT code, name, count(code) as c FROM courses WHERE code LIKE ? OR name LIKE ? GROUP BY code, name HAVING c >= ?");
            $cmd->bind_param("ssi", $search, $search, $minSems);

            $cmd->execute();

            $result = $cmd->get_result();
            while($row = $result->fetch_assoc()){
                array_push($courses, new Course($row["code"], $row["name"]));
            }

            return $courses;
        }

        static function parse_common($search){
            $search = str_replace("%CS", "%COMPSCI%", $search);
            $search = str_replace("%EC%", "%ECON%", $search);
            $search = str_replace("%SLS%", "%SCILIVSY%", $search);
            $search = str_replace("%LS%", "%LIFESCI%", $search);

            return $search;
        }

    }
?>