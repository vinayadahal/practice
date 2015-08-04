<?php

class query {

    private $dbh;

    public function __construct() {
        if (setPersistence == TRUE) {
            $this->dbh = new PDO("mysql:host=" . host . ";dbname=" . database, username, password, array(PDO::ATTR_PERSISTENT => true));
        } elseif (setPersistence == FALSE) {
            $this->dbh = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
        } else {
            echo 'Persistence must be set to TRUE or FALSE';
            exit();
        }
    }

    function select_like($col, $table, $id, $val) { //takes one keyword only also selects distinct
        $field = "`" . implode("`,`", $col) . "`";
        $query = "SELECT " . $field . " FROM `$table` WHERE `$id` LIKE '%' ? '%'";
        $bind = $this->dbh->prepare($query);
        $bind->bindParam(1, $val);
        $res = $bind->execute();
        if ($res == true) {
            return($bind->fetchAll(PDO::FETCH_ASSOC));
        }
    }

    function select_one($col, $table, $id, $val, $limit = NULL) {
        $field = "`" . implode("`,`", $col) . "`"; //Send Cols like this: $col = array('`username`', '`password`', '`mem_role`', '`agent_id`');
        if (is_array($id) && is_array($val)) {// must contains array to work otherwise it will fail
            if ($limit == NULL) {
                $query = "SELECT " . $field . " FROM `$table` WHERE `$id[0]`=? AND `$id[1]`=?";
            } else {
                $query = "SELECT " . $field . " FROM `$table` WHERE `$id[0]`=? AND `$id[1]`=? LIMIT $limit";
            }
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val[0]);
            $bind->bindParam(2, $val[1]);
            $res = $bind->execute();
            if ($res == true) {
                return($bind->fetchAll(PDO::FETCH_ASSOC));
            }
        } elseif (!is_array($id) || empty($id) && !is_array($val) || empty($val)) { //nothing should be array ohterwise it will fail
            if ($limit == NULL) {
                $query = "SELECT " . $field . " FROM `$table` WHERE $id=?";
            } else {
                $query = "SELECT " . $field . " FROM `$table` WHERE $id=? LIMIT $limit";
            }
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val);
            $res = $bind->execute();
            if ($res == true) {
                return($bind->fetchAll(PDO::FETCH_ASSOC));
            }
        }
        return 0;
    }

    function select_triple_var($col, $table, $id, $val) {
        $field = "`" . implode("`,`", $col) . "`"; //Send Cols like this: $col = array('`username`', '`password`', '`mem_role`', '`agent_id`');
        if (is_array($id) && is_array($val)) {// must contains array to work otherwise it will fail
            $query = "SELECT " . $field . " FROM `$table` WHERE `$id[0]`=? AND `$id[1]`=? AND `$id[2]`=?";
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val[0]);
            $bind->bindParam(2, $val[1]);
            $bind->bindParam(3, $val[2]);
            $res = $bind->execute();
            if ($res == true) {
                return($bind->fetchAll(PDO::FETCH_ASSOC));
            }
        }
        return 0;
    }

    function select_four_var($col, $table, $id, $val) {
        $field = "`" . implode("`,`", $col) . "`"; //Send Cols like this: $col = array('`username`', '`password`', '`mem_role`', '`agent_id`');
        if (is_array($id) && is_array($val)) {// must contains array to work otherwise it will fail
            $query = "SELECT " . $field . " FROM `$table` WHERE `$id[0]`=? AND `$id[1]`=? AND `$id[2]`=? AND `$id[3]`=?";
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val[0]);
            $bind->bindParam(2, $val[1]);
            $bind->bindParam(3, $val[2]);
            $bind->bindParam(4, $val[3]);
            $res = $bind->execute();
            if ($res == true) {
                return($bind->fetchAll(PDO::FETCH_ASSOC));
            }
        }
        return 0;
    }

    function select_single($col, $table, $id, $val) {
        $field = "`" . implode("`,`", $col) . "`"; //Send Cols like this: $col = array('`username`', '`password`', '`mem_role`', '`agent_id`');
        if (is_array($id) && is_array($val)) {// must contains array to work otherwise it will fail
            $query = "SELECT " . $field . " FROM `$table` WHERE `$id[0]`=? AND `$id[1]`=?";
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val[0]);
            $bind->bindParam(2, $val[1]);
            $res = $bind->execute();
            if ($res == true) {
                return($bind->fetch(PDO::FETCH_ASSOC));
            }
        } elseif (!is_array($id) || empty($id) && !is_array($val) || empty($val)) { //nothing should be array ohterwise it will fail
            $query = "SELECT " . $field . " FROM `$table` WHERE $id=?";
            $bind = $this->dbh->prepare($query);
            $bind->bindParam(1, $val);
            $res = $bind->execute();
            if ($res == true) {
                return ($bind->fetch(PDO::FETCH_ASSOC));
            }
        }
    }

    function select_all($table, $start = NULL, $dataPerPage = NULL) {
        if ($start == NULL && $dataPerPage == NULL) {
            $query = "SELECT * FROM $table";
        } else {
            $query = "SELECT * FROM $table LIMIT $start, $dataPerPage";
        }
        $val = $this->dbh->prepare($query);
        $res = $val->execute();
        if ($res == true) {
            return($val->fetchAll(PDO::FETCH_ASSOC));
        } else {
            return 0;
        }
    }

    function select_all_order($table, $col_name, $order, $limit = NULL, $condCol = NULL, $condVal = NULL) { //send order like asc or desc
        if ($limit == NULL && $condCol == NULL && $condVal == NULL) {
            $query = "SELECT * FROM $table ORDER BY $col_name $order";
        } else {
            if ($condCol == NULL && $condVal == NULL) {
                $query = "SELECT * FROM $table ORDER BY $col_name $order LIMIT $limit";
            } else {
                $obj_query = new query();
                $query = $obj_query->checkLimit($table, $col_name, $order, $limit, $condCol, $condVal);
            }
        }
        $val = $this->dbh->prepare($query);
        $res = $val->execute();
        if ($res == true) {
            return($val->fetchAll(PDO::FETCH_ASSOC));
        } else {
            return 0;
        }
    }

    public function checkLimit($table, $col_name, $order, $limit = NULL, $condCol = NULL, $condVal = NULL) {
        if ($limit != 'NULL') {
            $query = "SELECT * FROM $table WHERE `$condCol` = '$condVal' ORDER BY `$col_name` $order LIMIT $limit";
        } else {
            $query = "SELECT * FROM $table WHERE `$condCol` = '$condVal' ORDER BY `$col_name` $order ";
        }
        return $query;
    }

    function select_count_col($col, $table, $order, $limit, $groupById = NULL) {
        $query = "SELECT $col FROM $table GROUP BY `$groupById` ORDER BY COUNT(*) $order LIMIT $limit";
        $bind = $this->dbh->prepare($query);
        $res = $bind->execute();
        if ($res == true) {
            return ($bind->fetchAll(PDO::FETCH_ASSOC));
        }
    }

    function select_distinct_col($col, $table) {
        $query = "SELECT DISTINCT `$col` FROM `$table`";
        $val = $this->dbh->prepare($query);
        $res = $val->execute();
        if ($res == true) {
            return($val->fetchAll(PDO::FETCH_ASSOC));
        } else {
            return 0;
        }
    }

    function insert($col, $info, $table) {
        $field = "`" . implode("`, `", $col) . "`"; //Send Cols like this: $col = array('`username`', '`password`', '`mem_role`', '`agent_id`');
        $cnt = count($col);
        for ($i = 0; $i < $cnt; $i++) {
            $bind_val[] = '?';
        }
        $b_val = implode(", ", $bind_val);
        $query = "INSERT INTO $table($field)VALUES($b_val)";
        $bind = $this->dbh->prepare($query);
        for ($i = 0; $i < $cnt; $i++) {
            $bind->bindParam($i + 1, $info[$i]);
        }
        $result = $bind->execute();
        if ($result == 1) {
            return 'success';
        }
    }

    function update($col, $info, $table, $pk, $id) {// send col in 'email,code,type' format not in array format.
        $i = 0;
        $cols = explode(',', $col);
        foreach ($cols as $field) {
            $query = "UPDATE $table SET `$field` = ? WHERE `$pk` = ?;";
            $bind = $this->dbh->prepare($query);
            $result[] = $bind->execute(array($info[$i], $id));
            $i++;
        }
        if (count($result) == $i) {
            return true;
        } else {
            return false;
        }
    }

    function delete_one($table, $pk, $id) {
        $query = "DELETE FROM $table WHERE `$pk` = '$id';";
        $result = $this->dbh->exec($query);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

}
