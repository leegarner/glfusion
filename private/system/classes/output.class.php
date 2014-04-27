<?php
// +--------------------------------------------------------------------------+
// | glFusion CMS                                                             |
// +--------------------------------------------------------------------------+
// | ouptut.class.php                                                         |
// |                                                                          |
// | glFusion Browser Output Handler                                          |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2008-2014 by the following authors:                        |
// |                                                                          |
// | Mark R. Evans          mark AT glfusion DOT org                          |
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

// this file can't be used on its own
if (!defined ('GVERSION')) {
    die ('This file can not be used on its own!');
}

define('HEADER_PRIO_VERYHIGH',  1);
define('HEADER_PRIO_HIGH',      2);
define('HEADER_PRIO_NORMAL',    3);
define('HEADER_PRIO_LOW',       4);
define('HEADER_PRIO_VERYLOW',   5);

/**
 * outputHandler class
 *
 * @package 	glFusion.Framework
 * @subpackage	output
 * @since 		1.3.0
 */

class outputHandler {

    public  $pageTemplate;
    private $_buffer = '';
    private $_msg = '';
    private $_displayNavigationBlocks = true;
    private $_displayExtraBlocks = false;
    private $_pagetitle = '';
    private $_frontPage = false;
    private $_errorlog_fn = NULL;
    private $_what = '';
    private $_custom = array();
    private $_charset = 'utf-8';
    private $_topic = '';
    private $_headercode = '';
    private $_navigationBlocks = '';
    private $_extraBlocks = '';
    private $_curtime = '';
    private $_copyrightyear;
    private $_directHeader = array();
    private $_rewriteEnabled = false;
    private $_header = array(
                    'meta' => array('http-equiv' => array(), 'name' => array()),
                    'style' => array(HEADER_PRIO_VERYHIGH => array(),
                                     HEADER_PRIO_HIGH => array(),
                                     HEADER_PRIO_NORMAL => array(),
                                     HEADER_PRIO_LOW => array(),
                                     HEADER_PRIO_VERYLOW => array()),
                    'script' => array(HEADER_PRIO_VERYHIGH => array(),
                                     HEADER_PRIO_HIGH => array(),
                                     HEADER_PRIO_NORMAL => array(),
                                     HEADER_PRIO_LOW => array(),
                                     HEADER_PRIO_VERYLOW => array()),
                    'raw' => array(HEADER_PRIO_VERYHIGH => array(),
                                     HEADER_PRIO_HIGH => array(),
                                     HEADER_PRIO_NORMAL => array(),
                                     HEADER_PRIO_LOW => array(),
                                     HEADER_PRIO_VERYLOW => array()),
                    );


    /**************************************************************************/
    // Public Methods:

    /**
     * Constructor, initializes the output buffering.
     */

    public function __construct() {
        global $_CONF;

    	ob_start( );        // buffer any output
        $this->_charset             = COM_getCharset();
        $this->pageTemplate         = new Template ($_CONF['path_layout']);
        $this->_rewriteEnabled      = $_CONF['url_rewrite'];
        $this->_displayExtraBlocks  = $_CONF['show_right_blocks'];
    }

	/**
	 * Returns a reference to a global outputHandler object, only creating it
	 * if it doesn't already exist.
	 *
	 * This method must be invoked as:
	 * 		<pre>$outputHandle = outputHandler::getInstance();</pre>
	 *
	 * @static
	 * @return	object	The outputHandler object.
	 * @since	1.3.0
	 */
    public static function &getInstance()
    {
        static $instance;

        if (!$instance) {
            $instance = new outputHandler();
        }

        return $instance;
    }

	/**
	 * Add CSS to a page
	 *
	 * This adds raw CSS, it should not be wrapped in a <style> tag.
	 *
	 * @param  string   $code The CSS code
	 * @param  int      $priority Load priority
	 * @param  string   $mime The mime type of the CSS, 'text/css' used if no
	 *                  other type passed.
	 * @access public
	 * @return nothing
	 */
    public function addStyle($code, $priority = HEADER_PRIO_NORMAL, $mime = 'text/css')
    {
        if ( $code != '' ) {
            $this->_header['style'][$priority][] = '<style type="' . $mime . "\">" . LB . $code . LB . "</style>" . LB;
        }
    }

	/**
	 * Add JavaScript to a page
	 *
	 * This adds raw JavaScript, it should not be wrapped in a <script> tag.
	 *
	 * @param  string   $code       The JavaScript code
	 * @param  int      $priority   Load priority
	 * @param  string   $mime       The mime type of the JS, 'text/javascript'
	 *                              used if no other type passed.
	 * @access public
	 * @return nothing
	 */
    public function addScript($code, $priority = HEADER_PRIO_NORMAL, $mime = 'text/javascript')
    {
        if ($code != '') {
            $this->_header['script'][$priority][] = '<script type="' . $mime . "\">".LB."<!--" . LB . $code . LB ."// --></script>" . LB;
        }
    }


	/**
	 * Add a Link to a page
	 *
	 * This adds raw Link, it should not be wrapped in a <link> tag.
	 *
	 * @param  string   $rel        Link relationship
	 * @param  string   $href       The link href
	 * @param  string   $type       Type attribute (optional)
	 * @param  int      $priority   Load priority
	 * @param  array    $attr       Attributes array
     *
	 * @access public
	 * @return nothing
	 */
    public function addLink($rel, $href, $type = '', $priority = HEADER_PRIO_NORMAL, $attrs = array())
    {
        $link = '<link rel="' . $rel .'" href="' . @htmlspecialchars($href,ENT_QUOTES, COM_getEncodingt()) . '"';
        if (!empty($type)) {
            $link .= ' type="' . $type . '"';
        }
        if (is_array($attrs)) {
            foreach ($attrs as $k => $v) {
                $link .= ' ' . $k . '="' . $v . '"';
            }
        }
        $link .= "/>" . LB;

        $this->_header['raw'][$priority][] = $link;
    }


