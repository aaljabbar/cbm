<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7.
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
//putenv("ORACLE_HOME=/usr/lib/oracle/11.1/client64/lib");

$active_group = 'default';
$active_record = TRUE;
	
$db['default']['hostname'] ='
    (DESCRIPTION=
        (FAILOVER=on)
        (LOAD_BALANCE=on)
        (ADDRESS_LIST=(ADDRESS= (PROTOCOL=TCP) (HOST=10.62.185.22) (PORT=1521) ))
        (CONNECT_DATA=
      (SERVICE_NAME=tibsdev)
      (SERVER = DEDICATED))
    )';


$db['default']['username'] = 'marfee';
$db['default']['password'] = 'telkom123';
$db['default']['database'] = '';
$db['default']['dbdriver'] = 'oci8';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


// DB 2
$db['default2']['hostname'] ='(DESCRIPTION=
    (ADDRESS_LIST=
      (FAILOVER=on)
      (LOAD_BALANCE=yes)
      (ADDRESS=
        (PROTOCOL=TCP)
        (10.60.185.7)
        (PORT=1521)
      )
      (ADDRESS=
        (PROTOCOL=TCP)
        (HOST=10.60.185.7)
        (PORT=1521)
      )
    )
    (CONNECT_DATA=
      (SERVICE_NAME=colodb)
    )
  )';


$db['default2']['username'] = 'c2bi';
$db['default2']['password'] = 'telkom123';
$db['default2']['database'] = '';
$db['default2']['dbdriver'] = 'oci8';
$db['default2']['dbprefix'] = '';
$db['default2']['pconnect'] = TRUE;
$db['default2']['db_debug'] = FALSE;
$db['default2']['cache_on'] = FALSE;
$db['default2']['cachedir'] = '';
$db['default2']['char_set'] = 'utf8';
$db['default2']['dbcollat'] = 'utf8_general_ci';
$db['default2']['swap_pre'] = '';
$db['default2']['autoinit'] = TRUE;
$db['default2']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
