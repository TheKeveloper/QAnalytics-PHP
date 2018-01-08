<?php
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
            $dept = explode(" ", $code)[0];
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
            $dept = $code . "%";
            $cmd = $conn->prepare("SELECT * FROM courses WHERE code LIKE ? ORDER BY year ASC, semester DESC");
            $cmd->bind_param("s", $dept);
            $cmd->execute();

            $result = $cmd->get_result();
            $cur = count($this->infos) - 1;
            while($row = $result->fetch_assoc()){
                $sem = new Semester($row["semester"], $row["year"]);
                if(count($this->infos) < 1 || !$sem->equals($this->infos[$cur]->semester)){
                    if($cur >= 0){
                        $this->infos[$cur]->recommend /=$this->infos[$cur]->enrollment;
                        $this->infos[$cur]->workload /= $this->infos[$cur]->enrollment;

                        $this->infos[$cur]->recommend = round($this->infos[$cur]->recommend, 2);
                        $this->infos[$cur]->workload= round($this->infos[$cur]->workload, 2);

                        $this->infos[$cur]->adjust_workload();
                    }
                    array_push($this->infos, new Info($sem, 0, 0, 0));
                    $cur++;
                }

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