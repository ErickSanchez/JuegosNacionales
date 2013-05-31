<?php

########################################################################
# Extension Manager/Repository config file for ext: "fpdf"
#
# Auto generated 22-06-2007 13:53
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'FPDF Library',
	'description' => 'FPDF Library (www.fpdf.org) ported to TYPO3. Also includes the FPDI library (fpdi.setasign.de) which allows you to use PDF templates when creating your own PDF files.',
	'category' => 'misc',
	'shy' => 0,
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => 0,
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'David Bruehlmeier',
	'author_email' => 'typo3@bruehlmeier.com',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'version' => '0.1.2',
	'_md5_values_when_last_written' => 'a:55:{s:7:"FAQ.htm";s:4:"a1a3";s:7:"LICENSE";s:4:"3b83";s:6:"NOTICE";s:4:"4202";s:13:"changelog.txt";s:4:"91c4";s:17:"class.tx_fpdf.php";s:4:"8b5a";s:8:"demo.php";s:4:"de34";s:12:"ext_icon.gif";s:4:"5c5f";s:8:"fpdf.css";s:4:"490a";s:8:"fpdf.php";s:4:"7967";s:12:"fpdf_tpl.php";s:4:"8c03";s:8:"fpdi.php";s:4:"509c";s:19:"fpdi_pdf_parser.php";s:4:"1a6a";s:9:"histo.htm";s:4:"e0e3";s:15:"pdf_context.php";s:4:"bc27";s:14:"pdf_parser.php";s:4:"794e";s:21:"wrapper_functions.php";s:4:"e755";s:26:"decoders/ASCII85Decode.php";s:4:"b0dc";s:22:"decoders/LZWDecode.php";s:4:"745f";s:20:"decoders/ascii85.php";s:4:"d0d6";s:16:"decoders/lzw.php";s:4:"40ab";s:14:"doc/manual.sxw";s:4:"6bcd";s:16:"font/courier.php";s:4:"fc24";s:18:"font/helvetica.php";s:4:"18a8";s:19:"font/helveticab.php";s:4:"5363";s:20:"font/helveticabi.php";s:4:"8eba";s:19:"font/helveticai.php";s:4:"54e8";s:15:"font/symbol.php";s:4:"56b0";s:14:"font/times.php";s:4:"bbf9";s:15:"font/timesb.php";s:4:"6704";s:16:"font/timesbi.php";s:4:"7295";s:15:"font/timesi.php";s:4:"4ff5";s:21:"font/zapfdingbats.php";s:4:"0529";s:24:"font/makefont/cp1250.map";s:4:"8a02";s:24:"font/makefont/cp1251.map";s:4:"ee2f";s:24:"font/makefont/cp1252.map";s:4:"8d73";s:24:"font/makefont/cp1253.map";s:4:"9073";s:24:"font/makefont/cp1254.map";s:4:"46e4";s:24:"font/makefont/cp1255.map";s:4:"c469";s:24:"font/makefont/cp1257.map";s:4:"fe87";s:24:"font/makefont/cp1258.map";s:4:"86a4";s:23:"font/makefont/cp874.map";s:4:"4fba";s:28:"font/makefont/iso-8859-1.map";s:4:"53bf";s:29:"font/makefont/iso-8859-11.map";s:4:"83ec";s:29:"font/makefont/iso-8859-15.map";s:4:"3d09";s:29:"font/makefont/iso-8859-16.map";s:4:"b56b";s:28:"font/makefont/iso-8859-2.map";s:4:"4750";s:28:"font/makefont/iso-8859-4.map";s:4:"0355";s:28:"font/makefont/iso-8859-5.map";s:4:"82a2";s:28:"font/makefont/iso-8859-7.map";s:4:"d071";s:28:"font/makefont/iso-8859-9.map";s:4:"8647";s:24:"font/makefont/koi8-r.map";s:4:"04f5";s:24:"font/makefont/koi8-u.map";s:4:"9046";s:26:"font/makefont/makefont.php";s:4:"eff3";s:15:"tests/TYPO3.pdf";s:4:"f98e";s:32:"tests/class.tx_fpdf_testcase.php";s:4:"1653";}',
	'constraints' => array(
		'depends' => array(
			'php' => '4.2.0-0.0.0',
			'typo3' => '3.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
);

?>