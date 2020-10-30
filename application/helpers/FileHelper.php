<?php
/**
 *	PHP version 5
 * 
 *	@category   Helper
 *	@author	Nuttawat Pattanatragool <nuttawatp@bangkokpost.co.th>
 *	@author Watcharaphon Piamphuetna <watcharaphonp@bangkokpost.co.th>
 *	@copyright copyright (c) 1996 - 2020 Bangkok Post Public Company Limited.
 */

namespace helpers;

Class FileHelper
{
    public static function writeFile($vFilename,$vContents) 
    {
		$fp = fopen($vFilename,"w");
		fputs($fp, $vContents, strlen($vContents));
		fclose($fp);
	}
	
    public static function openFile($vFilename) 
    {
		$fp = @fopen($vFilename,"r");
		if ($fp == FALSE) { return false; }
		$buffer = "";
		while (!feof($fp)) {
			$buffer = fread($fp,1024*1024);
		}
		fclose($fp);
		return $buffer;
	}
}

    
    
    