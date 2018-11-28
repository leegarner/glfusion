<?php
/**
* glFusion CMS
*
* UTF-8 Spam-X Language File
*
* @license GNU General Public License version 2 or later
*     http://www.opensource.org/licenses/gpl-license.php
*
*  Copyright (C) 2008-2018 by the following authors:
*   Mark R. Evans   mark AT glfusion DOT org
*
*  Based on prior work Copyright (C) 2004-2008 by the following authors:
*  Tom Willett          tomw AT pigstye DOT net
*
*/

if (!defined ('GVERSION')) {
    die ('This file can not be used on its own.');
}

global $LANG32;

$LANG_SX00 = array (
	'comdel'	    => ' comments deleted.',
	'deletespam'    => 'Delete Spam',
	'masshead'	    => '<hr><h1 align="center">Mass Delete Spam Comments</h1>',
	'masstb'        => '<hr><h1 align="center">Mass Delete Trackback Spam</h1>',
	'note1'		    => '<p>Note: Mass Delete is intended to help you when you are hit by',
	'note2'		    => ' comment spam and Spam-X does not catch it.</p><ul><li>First find the link(s) or other ',
	'note3'		    => 'identifiers of this spam comment and add it to your personal blacklist.</li><li>Then ',
	'note4'		    => 'come back here and have Spam-X check the latest comments for spam.</li></ul><p>Comments ',
	'note5'		    => 'are checked from newest comment to oldest -- checking more comments ',
	'note6'		    => 'requires more time for the check.</p>',
	'numtocheck'    => 'Number of Comments to check',
    'RDF'           => 'RDF url: ',
    'URL'           => 'URL to Spam-X List: ',
    'access_denied' => 'P&auml;&auml;sy kielletty',
    'access_denied_msg' => 'Only Root Users have Access to this Page.  Your user name and IP have been recorded.',
    'acmod'         => 'Spam-X Action Modules',
    'actmod'        => 'Active Modules',
    'add1'          => 'Lisätty ',
    'add2'          => ' entries from ',
    'add3'          => "'s blacklist.",
    'addcen'        => 'Add Censor List',
    'addentry'      => 'Add Entry',
    'admin'         => 'Lista laajennuksista',
    'adminc'        => 'Administration Commands:',
    'all'           => 'Kaikki',
    'allow_url_fopen' => '<p>Sorry, your webserver configuration does not allow reading of remote files (<code>allow_url_fopen</code> is off). Please download the blacklist from the following URL and upload it into glFusion\'s "data" directory, <tt>%s</tt>, before trying again:',
    'auto_refresh_off' => 'Auto Refresh Off',
    'auto_refresh_on' => 'Auto Refresh On',
    'availb'        => 'Available Blacklists',
    'avmod'         => 'Available Modules',
    'blacklist'     => 'Musta Lista',
    'blacklist_prompt' => 'Enter words to trigger spam',
    'blacklist_success_delete' => 'Selected items successfully deleted',
    'blacklist_success_save' => 'Spam-X Filter Saved Successfully',
    'blocked'       => 'Blokattu',
    'cancel'        => 'Peruuta',
    'cancel'        => 'Peruuta',
    'clearlog'      => 'Tyhjenn&auml; Logi Tiedosto',
    'clicki'        => 'Click to Import Blacklist',
    'clickv'        => 'Click to View Blacklist',
    'comment'       => 'Kommentti',
    'coninst'       => '<hr>Click on an Active module to remove it, click on an Available module to add it.<br>Modules are executed in order presented.',
    'conmod'        => 'Configure Spam-X Module Usage',
    'content'       => 'Sis&auml;lt&ouml;',
    'content_type'  => 'Content Type',
    'delete'        => 'Poista',
    'delete_confirm' => 'Haluatko varmasti poistaa t&auml;m&auml;n?',
    'delete_confirm_2' => 'Are you REALLY SURE you want to delete this item',
    'documentation' => 'Spam-X Plugin Documentation',
    'e1'            => 'To Delete an entry click it.',
    'e2'            => 'To Add an entry, enter it in the box and click Add.  Entries can use full Perl Regular Expressions.',
    'e3'            => 'To Add the words from glFusions CensorList Press the Button:',
    'edit_filter_entry' => 'Edit Filter',
    'edit_filters'  => 'Edit Filters',
    'email'         => 'Sähköposti',
    'emailmsg'      => "A new spam post has been submitted at \"%s\"\nUser UID: \"%s\"\n\nContent:\"%s\"",
    'emailsubject'  => 'Spam post at %s',
    'enabled'       => 'Ota pois käytöstä ennenkuin poistat asennuksen.',
    'entries'       => ' entries.',
    'entriesadded'  => 'Entries Added',
    'entriesdeleted'=> 'Entries Deleted',
    'exmod'         => 'Spam-X Examine Modules',
    'filter'        => 'Filter',
    'filter_instruction' => 'Here you can define filters which will be applied to each registration and post on the site. If any of the checks return true, the registration / post will be blocked as spam',
    'filters'       => 'Filters',
    'forum_post'    => 'Forum Post',
    'foundspam'     => 'Found Spam Post matching ',
    'foundspam2'    => ' posted by user ',
    'foundspam3'    => ' from IP ',
    'fsc'           => 'Found Spam Post matching ',
    'fsc1'          => ' posted by user ',
    'fsc2'          => ' from IP ',
    'headerblack'   => 'Spam-X HTTP Header Blacklist',
    'headers'       => 'Request headers:',
    'history'       => 'Past 3 Months',
    'http_header'   => 'HTTP Header',
    'http_header_prompt' => 'Header',
    'impinst1a'     => 'Before you use the Spam-X comment Spam blocker facility to view and import personal Blacklists from other',
    'impinst1b'     => ' sites, I ask that you press the following two buttons. (You have to press the last one.)',
    'impinst2'      => 'This first submits your website to the Gplugs/Spam-X site so that it can be added to the master list of ',
    'impinst2a'     => 'sites sharing their blacklists. (Note: if you have multiple sites you might want to designate one as the ',
    'impinst2b'     => 'master and only submit its name. This will allow you to update your sites easily and keep the list smaller.) ',
    'impinst2c'     => 'After you press the Submit button, press [back] on your browser to return here.',
    'impinst3'      => 'The Following values will be sent: (you can edit them if they are wrong).',
    'import_failure'=> '<p><strong>Error:</strong> No entries found.',
    'import_success'=> '<p>Successfully imported %d blacklist entries.',
    'initial_Pimport'=> '<p>Personal Blacklist Import"',
    'initial_import' => 'Initial MT-Blacklist Import',
    'inst1'         => '<p>If you do this, then others ',
    'inst2'         => 'will be able to view and import your personal blacklist and we can create a more effective ',
    'inst3'         => 'distributed database.</p><p>If you have submitted your website and decide you do not wish your website to remain on the list ',
    'inst4'         => 'send an email to <a href="mailto:spamx@pigstye.net">spamx@pigstye.net</a> telling me. ',
    'inst5'         => 'All requests will be honored.',
    'install'       => 'Asenna',
    'install_failed' => 'Asennus epäonnistui -- Katso error logi.',
    'install_header' => 'Install/Uninstall Plugin',
    'install_success' => 'Installation Successful',
    'installdoc'    => 'Install Document.',
    'installed'     => 'The Plugin is Installed',
    'instructions'  => 'Spam-X allows you to define words, URLs, and other items that can be used to block spam posts on your site.',
    'interactive_tester' => 'Interactive Tester',
    'invalid_email_or_ip'   => 'Invalid e-mail address or IP address has been blocked',
    'invalid_item_id' => 'Invalid ID',
    'ip_address'    => 'IP Address',
    'ip_blacklist'  => 'IP Blacklist',
    'ip_error'  => 'The entry does not appear to be a valid IP or IP range',
    'ip_prompt' => 'Enter IP to block',
    'ipblack' => 'Spam-X IP Blacklist',
    'ipofurl'   => 'IP of URL',
    'ipofurl_prompt' => 'Enter IP of links to block',
    'ipofurlblack' => 'Spam-X IP of URL Blacklist',
    'logcleared' => '- Spam-X Log File Cleared',
    'mblack' => 'My Blacklist:',
    'new_entry' => 'New Entry',
    'new_filter_entry' => 'New Filter Entry',
    'no_bl_data_error' => 'No errors',
    'no_blocked' => 'No spam has been blocked by this module',
    'no_filter_data' => 'No filters have been defined',
    'ok' => 'OK',
    'pblack' => 'Spam-X Personal Blacklist',
    'plugin' => 'Plugin',
    'plugin_name' => 'Spam-X',
    'readme' => 'STOP! Before you press install please read the ',
    'referrer'      => 'Referrer',
    'response'      => 'Vastaus',
    'rlinks' => 'Related Links:',
    'rsscreated' => 'RSS Feed Created',
    'scan_comments' => 'Scan Comments',
    'scan_trackbacks' => 'Scan Trackbacks',
    'secbut' => 'This second button creates an rdf feed so that others can import your list.',
    'sitename' => 'Sivuston nimi: ',
    'slvwhitelist' => 'SLV Whitelist',
    'spamdeleted' => 'Deleted Spam Post',
    'spamx_filters' => 'Spam-X Filters',
    'stats_deleted' => 'Viesti Poistettu Roskapostina',
    'stats_entries' => 'Kirjauksia',
    'stats_header' => 'HTTP headers',
    'stats_headline' => 'Spam-X Tilastot',
    'stats_ip' => 'Blokatut IP:t',
    'stats_ipofurl' => 'Blokattu IP:n tai URL:n mukaan',
    'stats_mtblacklist' => 'MT-Musta Lista',
    'stats_page_title' => 'Musta Lista',
    'stats_pblacklist' => 'henkilökohtainen Musta Lista',
    'submit'        => 'L&auml;het&auml;',
    'submit' => 'L&auml;het&auml;',
    'subthis' => 'this info to Spam-X Central Database',
    'type'  => 'Type',
    'uMTlist' => 'Update MT-Blacklist',
    'uMTlist2' => ': Added ',
    'uMTlist3' => ' entries and deleted ',
    'uPlist' => 'Update Personal Blacklist',
    'uninstall' => 'Poista asennus',
    'uninstall_msg' => 'Lisäosa asennus poistettu',
    'uninstalled' => 'The Plugin is Not Installed',
    'user_agent'    => 'User Agent',
    'username'  => 'K&auml;ytt&auml;j&auml; tunnus',
    'value' => 'Value',
    'viewlog' => 'View Spam-X Log',
    'warning' => 'Varoitus! Lisäosa on edelleen käytössä',
);


