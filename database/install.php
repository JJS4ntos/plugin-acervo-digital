<?php
/**
 * Install and update database structure.
 */

global $wpdb;

$charset = $wpdb->get_charset_collate();
$prefix = "{$wpdb->prefix}sd_";

/**
 * Structure of tables that will be created.
 */
$tables = array(
    'leads' => "CREATE TABLE {$prefix}leads (
                    id mediumint(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    name varchar(100) NOT NULL,
                    email varchar(100) NOT NULL
                ) $charset_collate;",
    'leads_data' => "CREATE TABLE {$prefix}leads_data (
                        id mediumint(9) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        lead_id mediumint(9) NOT NULL,
                        name varchar(100) NOT NULL,
                        value varchar(100) NOT NULL,
                        FOREIGN KEY (lead_id) REFERENCES {$prefix}leads(id)
                    ) $charset_collate;"
);

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

foreach( $tables as $table ) {
    dbDelta( $table );
}