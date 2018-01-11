<?php
    //Get list of departments
    function getDepartments($conn){
        $codes = array();
        $depts = array();

        $cmd = $conn->prepare("SELECT code FROM courses GROUP BY code ORDER BY code");
        $cmd->execute();
        $result = $cmd->get_result();
        while($row = $result->fetch_assoc()){
            array_push($codes, $row["code"]);
        }

        foreach($codes as $code){
            //Split along the sace
            $dept = explode(" ", $code)[0];
            //Add new department to array if not already in
            if(!in_array($dept, $depts)){
                array_push($depts, $dept);
            }
        }

        return $depts;
    }

    class Department{
        public $code;
        public $infos = array();
        function __construct($code){
            $this->code = $code;
            $this->infos = array();
        }

        function load($conn){
            //Retrieve all courses
            $dept = $this->code . " %";
            $cmd = $conn->prepare("SELECT * FROM courses WHERE code LIKE ? ORDER BY year ASC, semester DESC");
            $cmd->bind_param("s", $dept);
            $cmd->execute();

            $result = $cmd->get_result();
            $cur = count($this->infos) - 1;
            while($row = $result->fetch_assoc()){
                $sem = new Semester($row["semester"], $row["year"]);
                //New semester to be addded
                if(count($this->infos) < 1 || !$sem->equals($this->infos[$cur]->semester)){
                    if($cur >= 0){
                        //Divide by enrollment to create average
                        $this->infos[$cur]->recommend /= $this->infos[$cur]->enrollment;
                        $this->infos[$cur]->workload /= $this->infos[$cur]->enrollment;

                        //Round the numbers to two decimal places
                        $this->infos[$cur]->recommend = round($this->infos[$cur]->recommend, 2);
                        $this->infos[$cur]->workload = round($this->infos[$cur]->workload, 2);

                        //Adjust workload for more recent semesters
                        $this->infos[$cur]->adjust_workload();
                    }
                    array_push($this->infos, new Info($sem, 0, 0, 0));
                    $cur++;
                }

                //Increment info for current info
                $this->infos[$cur]->enrollment += $row["enrollment"];
                $this->infos[$cur]->recommend += $row["enrollment"] * $row["recommend"];
                $this->infos[$cur]->workload += $row["enrollment"] * $row["workload"];
            }

            $this->infos[$cur]->recommend /= $this->infos[$cur]->enrollment;
            $this->infos[$cur]->workload /= $this->infos[$cur]->enrollment;
            $this->infos[$cur]->adjust_workload();
            
            usort($this->infos, "info_compare");
            return $this;
        }
    }
?>