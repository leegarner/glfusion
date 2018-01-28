<?php
// +--------------------------------------------------------------------------+
// | glFusion CMS                                                             |
// +--------------------------------------------------------------------------+
// | lib-database.php                                                         |
// |                                                                          |
// | glFusion database library.                                               |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2008-2106 by the following authors:                        |
// |                                                                          |
// | Mark R. Evans          mark AT glfusion DOT org                          |
// |                                                                          |
// | Copyright (C) 2000-2008 by the following authors:                        |
// |                                                                          |
// | Authors: Tony Bibbs, tony AT tonybibbs DOT com                           |
// +--------------------------------------------------------------------------+
// |                                                                          |
// | This program is free software; you can redistribute it and/or            |
// | modify it under the terms of the GNU General Public License              |
// | as published by the Free Software Foundation; either version 2           |
// | of the License, or (at your option) any later version.                   |
// |                                                                          |
// | This program is distributed in the hope that it will be useful,          |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
// | GNU General Public License for more details.                             |
// |                                                                          |
// | You should have received a copy of the GNU General Public License        |
// | along with this program; if not, write to the Free Software Foundation,  |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.          |
// |                                                                          |
// +--------------------------------------------------------------------------+

/**
* This is the high-level database layer for glFusion (for the low-level stuff,
* see the system/databases directory).
*
*/

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own!');
}

// +---------------------------------------------------------------------------+
// | Table definitions, these are used by the install program to create the    |
// | database schema.  If you don't like the tables names, change them PRIOR   |
// | to running the install after running the install program DO NOT TOUCH     |
// | these. You have been warned!  Also, these variables are used in the core  |
// | glFusion code                                                             |
// +---------------------------------------------------------------------------+

$_TABLES['access']              = $_DB_table_prefix . 'access';
$_TABLES['article_images']      = $_DB_table_prefix . 'article_images';
$_TABLES['autotag_perm']        = $_DB_table_prefix . 'autotag_perm';
$_TABLES['autotag_usage']       = $_DB_table_prefix . 'autotag_usage';
$_TABLES['autotags']            = $_DB_table_prefix . 'autotags';
$_TABLES['blocks']              = $_DB_table_prefix . 'blocks';
$_TABLES['commentcodes']        = $_DB_table_prefix . 'commentcodes';
$_TABLES['commentedits']        = $_DB_table_prefix . 'commentedits';
$_TABLES['commentmodes']        = $_DB_table_prefix . 'commentmodes';
$_TABLES['comments']            = $_DB_table_prefix . 'comments';
$_TABLES['conf_values']         = $_DB_table_prefix . 'conf_values';
$_TABLES['cookiecodes']         = $_DB_table_prefix . 'cookiecodes';
$_TABLES['dateformats']         = $_DB_table_prefix . 'dateformats';
$_TABLES['featurecodes']        = $_DB_table_prefix . 'featurecodes';
$_TABLES['features']            = $_DB_table_prefix . 'features';
$_TABLES['frontpagecodes']      = $_DB_table_prefix . 'frontpagecodes';
$_TABLES['group_assignments']   = $_DB_table_prefix . 'group_assignments';
$_TABLES['groups']              = $_DB_table_prefix . 'groups';
$_TABLES['logo']                = $_DB_table_prefix . 'logo';
$_TABLES['maillist']            = $_DB_table_prefix . 'maillist';
$_TABLES['menu']                = $_DB_table_prefix . 'menu';
$_TABLES['menu_config']         = $_DB_table_prefix . 'menu_config';
$_TABLES['menu_elements']       = $_DB_table_prefix . 'menu_elements';
$_TABLES['pingservice']         = $_DB_table_prefix . 'pingservice';
$_TABLES['plugins']             = $_DB_table_prefix . 'plugins';
$_TABLES['postmodes']           = $_DB_table_prefix . 'postmodes';
$_TABLES['rating']              = $_DB_table_prefix . 'rating';
$_TABLES['rating_votes']        = $_DB_table_prefix . 'rating_votes';
$_TABLES['sessions']            = $_DB_table_prefix . 'sessions';
$_TABLES['social_share']        = $_DB_table_prefix . 'social_share';
$_TABLES['social_follow_services'] = $_DB_table_prefix . 'social_follow_services';
$_TABLES['social_follow_user']  = $_DB_table_prefix . 'social_follow_user';
$_TABLES['sortcodes']           = $_DB_table_prefix . 'sortcodes';
$_TABLES['speedlimit']          = $_DB_table_prefix . 'speedlimit';
$_TABLES['statuscodes']         = $_DB_table_prefix . 'statuscodes';
$_TABLES['stories']             = $_DB_table_prefix . 'stories';
$_TABLES['storysubmission']     = $_DB_table_prefix . 'storysubmission';
$_TABLES['subscriptions']       = $_DB_table_prefix . 'subscriptions';
$_TABLES['syndication']         = $_DB_table_prefix . 'syndication';
$_TABLES['tokens']              = $_DB_table_prefix . 'tokens';
$_TABLES['topics']              = $_DB_table_prefix . 'topics';
$_TABLES['trackback']           = $_DB_table_prefix . 'trackback';
$_TABLES['trackbackcodes']      = $_DB_table_prefix . 'trackbackcodes';
$_TABLES['usercomment']         = $_DB_table_prefix . 'usercomment';
$_TABLES['userindex']           = $_DB_table_prefix . 'userindex';
$_TABLES['userinfo']            = $_DB_table_prefix . 'userinfo';
$_TABLES['userprefs']           = $_DB_table_prefix . 'userprefs';
$_TABLES['users']               = $_DB_table_prefix . 'users';
$_TABLES['vars']                = $_DB_table_prefix . 'vars';
$_TABLES['tfa_backup_codes']    = $_DB_table_prefix . 'tfa_backup_codes';

