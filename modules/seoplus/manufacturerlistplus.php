<?php

class ManufacturerListPlus extends ManufacturerListPlus_parent
{

    public function getTitleSuffix()
    {
        $sSuffix = '';

        if ($oManufacturer = $this->getActManufacturer()) {
            $sSuffix .= $oManufacturer->oxmanufacturers__oxshortdesc->value . ' ';
        }

        if ($this->getActManufacturer()->oxmanufacturers__oxshowsuffix->value) {
            $sSuffix .= $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }

        if ($sSuffix == '') {
            $sSuffix = null;
        } else {
            $sSuffix = trim(substr($sSuffix, 0, 200));
        }

        return $sSuffix;
    }

}
