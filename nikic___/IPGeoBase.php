<?php


namespace App\Models;


class IPGeoBase
{
    private $fhandleCIDR, $fhandleCities, $fSizeCIDR, $fsizeCities, $outputEncoding;

    const DEFAULT_FILE_ENCODING = 'windows-1251';
    const DEFAULT_OUTPUT_ENCODING = 'UTF-8';

    public function __construct($CIDRFile = null, $CitiesFile = null, $outputEncoding = self::DEFAULT_OUTPUT_ENCODING)
    {
        $CIDRFile = $CIDRFile ?: dirname(__FILE__) . '/cidr_optim.txt';
        $CitiesFile = $CitiesFile ?: dirname(__FILE__) . '/cities.txt';

        $this->outputEncoding = $outputEncoding;

        if (!file_exists($CIDRFile) ||
            !($this->fhandleCIDR = fopen($CIDRFile, 'r'))) {
            throw new \RuntimeException("Cannot access CIDR file: $CIDRFile");
        }
        if (!file_exists($CitiesFile) ||
            !($this->fhandleCities = fopen($CitiesFile, 'r'))) {
            throw new \RuntimeException("Cannot access cities file: $CitiesFile");
        }

        $this->fSizeCIDR = filesize($CIDRFile);
        $this->fsizeCities = filesize($CitiesFile);
    }

    public function getRecord($ip) {

    }

}