// These tables aren't used by glFusion any more, but the table names are still
// needed when upgrading from old versions
$_TABLES['commentspeedlimit']   = $_DB_table_prefix . 'commentspeedlimit';
$_TABLES['submitspeedlimit']    = $_DB_table_prefix . 'submitspeedlimit';
$_TABLES['tzcodes']             = $_DB_table_prefix . 'tzcodes';
$_TABLES['userevent']           = $_DB_table_prefix . 'userevent';


// +---------------------------------------------------------------------------+
// | DO NOT TOUCH ANYTHING BELOW HERE                                          |
// +---------------------------------------------------------------------------+

/**
* Include appropriate DBMS object
*
*/
if ( !function_exists('mysqli_connect') && !function_exists('mysql_connect') ) {
    die("No MySQL driver found in PHP environment.");
}
if (($_DB_dbms === 'mysql') && class_exists('MySQLi')) {
    require_once $_CONF['path_system'] . 'databases/mysqli.class.php';
} else if ( ($_DB_dbms === 'mysqli') && !class_exists('MySQLi') ) {
    require_once $_CONF['path_system'] . 'databases/mysql.class.php';
} else {
    require_once $_CONF['path_system'] . 'databases/'. $_DB_dbms . '.class.php';
}
if ( $_DB_dbms == 'mysqli' ) {
    $_DB_dbms = 'mysql';
}
// Instantiate the database object
if ( !isset($_CONF['db_charset'])) $_CONF['db_charset'] = '';
$_DB = new database($_DB_host, $_DB_name, $_DB_user, $_DB_pass, 'COM_errorLog',
                    $_CONF['default_charset'], $_CONF['db_charset']);
unset($_DB_user);
unset($_DB_pass);

if ( isset($_SYSTEM['no_fail_sql']) && $_SYSTEM['no_fail_sql'] == 1 ) {
    $_DB->_no_fail = 1;
}

if (isset($_SYSTEM['rootdebug']) && $_SYSTEM['rootdebug']) {
    DB_displayError(true);
}

// +---------------------------------------------------------------------------+
// | These are the library functions.  In all cases they turn around and make  |
// | calls to the DBMS specific functions.  These ARE to be used directly in   |
// | the code...do NOT use the $_DB methods directly
// +---------------------------------------------------------------------------+


