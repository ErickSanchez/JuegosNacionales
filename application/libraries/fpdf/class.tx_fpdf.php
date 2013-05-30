<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2005 David Bruehlmeier (typo3@bruehlmeier.com)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
* ------- Description -------
* Extension of the FPDI class. The method Header() is implemented to
* allow the inclusion of template files. The template file to be used
* can be set by the class variable $this->tx_fpdf->template
* (full path required).
*
* You can include this class in your scripts to get the full
* functionality of FPDF and FPDI, including support for custom
* fonts and custom template files.
*
* @author David Bruehlmeier <typo3@bruehlmeier.com>
*/

require(t3lib_extMgm::extPath('fpdf').'fpdi.php');
define ('FPDF_FONTPATH', t3lib_extMgm::extPath('fpdf').'font/');


class PDF extends FPDI		{
	function Header()		{
			
		if ($this->tx_fpdf->template)		{
			$this->setSourceFile($this->tx_fpdf->template);
			$tplidx = $this->ImportPage(1);
			$this->useTemplate($tplidx);
		}
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/fpdf/class.tx_fpdf.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/fpdf/class.tx_fpdf.php']);
}

?>