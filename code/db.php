<?php

class DbUtil {

    private $db_host = "";
    private $db_user = "";
    private $db_pass = "";
    private $db_name = "";
    private $connected = false;
    private $result = array();

    public function connect() {
        if (!$this->connected) {
            $myconn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            if ($myconn) {
                $seldb = @mysql_select_db($this->db_name, $myconn);
                if ($seldb) {
                    $this->connected = true;
                    return true;
                } else {
                    array_push($this->result, mysql_error());
                    return false;
                }
            } else {
                array_push($this->result, mysql_error());
                return false;
            }
        } else {
            return true;
        }
    }

    public function disconnect() {
        if ($this->connected) {
            if (@mysql_close()) {
                $this->connected = false;
                return true;
            } else {
                return false;
            }
        }
    }

    private function sql($sql) {
        $query = @mysql_query($sql);
        if ($query) {
            $this->numResults = mysql_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysql_fetch_array($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    if (!is_int($key[$x])) {
                        if (mysql_num_rows($query) > 1) {
                            $this->result[$i][$key[$x]] = $r[$key[$x]];
                        } else if (mysql_num_rows($query) < 1) {
                            $this->result = null;
                        } else {
                            $this->result[$key[$x]] = $r[$key[$x]];
                        }
                    }
                }
            }
            return true;
        } else {
            array_push($this->result, mysql_error());
            return false;
        }
    }

    private function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null) {
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        if ($join != null) {
            $q .= ' NATURAL JOIN ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        if ($limit != null) {
            $q .= ' LIMIT ' . $limit;
        }
        if ($this->tableExists($table)) {
            $query = @mysql_query($q);
            if ($query) {
                $this->numResults = mysql_num_rows($query);
                for ($i = 0; $i < $this->numResults; $i++) {
                    $r = mysql_fetch_array($query);
                    $key = array_keys($r);
                    for ($x = 0; $x < count($key); $x++) {
                        if (!is_int($key[$x])) {
                            if (mysql_num_rows($query) > 1) {
                                $this->result[$i][$key[$x]] = $r[$key[$x]];
                            } else if (mysql_num_rows($query) < 1) {
                                $this->result = null;
                            } else {
                                $this->result[$key[$x]] = $r[$key[$x]];
                            }
                        }
                    }
                }
                return true;
            } else {
                array_push($this->result, mysql_error());
                return false;
            }
        } else {
            return false;
        }
    }

    private function insert($table, $params = array()) {
        if ($this->tableExists($table)) {
            $sql = 'INSERT INTO `' . $table . '` (`' . implode('`, `', array_keys($params)) . '`) VALUES (\'' . implode('\', \'', $params) . '\')';
            if ($ins = @mysql_query($sql)) {
                array_push($this->result, mysql_insert_id());
                return true;
            } else {
                array_push($this->result, mysql_error());
                return false;
            }
        } else {
            return false;
        }
    }

    private function delete($table, $where = null) {

        if ($this->tableExists($table)) {
            if ($where == null) {
                $delete = 'DELETE ' . $table;
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
            }
            if ($del = @mysql_query($delete)) {
                array_push($this->result, mysql_affected_rows());
                return true;
            } else {
                array_push($this->result, mysql_error());
                return false;
            }
        } else {
            return false;
        }
    }

    private function update($table, $params = array(), $where) {
        if ($this->tableExists($table)) {
            $args = array();
            foreach ($params as $field => $value) {
                $args[] = $field . '="' . $value . '"';
            }
            $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $args) . ' WHERE ' . $where;
            if ($query = @mysql_query($sql)) {
                array_push($this->result, mysql_affected_rows());
                return true;
            } else {
                array_push($this->result, mysql_error());
                return false;
            }
        } else {
            return false;
        }
    }

    private function tableExists($table) {
        $tablesInDb = @mysql_query('SHOW TABLES FROM ' . $this->db_name . ' LIKE "' . $table . '"');
        if ($tablesInDb) {
            if (mysql_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                array_push($this->result, $table . " does not exist in this database");
                return false;
            }
        }
    }

    private function getResult() {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    private function sanatize($str) {
        $search=array("\\","\0","\n","\r","\x1a","'",'"');
        $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
        return str_replace($search,$replace,$str);
    }

    public function indexPersonLocation() {
        $this->select('Person', '*', 'lives_in NATURAL JOIN works_for', NULL, NULL);
        return $this->getResult();
    }

    public function exportJson() {
        $this->select('Person', '*', 'lives_in NATURAL JOIN works_for'); 
        $result = $this->getResult();
        echo(json_encode($result));
    }

    public function insertTransaction($fname, $lname, $compID, $major, $minor, $school, $companyName, $city, $state, $position, $search) {
        $fname = $this->sanatize($fname);
        $lname = $this->sanatize($lname);
        $compID = $this->sanatize($compID);
        $major = $this->sanatize($major);
        $minor = $this->sanatize($minor);
        $school = $this->sanatize($school);
        $companyName = $this->sanatize($companyName);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);
        $position = $this->sanatize($position);
        $search = $this->sanatize($search);

        @mysql_query("SET AUTOCOMMIT=0");
        @mysql_query("START TRANSACTION");

        if ($search){
            $searchNum = 1;
        }
        else{
            $searchNum = 0;
        }

        $personq = @mysql_query("INSERT INTO Person (firstName, lastName, computingID, major, minor, school, searchRoom) VALUES(\""
            . $fname . "\",\""
            . $lname . "\",\""
            . $compID . "\",\""
            . $major . "\",\""
            . $minor . "\",\""
            . $school . "\",\""
            . $search . "\")");

        // Check if the city is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM City WHERE cityName='"
            . $city . "' AND state='"
            . $state . "') AS val"));
        // It is not in db, so insert the city
        if ($r['val'] == 0) {
            $cityq = @mysql_query("INSERT INTO City (cityName, state, population) VALUES(\""
                . $city . "\",\""
                . $state . "\",\""
                . "1" . "\")");
        } else {
            // it is in the db, update
            $cityq = @mysql_query("UPDATE City SET population = population + 1 WHERE cityName='"
                . $city . "' AND state='"
                . $state . "'");
        }

        // Check if the company is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM Company WHERE companyName='"
            . $companyName . "') AS val"));
        // It is not in db, so insert the company
        if ($r['val'] == 0) {
            $companyq = @mysql_query("INSERT INTO Company (companyName, population) VALUES(\""
                . $companyName . "\",\""
                . "1" . "\")");
        } else {
            // it is in the db, so continue anyway
            $companyq = true;
            $companyq = @mysql_query("UPDATE Company SET population = population + 1 WHERE companyName='"
                . $companyName . "'");
        }

        $worksq = @mysql_query("INSERT INTO works_for (computingID, companyName, position) VALUES(\""
            . $compID . "\",\""
            . $companyName . "\",\""
            . $position . "\")");

        $livesq = @mysql_query("INSERT INTO lives_in (computingID, cityName, state) VALUES(\""
            . $compID . "\",\""
            . $city . "\",\""
            . $state . "\")");

        // Check if the office is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM offices_in WHERE companyName='"
            . $companyName . "' AND cityName='" . $city . "' AND state='" . $state . "') AS val"));
        // It is not in db, so insert the office
        if ($r['val'] == 0) {
            $officesq = @mysql_query("INSERT INTO offices_in (companyName, cityName, state) VALUES(\""
                . $companyName . "\",\""
                . $city . "\",\""
                . $state . "\")");
        } else {
            // it is in the db, so continue anyway
            $officesq = true;
        }

        if ($personq and $cityq and $companyq and $worksq and $livesq and $officesq) {
            @mysql_query("COMMIT");
            return true;
        } else {
            @mysql_query("ROLLBACK");
            return false;
        }
    }

    public function search($first, $last, $major, $company, $city, $state, $school) {
        $first = $this->sanatize($first);
        $last = $this->sanatize($last);
        $major = $this->sanatize($major);
        $company = $this->sanatize($company);
        $school = $this->sanatize($school);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);
        $q = "";
        if ($first) {
            $q .= "firstName like '%" . $first . "%'";
        }
        if ($last) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "lastName like '%" . $last . "%'";
        }
        if ($major) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "major like '%" . $major . "%'";
        }
        if ($company) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "companyName like '%" . $company . "%'";
        }
        if ($city) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "cityName like '%" . $city . "%'";
        }
        if ($state) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "state like '%" . $state . "%'";
        }
        if ($school) {
            if ($q != "") {
                $q .= " and ";
            }
            $q.= "school like '%" . $school . "%'";
        }
        if ($q == "") {
            return false;
        }
        $this->select('Person', '*', 'lives_in NATURAL JOIN works_for', $q, NULL);
        return $this->getResult();
    }

    public function registered($compID) {
        $compID = $this->sanatize($compID);
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM Person WHERE computingID='"
            . $compID . "') AS val"));
        if ($r['val'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMessage($to, $from, $subject, $message) {
        $to = $this->sanatize($to);
        $from = $this->sanatize($from);
        $subject = $this->sanatize($subject);
        $message = $this->sanatize($message);
        $this->insert('message', array('toID' => $to, 'fromID' => $from, 'message' => $message, 'subject' => $subject));
        $res = $this->getResult();
        if ($res[0] == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function sendPost($from, $subject, $message) {
        $from = $this->sanatize($from);
        $subject = $this->sanatize($subject);
        $message = $this->sanatize($message);
        $location = $this->select('lives_in', 'cityName, state', NULL, 'computingID="' . $from . '"'); 
        $location = $this->getResult(); 
        $this->insert('post', array('fromID' => $from, 'cityName' => $location['cityName'], 'state' => $location['state'], 'message' => $message, 'subject' => $subject));
        $res = $this->getResult();
        if ($res[0] == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTransaction($fname, $lname, $compID, $major, $minor, $school, $companyName, $city, $state, $position, $search) {
        $fname = $this->sanatize($fname);
        $lname = $this->sanatize($lname);
        $compID = $this->sanatize($compID);
        $major = $this->sanatize($major);
        $minor = $this->sanatize($minor);
        $school = $this->sanatize($school);
        $companyName = $this->sanatize($companyName);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);
        $position = $this->sanatize($position);
        $search = $this->sanatize($search);

        @mysql_query("SET AUTOCOMMIT=0");
        @mysql_query("START TRANSACTION");

        if ($search){
            $searchNum = 1;
        }
        else{
            $searchNum = 0;
        }

        $personq = @mysql_query("UPDATE Person SET firstName = '$fname',
            lastName = '$lname',
            major = '$major',
            minor = '$minor',
            school = '$school',
            searchRoom = $searchNum WHERE computingID = '$compID'");

        // Check if the city is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM City WHERE cityName='"
            . $city . "' AND state='"
            . $state . "') AS val"));
        // It is not in db, so insert the city
        if ($r['val'] == 0) {
            $cityq = @mysql_query("INSERT INTO City (cityName, state, population) VALUES(\""
                . $city . "\",\""
                . $state . "\",\""
                . "1" . "\")");
        } else {
            // see if the person was already living there
            $flag = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM lives_in WHERE cityName='" . $city . "' AND state='" . $state . "' AND computingID='" . $compID . "') AS val"));
            if ($flag['val'] == 0) {
                // they weren't already living there
                $pop = @mysql_query("UPDATE City NATURAL JOIN lives_in SET City.population = City.population - 1 WHERE computingID = '$compID'");
                $cityq = @mysql_query("UPDATE City SET population = population + 1 WHERE cityName='$city' AND state='$state'");
            } else {
                // they were already living there, do not update pop
                $cityq = true;
            }
        }

        // Check if the city is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM Company WHERE companyName='"
            . $companyName . "') AS val"));
        // It is not in db, so insert the city
        if ($r['val'] == 0) {
            $companyq = @mysql_query("INSERT INTO Company (companyName, population) VALUES(\""
                . $companyName . "\",\""
                . "1" . "\")");
        } else {
            // see if the person was already living there
            $flag = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM works_for WHERE companyName='" . $city . "' AND computingID='" . $compID . "') AS val"));
            if ($flag['val'] == 0) {
                // they weren't already living there
                $pop = @mysql_query("UPDATE Company NATURAL JOIN works_for SET Company.population = Company.population - 1 WHERE computingID = '$compID'");
                $companyq = @mysql_query("UPDATE Company SET population = population + 1 WHERE companyName='$companyName'");
            } else {
                // they were already living there, do not update pop
                $companyq = true;
            }
        }


        // CHANGE TO UPDATES
        $worksq = @mysql_query("UPDATE works_for SET companyName = '$companyName', position = '$position' WHERE computingID = '$compID'");
        // CHANGE TO UPDATES
        $livesq = @mysql_query("UPDATE lives_in SET cityName = '$city', state = '$state' WHERE computingID = '$compID' ");

        // Check if the office is already in our db
        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM offices_in WHERE companyName='"
            . $companyName . "' AND cityName='" . $city . "' AND state='" . $state . "') AS val"));
        // It is not in db, so insert the office
        if ($r['val'] == 0) {
            $officesq = @mysql_query("INSERT INTO offices_in (companyName, cityName, state) VALUES(\""
                . $companyName . "\",\""
                . $city . "\",\""
                . $state . "\")");
        } else {
            // it is in the db, so continue anyway
            $officesq = true;
        }

        if ($personq and $cityq and $companyq and $worksq and $livesq and $officesq) {
            @mysql_query("COMMIT");
            return true;
        } else {
            @mysql_query("ROLLBACK");
            return false;
        }
    }

    public function indexMessage($compID) {
        $compID = $this->sanatize($compID);
        $q = 'toID="' . $compID . '" OR fromID="' . $compID . '"';
        $this->select('message', '*', NULL, $q, "sent DESC", NULL);
        return $this->getResult();
    }

    public function indexPost($compID) {
        $compID = $this->sanatize($compID);
        $location = $this->select('lives_in', 'cityName, state', NULL, 'computingID="' . $compID . '"'); 
        $location = $this->getResult(); 
        $q = 'cityName="' . $location['cityName'] . '" AND state="' . $location['state'] . '"';
        $this->select('post', '*', NULL, $q, "sent DESC", NULL);
        return $this->getResult();
    }

    public function findRoommate($compID) {
        $compID = $this->sanatize($compID);
        $result = @mysql_query("SELECT cityName, state FROM lives_in WHERE computingID = '" . $compID . "'");
        $row = mysql_fetch_assoc($result);
        $city = $row["cityName"];
        $state = $row["state"];
        $this->select('Person', '*', 'lives_in NATURAL JOIN works_for', 'searchRoom = 1 
            AND cityName = "' . $city . '" 
            AND state = "' . $state . '" 
            AND computingID != "' . $compID . '"', NULL);
        #$this->select('Person', '*', 'lives_in', 'searchRoom = 1', NULL); 
        return $this->getResult(); 
    }

    public function findInCity($compID) {
        $compID = $this->sanatize($compID);
        $result = @mysql_query("SELECT cityName, state FROM lives_in WHERE computingID = '" . $compID . "'");
        $row = mysql_fetch_assoc($result);
        $city = $row["cityName"];
        $state = $row["state"];
        $this->select('Person', '*', 'lives_in NATURAL JOIN works_for', 'cityName = "' . $city . '" 
            AND state = "' . $state . '" 
            AND computingID != "' . $compID . '"', NULL);
        return $this->getResult(); 
    }

    public function getPerson($compID) {
      $compID = $this->sanatize($compID);
      $q = "computingID='$compID'"; 
      $this->select('Person', '*', 'lives_in NATURAL JOIN works_for', $q, NULL);
      return $this->getResult(); 
    }

    public function getStats($compID) {
      $compID = $this->sanatize($compID);
      $result = array(); 
      $location = $this->select('lives_in', 'cityName, state', NULL, 'computingID="' . $compID . '"'); 
      $location = $this->getResult(); 
      $city=$location['cityName']; 
      $state=$location['state']; 
      $result = mysql_fetch_assoc(@mysql_query("SELECT companyName FROM works_for WHERE computingID = '" . $compID . "'"));
      $companyName = $result["companyName"];
      $r = mysql_fetch_assoc(@mysql_query("SELECT COUNT(computingID) FROM (Person NATURAL JOIN lives_in) WHERE cityName='$city' AND state='$state' AND computingID!='$compID'"));
      $result['numCity'] = $r['COUNT(computingID)']; 
      $r = mysql_fetch_assoc(@mysql_query("SELECT COUNT(computingID) FROM (Person NATURAL JOIN works_for) WHERE companyName='$companyName' AND computingID!='$compID'"));
      $result['numCompany'] = $r['COUNT(computingID)']; 
      $r = mysql_fetch_assoc(@mysql_query("SELECT COUNT(computingID) FROM (Person NATURAL JOIN lives_in) WHERE cityName='$city' AND state='$state' AND searchRoom=1 AND computingID!='$compID'"));
      $result['numRoom'] = $r['COUNT(computingID)']; 
      return $result; 
    }

    public function createClub($cname, $city, $state, $compID, $phone){
        $compID = $this->sanatize($compID);
        $cname = $this->sanatize($cname);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);
        $phone = $this->sanatize($phone);
        @mysql_query("SET AUTOCOMMIT=0");
        @mysql_query("START TRANSACTION");

        $clubq = @mysql_query("INSERT INTO UVAClub (clubName, cityName, state, contactMail, phoneNum) VALUES('$cname','$city','$state','$compID', $phone)");

        if ($clubq) {
            @mysql_query("COMMIT");
            return true;
        } else {
            @mysql_query("ROLLBACK");
            return false;
        }
    }

    public function findClub($personCity, $personState){
        $personCity = $this->sanatize($personCity);
        $personState = $this->sanatize($personState);
        $this->select('UVAClub', '*', NULL, 'cityName = "' . $personCity . '" AND state = "' . $personState . '"', NULL);
            #$this->select('Person', '*', 'lives_in', 'searchRoom = 1 
                #AND cityName = "' . $city . '" 
                #AND state = "' . $state . '" 
                #AND computingID != "' . $compID . '"', NULL);
            #$this->select('Person', '*', 'lives_in', 'searchRoom = 1', NULL); 
        return $this->getResult(); 
    }

    public function findCompany($compID) {
        $compID = $this->sanatize($compID);
        $result = @mysql_query("SELECT companyName FROM works_for WHERE computingID = '" . $compID . "'");
        $row = mysql_fetch_assoc($result);
        $companyName = $row["companyName"];
        $this->select('Person', '*', 'works_for NATURAL JOIN lives_in',  
            'companyName = "' . $companyName . '" 
            AND computingID != "' . $compID . '"', NULL);
        return $this->getResult(); 
    }

    public function joinClub($compID, $city, $state){
        $compID = $this->sanatize($compID);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);
        @mysql_query("SET AUTOCOMMIT=0");
        @mysql_query("START TRANSACTION");

        $memq = @mysql_query("INSERT INTO member_of (computingID, cityName, state) VALUES('$compID', '$city', '$state')");

        if ($memq) {
            @mysql_query("COMMIT");
            return true;
        } else {
            @mysql_query("ROLLBACK");
            return false;
        }
    }

    public function findMembers($city, $state){
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);

        $this->select('Person', 'firstName, lastName, cityName, state, computingID', 'member_of', 'cityName = "' . $city . '" AND state = "' . $state . '"', NULL);
        return $this->getResult();
    }

    public function isMember($compID, $city, $state) {
        $compID = $this->sanatize($compID);
        $city = $this->sanatize($city);
        $state = $this->sanatize($state);

        $r = mysql_fetch_assoc(@mysql_query("SELECT EXISTS(SELECT 1 FROM Person NATURAL JOIN member_of WHERE cityName='"
            . $city . "' AND state='"
            . $state . "' AND computingID = '" . $compID . "') AS val"));

        if ($r['val'] == 1) {
            // if they are in club
            return true;
        }
        else {
            return false;
        }

    }
}

?>
