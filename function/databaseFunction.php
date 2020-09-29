<?php



/**
 * function name: getSingleDataFromTable
 *
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * @param row_name this param get row name for select row.
 * @param col_id this param get column id id for find data.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getSingleDataFromTable')){
    function getSingleDataFromTable($connect,$tableName,$rowName,$colId){
        
        $getData = $connect->prepare("SELECT $rowName FROM `$tableName` WHERE id=$colId");
        $getData->execute();

        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
}


/**
 * function name: getAllDataFromTable
 *
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getAllDataFromTable')){
    function getAllDataFromTable($connect,$tableName){
    
        $getData = $connect->prepare("SELECT * FROM `$tableName`");
        $getData->execute();
    
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
    
}


/**
 * function name: getAllDataFromTableUsingId
 *
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * @param col_id this param get column id id for find data.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getAllDataFromTableUsingId')){
    function getAllDataFromTableUsingId($connect,$tableName,$colId){
    
        $getData = $connect->prepare("SELECT * FROM `$tableName` WHERE id=$colId;");
        $getData->execute();
    
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
}


/**
 * function name: getDataAllDataByDESC
 * 
 * this function get data using order by DESC.
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getDataAllDataByDESC')){
    function getDataAllDataByDESC($connect,$tableName){

        $getData = $connect->prepare("SELECT * FROM $tableName ORDER BY id DESC;");
        $getData->execute();
    
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
    
}




/**
 * function name: deleteAllDataUsingId
 * 
 * this function get data using order by DESC.
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('deleteAllDataUsingId')){
    function deleteAllDataUsingId($connect,$tableName,$id){

        try{
            $getData = $connect->prepare("DELETE FROM `$tableName` WHERE id=$id;");
            $getData->execute();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    
}




/**
 * function name: getDataUsingOrderAndId
 *
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * @param user_id this param get user id number for find data.
 * @param user_id_col_name this param get user id column name.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getDataUsingOrderAndId')){
    function getDataUsingOrderAndId($connect,$tableName,$userId,$userIdColName){
        // execute queries and get data in variable
        $getData = $connect->prepare(" SELECT * FROM $tableName WHERE $userIdColName=$userId ORDER BY id DESC;");
        $getData->execute();
        // return data
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
}


/**
 * function name: getDataUsingOrderAndId
 *
 * @param connect   this param get connection from database.
 * @param tableName this param get database table name, This function can be dubbed in this table.
 * @param user_id this param get user id number for find data.
 * @param user_id_col_name this param get user id column name.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getDataUsingColNameAndId')){
    function getDataUsingColNameAndId($connect,$tableName,$userId,$colName){
        // execute queries and get data in variable
        $getData = $connect->prepare(" SELECT * FROM $tableName WHERE $colName=$userId;");
        $getData->execute();
        // return data
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
}



/**
 * function name: getFriendsData
 * this function get user data from user table 
 * using friend list from pivot table.
 * pivot table is frendslist.
 * 
 * @param connect   this param get connection from database.
 * @param user_id this param get user id number for find data.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
if(!function_exists('getFriendsData')){
    function getFriendsData($connect,$userId){
        // execute queries and get data in variable
        $getData = $connect->prepare("SELECT * FROM `tb_user_info` WHERE id IN(SELECT friends_id FROM frendslist WHERE user_id=$userId);");
        $getData->execute();

        // return data
        return $getData->fetchAll(PDO::FETCH_OBJ);
    }
}



