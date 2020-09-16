<?php
/**
 * Class to describe voters.
 *
 * @author      Lee Garner <lee@leegarner.com>
 * @copyright   Copyright (c) 2020 Lee Garner <lee@leegarner.com>
 * @package     polls
 * @version     v3.0.0
 * @license     http://opensource.org/licenses/gpl-2.0.php
 *              GNU Public License v2 or later
 * @filesource
 */
namespace Polls;


/**
 * Class to manage poll voters.
 * @package polls
 */
class Voter
{
    /**
     * Check if the user has already voted.
     * For anonymous, checks the IP address and the poll cookie.
     *
     * @param   string  $pid    Poll ID
     * @return  boolean     True if the user has voted, False if not
     */
    public static function hasVoted($pid)
    {
        global $_USER, $_TABLES;

        // If logged in and the user ID is in the voters table,
        // we can trust that this user has voted.
        if (!COM_isAnonUser()) {
            if (DB_count(
                $_TABLES['pollvoters'],
                 array('uid', 'pid'),
                 array((int)$_USER['uid'], DB_escapeString($pid)) ) > 0
            ) {
                return true;
            }
        }

        // For Anonymous we only have the cookie and IP address.
        if (isset($_COOKIE['poll-' . $pid])) {
            return true;
        }

        $ip = DB_escapeString(self::getIpAddress());
        if (
            $ip != '' &&
            DB_count(
                $_TABLES['pollvoters'],
                array('ipaddress', 'pid'),
                array($ip, DB_escapeString($pid))
            ) > 0
        ) {
            return true;
        }

        // No vote found
        return false;
    }


    /**
     * Get the current user's actual IP address.
     *
     * @return  string      User's IP address
     */
    public static function getIpAddress()
    {
        return $_SERVER['REAL_ADDR'];
    }


    /**
     * Create a voter record.
     * This only inserts new records, no updates, so `INSERT IGNORE` is used
     * just to avoid SQL errors.
     *
     * @param   string  $pid    Poll ID
     */
    public static function create($pid)
    {
        global $_USER, $_TABLES;

        if ( COM_isAnonUser() ) {
            $userid = 1;
        } else {
            $userid = (int)$_USER['uid'];
        }
        // This always does an insert so no need to provide key_field and key_value args
        $sql = "INSERT IGNORE INTO {$_TABLES['pollvoters']} SET
            ipaddress = '" . DB_escapeString(Voter::getIpAddress()) . "',
            uid = '$userid',
            date = UNIX_TIMESTAMP(),
            pid = '" . DB_escapeString($pid) . "'";
        return DB_query($sql);
    }

}

?>