/**
* @return     string     the version of the database application as integer
*/
function DB_getVersion()
{
    global $_DB;

    return $_DB->dbGetVersion();
}


/**
* Turns debug mode on for the database library
*
* Setting this to true will cause the database code to print out
* various debug messages.  Setting it to false will supress the
* messages (is false by default). NOTE: Gl developers have put many
* useful debug messages into the mysql implementation of this.  If
* you are using something other than MySQL and if the GL team did
* not write it then you may or may not get something useful by turning
* this on.
*
* @param        boolean     $flag       true or false
*
*/
function DB_setdebug($flag)
{
    global $_DB;

    $_DB->setVerbose($flag);
}

/** Setting this on will return the SQL error message.
* Default is to not display or return the SQL error but
* to record it in the error.log file
*
* @param        boolean     $flag       true or false
*/
function DB_displayError($flag)
{
    global $_DB;

    $_DB->setDisplayError($flag);
}

/**
* Executes a query on the db server
*
* This executes the passed SQL and returns the recordset or errors out
*
* @param    mixed   $sql            String or array of strings of SQL to be executed
* @param    int     $ignore_errors  If 1 this function supresses any error messages
* @return   object  Returns results from query
*
*/
function DB_query ($sql, $ignore_errors = 0)
{
    global $_DB, $_DB_dbms;

    if (is_array ($sql)) {
        if (isset ($sql[$_DB_dbms])) {
            $sql = $sql[$_DB_dbms];
        } else {
            $errmsg = "No SQL request given for DB '$_DB_dbms', only got these:";
            foreach ($sql as $db => $request) {
                $errmsg .= LB . $db . ': ' . $request;
            }
            $result = COM_errorLog ($errmsg, 3);
            die ($result);
        }
    }

    return $_DB->dbQuery ($sql, $ignore_errors);
}

/**
* Saves information to the database
*
* This will use a REPLACE INTO to save a record into the
* database. NOTE: this function is going to change in the near future
* to remove dependency of REPLACE INTO. Please use DB_query if you can
*
* @param        string      $table          The table to save to
* @param        string      $fields         Comma demlimited list of fields to save
* @param        string      $values         Values to save to the database table
* @param        string      $return_page    URL to send user to when done
*
*/
function DB_save($table,$fields,$values,$return_page='')
{
    global $_DB,$_TABLES,$_CONF;

    $_DB->dbSave($table,$fields,$values);

    if (!empty($return_page)) {
       echo COM_refresh("$return_page");
    }

}

/**
* Deletes data from the database
*
* This will delete some data from the given table where id = value
*
* @param        string              $table          Table to delete data from
* @param        array|string        $id             field name(s) to use in where clause
* @param        array|string        $value          value(s) to use in where clause
* @param        string              $return_page    page to send user to when done
*
*/
function DB_delete($table,$id,$value,$return_page='')
{
    global $_DB,$_TABLES,$_CONF;

    $_DB->dbDelete($table,$id,$value);

    if (!empty($return_page)) {
        echo COM_refresh("$return_page");
    }

}

/**
* Gets a single item from the database
*
* @param        string      $table      Table to get item from
* @param        string      $what       field name to get
* @param        string      $selection  Where clause to use in SQL
* @return       mixed       Returns value sought
*
*/
function DB_getItem($table,$what,$selection='')
{
    if (!empty($selection)) {
        $sql = "SELECT $what FROM $table WHERE $selection";
        $result = DB_query($sql);
    } else {
        $sql = "SELECT $what FROM $table";
        $result = DB_query($sql);
    }
	if ($result === NULL || DB_error($sql) ) {
		return NULL;
	} else if (DB_numRows($result) == 0) {
		return NULL;
	} else {
		$ITEM = DB_fetcharray($result);
		return $ITEM[0];
	}
}