	/**
	 * Add a stylesheet to a page
	 *
	 * This adds a stylesheet to a page - The URL should not have the <link>
	 * attribute.
	 *
	 * @param  string   $href       The URL to the stylesheet
	 * @param  int      $priority   Load priority
	 * @param  string   $mime       The mime type of the stylesheet, 'text/css'
	 *                              used if no other type passed.
	 * @param  array    $attr       Attributes array
     *
	 * @access public
	 * @return nothing
	 */
    public function addLinkStyle($href, $priority = HEADER_PRIO_NORMAL, $mime = 'text/css', $attrs = array())
    {
        $link = '<link rel="stylesheet" type="' . $mime . '" href="' . @htmlspecialchars($href,ENT_QUOTES, COM_getEncodingt()) . '"';
        if (is_array($attrs)) {
            foreach ($attrs as $k => $v) {
                $link .= ' ' . $k . '="' . $v . '"';
            }
        }
        $link .= "/>" . LB;

        $this->_header['style'][$priority][] = $link;
    }


	/**
	 * Add a JavaScript source to a page
	 *
	 * This adds a javascript source file to a page - The URL should not have
	 * the <link> attribute.
	 *
	 * @param  string   $href       The URL to the javascript file
	 * @param  int      $priority   Load priority
	 * @param  string   $mime       The mime type of the stylesheet, 'text/css'
	 *                              used if no other type passed.
     *
	 * @access public
	 * @return nothing
	 */
    public function addLinkScript($href, $priority = HEADER_PRIO_NORMAL, $mime = 'text/javascript')
    {
        $link = '<script type="' . $mime . '" src="' . @htmlspecialchars($href,ENT_QUOTES, COM_getEncodingt()) . '"';
        $link .= "></script>" . LB;

        $this->_header['script'][$priority][] = $link;
    }

	/**
	 * Add Meta data to header
	 *
	 * This adds a meta record to the header
	 *
	 * @param  string   $tpe        Meta data type
	 * @param  string   $name       Name of the meta attribute
	 * @param  string   $content    Content of the attribute
     *
	 * @access public
	 * @return nothing
	 */

    public function addMeta($type, $name, $content)
    {
        $this->_header['meta'][] = $link = '<meta '.$type.'="' .  $name . '" content="' . $content . '"/>' . LB;
    }


	/**
	 * Add Meta data to header
	 *
	 * This adds a meta name to the header
	 *
	 * @param  string   $name       Name of the meta attribute
	 * @param  string   $cotent     Content of the attribute
     *
	 * @access public
	 * @return nothing
	 */
//REMOVE
    public function addMetaName($name, $content)
    {
        $this->_header['meta']['name'] = '<meta name="' .  $name . '" content="' . $content . '"/>' . LB;
    }


	/**
	 * Add Meta HTTP Equiv data to header
	 *
	 * This adds a meta name to the header
	 *
	 * @param  string   $header     header name
	 * @param  string   $cotent     Content of the attribute
     *
	 * @access public
	 * @return nothing
	 */
// REMOVE
    public function addMetaHttpEquiv($header, $content)
    {
        $this->_header['meta']['http-equiv'] = '<meta http-equiv="' . $header .'" content="' . $content . '" />' . LB;
    }


	/**
	 * Add a raw header
	 *
	 * Adds a raw header entry.  The code must be fully formed and include
	 * all necessary HTML.  No manipulations are done to the data.
	 *
	 * @param  string   $code       Fully formed code to add
	 * @param  int      $priority   Load priority
     *
	 * @access public
	 * @return nothing
	 */
    public function addRaw($code, $priority = HEADER_PRIO_NORMAL)
    {
        $this->_header['raw'][$priority][] = $code . LB;
    }


	/**
	 * Add a direct header
	 *
	 * Passes the $text variable directly to the PHP header() function.
	 * These items are always sent first.
	 *
	 * @param  string   $text       direct text to send to browser.
     *
	 * @access public
	 * @return nothing
	 */
    public function addDirectHeader($text) {
        $this->_directHeader[] = $text;
    }

    public function renderHeader($type)
    {
        if ( $type != 'script' && $type != 'style' && $type != 'raw' && $type != 'meta' ) {
            return '';
        }
        return $this->_array_concat_recursive($this->_header[$type]);
    }

    /* return path to js files */
    public function getScripts()
    {
        $js = array();

        foreach ($this->_header['script'] as $priority ) {
            if ( is_array($priority) ) {
                foreach ($priority as $path ) {
                    $js[] = $path;
                }
            }
        }
        return $js;
    }

    // PRIVATE METHODS

    /**
    * Concatenates an array - recursively
    *
    * @access   private
    * @param    array  $a     array
    *
    */

    private function _array_concat_recursive($a)
    {
        if (is_array($a)) {
            $cat = '';
            foreach ($a as $aa) {
                if (is_array($aa)) {
                    $cat .= $this->_array_concat_recursive($aa);
                } elseif (!is_null($aa)) {
                    $cat .= $aa;
                }
            }
            return $cat;
        } else {
            return false;
        }
    }
}
?>