/* Define Messages that are shown when Spam-X module action is taken */
$PLG_spamx_MESSAGE128 = 'Roskaposti havaittu. Viesti poistettiin.';
$PLG_spamx_MESSAGE8   = 'Roskaposti havaittu. S&auml;hk&ouml;posti l&auml;hetetty Adminille.';

// Messages for the plugin upgrade
$PLG_spamx_MESSAGE3001 = 'Plugin päivitys ei tueta.';
$PLG_spamx_MESSAGE3002 = $LANG32[9];


// Localization of the Admin Configuration UI
$LANG_configsections['spamx'] = array(
    'label' => 'Spam-X',
    'title' => 'Spam-X Asetukset'
);

$LANG_confignames['spamx'] = array(
    'action' => 'Spam-X Toimenpiteet',
    'notification_email' => 'Sähköposti Ilmoitus',
    'admin_override' => "",
    'logging' => 'Kirjautuminen Käytössä',
    'timeout' => 'Aikakatkaisu',
    'sfs_username_check' => 'Enable User name validation',
    'sfs_email_check' => 'Enable email validation',
    'sfs_ip_check' => 'Enable IP address validation',
    'sfs_username_confidence' => 'Minimum confidence level on Username match to trigger spam block',
    'sfs_email_confidence' => 'Minimum confidence level on Email match to trigger spam block',
    'sfs_ip_confidence' => 'Minimum confidence level on IP address match to trigger spam block',
    'slc_max_links' => 'Maximum Links allowed in post',
    'debug' => 'Debug Logging',
    'akismet_enabled' => 'Akismet Module Enabled',
    'akismet_api_key' => 'Akismet API Key (Required)',
    'fc_enable' => 'Enable Form Check',
    'sfs_enable' => 'Enable Stop Forum Spam',
    'slc_enable' => 'Enable Spam Link Counter',
    'action_delete' => 'Delete Identified Spam',
    'action_mail' => 'Mail Admin when Spam Caught',
);

$LANG_configsubgroups['spamx'] = array(
    'sg_main' => 'Pää Asetukset'
);

$LANG_fs['spamx'] = array(
    'fs_main' => 'Spam-X Pää Asetukset',
    'fs_sfs'  => 'Stop Forum Spam',
    'fs_slc'  => 'Spam Link Counter',
    'fs_akismet' => 'Akismet',
    'fs_formcheck' => 'Form Check',
);

$LANG_configSelect['spamx'] = array(
    0 => array(1 => 'True', 0 => 'False'),
    1 => array(TRUE => 'True', FALSE => 'False')
);
?>