/**
* Changes records in a table
*
* This will change the data in the given table that meet the given criteria and will
* redirect user to another page if told to do so
*
* @param        string          $table              Table to perform change on
* @param        string          $item_to_set        field name to set
* @param        string          $value_to_set       Value to set abovle field to
* @param        array|string    $id                 field name(s) to use in where clause
* @param        array|string    $value              Value(s) to use in where clause
* @param	    string          $return_page        page to send user to when done with change
* @param        boolean         $supress_quotes     whether or not to use single quotes in where clause
*
*/
function DB_change($table,$item_to_set,$value_to_set,$id='',$value='',$return_page='',$supress_quotes=false)
{
    global $_DB,$_TABLES,$_CONF;

    $_DB->dbChange($table,$item_to_set,$value_to_set,$id,$value,$supress_quotes);

    if (!empty($return_page)) {
        echo COM_refresh("$return_page");
    }
}

/**
* Count records in a table
*
* This will return the number of records which meet the given criteria in the
* given table.
*
* @param        string              $table      Table to perform count on
* @param        array|string        $id         field name(s) to use in where clause
* @param        array|string        $value      Value(s) to use in where clause
* @return       int     Returns row count from generated SQL
*
*/
function DB_count($table,$id='',$value='')
{
    global $_DB;

    return $_DB->dbCount($table,$id,$value);
}

/**
* Copies a record from one table to another (can be the same table)
*
* This will use a REPLACE INTO...SELECT FROM to copy a record from one table
* to another table.  They can be the same table.
*
* @param        string          $table          Table to insert record into
* @param        string          $fields         Comma delmited list of fields to copy over
* @param        string          $values         Values to store in database field
* @param        string          $tablefrom      Table to get record from
* @param        array|string   	$id             Field name(s) to use in where clause
* @param        array|string    $value          Value(s) to use in where clause
* @param        string          $return_page    Page to send user to when done
*
*/
function DB_copy($table,$fields,$values,$tablefrom,$id,$value,$return_page='')
{
    global $_DB,$_TABLES,$_CONF;

    $_DB->dbCopy($table,$fields,$values,$tablefrom,$id,$value);

    if (!empty($return_page)) {
        echo COM_refresh("$return_page");
    }
}

/**
* Retrieves the number of rows in a recordset
*
* This returns the number of rows in a recordset
*
* @param        object     $recordset      The recordset to operate one
* @return       int         Returns number of rows returned by a previously executed query
*
*/
function DB_numRows($recordset)
{
    global $_DB;

    return $_DB->dbNumRows($recordset);
}

/**
* Retrieves the contents of a field
*
* This returns the contents of a field from a result set
*
* @param        object      $recordset      The recordset to operate on
* @param        int         $row            row to get data from
* @param        string      $field          field to return
* @return       (depends on the contents of the field)
*
*/
function DB_result($recordset,$row,$field)
{
    global $_DB;

    return $_DB->dbResult($recordset,$row,$field);
}

/**
* Retrieves the number of fields in a recordset
*
* This returns the number of fields in a recordset
*
* @param        object     $recordset       The recordset to operate on
* @return       int         Returns the number fields in a result set
*
*/
function DB_numFields($recordset)
{
    global $_DB;

    return $_DB->dbNumFields($recordset);
}

/**
* Retrieves returns the field name for a field
*
* Returns the field name for a given field number
*
* @param        object      $recordset      The recordset to operate on
* @param        int         $fnumber        field number to return the name of
* @return       string      Returns name of specified field
*
*/
function DB_fieldName($recordset,$fnumber)
{
    global $_DB;

    return $_DB->dbFieldName($recordset,$fnumber);
}

/**
* Retrieves returns the number of effected rows for last query
*
* Retrieves returns the number of effected rows for last query
*
* @param        object      $recordset      The recordset to operate on
* @return       int         returns numbe of rows affected by previously executed query
*
*/
function DB_affectedRows($recordset)
{
    global $_DB;

    return $_DB->dbAffectedRows($recordset);
}

