<?php

class Basic {

    function unsetArray($array, $delarr) {
        foreach ($array as $bkey => $bvalue) {
            foreach ($delarr as $key => $value) {
                if ($value == $bkey) {
                    unset($array[$bkey]);
                }
            }
        }
        return $array;
    }

    function insert($arr, $table) {
        if ($arr) {
            foreach ($arr as $key => $value) {
                @$fild[] = "`" . $key . "`";
                @$vals[] = "'" . $value . "'";
            }
        }
        $fild = implode($fild, ",");
        $vals = implode($vals, ",");
        return @$sql = " insert into " . $table . "(" . $fild . ")values(" . $vals . ")";
    }

    function update($arr, $table, $where) {
        $str = "UPDATE `$table` SET ";
        foreach ($arr as $key => $value) {
            $str_key.="`" . $key . "`='" . $value . "',";
        }
        $str_key = substr($str_key, 0, -1);
        foreach ($where as $key => $value) {
            $sql_where.="`$key`" . "='" . $value . "' AND";
        }
        $sql_where = substr($sql_where, 0, -4);
        return $sql_update = $str . $str_key . " WHERE " . $sql_where . ";";
    }

    function popup($tips, $location = '', $target = '') {
        $target = ($target == '') ? "window" : $target;
        if (!empty($location))
            $location = $target . ".location.href = '$location'";
        else
            $location = "history.back();";

        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
						<script type=\"text/javascript\">\n
							alert('$tips');\n
							$location;\n
						</script>\n";
        exit();
    }

}

?>