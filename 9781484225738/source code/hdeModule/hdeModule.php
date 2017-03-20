<?php
/*
*  @author Arnaldo Perez Castano <arnaldo.skywalker@gmail.com>
*  @2016 HDE
*  Property of Havana Digital Enterprises
*/

if (!defined('_PS_VERSION_'))
	exit;

class HdeModule extends Module
{
	const INSTALL_SQL_FILE = 'install.sql';
	public function __construct()
	{
		$this->name = 'hdeModule';
		$this->tab = 'Products';
		$this->version = 1.0;
		$this->author = 'Arnaldo Perez';
		$this->need_instance = 0;
		parent::__construct();
		$this->displayName = $this->l( 'Havana Digital Enterprises Module' );
		$this->description = $this->l( 'Reservation, booking system for HDE.' );
	}

	public function install()
	{
		if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
            return false;
        else if (!$sql = Tools::file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
            return false;

        $sql = str_replace(array('PREFIX_',  'DBNAME_'), array(_DB_PREFIX_, _DB_NAME_), $sql);
        $sql = preg_split("/;\s*[\r\n]+/", $sql);

        foreach ($sql as $query) {
            if ($query) {
                if (!Db::getInstance()->execute(trim($query)))
                    return false;
            }
        }

		if (!parent::install())
            return false;
		return true;
	}

	public function uninstall()
	{
		if ( !parent::uninstall() )
			Db::getInstance()->Execute( 'DELETE FROM `' . _DB_PREFIX_ . 'hdeModule`' );
		parent::uninstall();
	}
}