/**
* Retrieves record from a recordset
*
* Gets the next record in a recordset and returns in array
*
* @param        object      $recordset      The recordset to operate on
* @param        boolean     $both           get both assoc and numeric indices
* @return       Array      Returns data for a record in an array
*
*/
function DB_fetchArray($recordset, $both = true)
{
    global $_DB;

    return $_DB->dbFetchArray($recordset, $both);
}

/**
* Retrieves all records from a recordset
*
* Gets all records in a recordset and returns in array
*
* @param        object      $recordset      The recordset to operate on
* @param        boolean     $both           get both assoc and numeric indices
* @return       Array      Returns data for a record in an array
*
*/
function DB_fetchAll($recordset, $both = false)
{
    global $_DB;

    return $_DB->dbFetchAll($recordset, $both);
}

/**
* Returns the last ID inserted
*
* Returns the last auto_increment ID generated
*
* @param    resources   $link_identifier    identifier for opened link
* @return   int                             Returns the last ID auto-generated
*
*/
function DB_insertId($link_identifier = '')
{
    global $_DB;

    return $_DB->dbInsertId($link_identifier);
}

/**
* returns a database error string
*
* Returns an database error message
*
* @return   string  Returns database error message
*
*/
function DB_error($sql = '')
{
    global $_DB;

    return $_DB->dbError($sql);
}

/**
* Creates database structures for fresh installation
*
* This may not be used by glFusion currently
*
* @return   boolean     returns true on success otherwise false
*
*/
function DB_createDatabaseStructures()
{
    global $_DB;

    return $_DB->dbCreateStructures();
}

/**
* Executes the sql upgrade script(s)
*
* @param        string      $current_gl_version     version of glFusion to upgrade from
* @return       boolean     returns true on success otherwise false
*
*/
function DB_doDatabaseUpgrade($current_gl_version)
{
    global $_DB;

    return $_DB->dbDoDatabaseUpgrade($current_gl_version);
}

/**
* Lock a table
*
* Locks a table for write operations
*
* @param    string      $table      Table to lock
* @return   void
* @see DB_unlockTable
*
*/
function DB_lockTable($table)
{
    global $_DB;

    $_DB->dbLockTable($table);
}

/**
* Unlock a table
*
* Unlocks a table after DB_lockTable
*
* @param    string      $table      Table to unlock
* @return   void
* @see DB_lockTable
*
*/
function DB_unlockTable($table)
{
    global $_DB;

    $_DB->dbUnlockTable($table);
}

/**
 * Check if a table exists
 *
 * @param   string $table   Table name
 * @return  boolean         True if table exists, false if it does not
 *
 */
function DB_checkTableExists($table)
{
    global $_TABLES, $_DB_dbms;

    $exists = false;

    if ($_DB_dbms == 'mysql' || $_DB_dbms == 'mysqli' ) {
        $result = DB_query ("SHOW TABLES LIKE '{$_TABLES[$table]}'");
        if (DB_numRows ($result) > 0) {
            $exists = true;
        }
    } elseif ($_DB_dbms == 'mssql') {
        $result = DB_Query("SELECT 1 FROM sysobjects WHERE name='{$_TABLES[$table]}' AND xtype='U'");
        if (DB_numRows ($result) > 0) {
            $exists = true;
        }
    }

    return $exists;
}

/**
* escape a string
*
* Escapes special characters in the unescaped_string , taking into account
* the current character set of the connection so that it is safe to place
* it in a SQL query.
*
* @param    string      $str      String to escape
* @return   void
*
*/
function DB_escapeString($str)
{
    global $_DB;
    if ( $_DB->getFilter() != 0 ) {
        $str = preg_replace('/[\x{10000}-\x{10FFFF}]/u', "?", $str);
        $str = preg_replace('/([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{200D}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?/u', '?', $str);
    }
    return $_DB->dbEscapeString($str);
}

/**
* @return     int     the version of the client libraries application as integer
*/
function DB_getClientVersion()
{
    global $_DB;

    return $_DB->dbGetClientVersion();
}

/**
* @return     int     the version of the database application as integer
*/
function DB_getServerVersion()
{
    global $_DB;

    return $_DB->dbGetServerVersion();
}
?>