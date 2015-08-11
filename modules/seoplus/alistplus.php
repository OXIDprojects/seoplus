<?php

class aListPlus extends aListPlus_parent
{

    public function getTitleSuffix()
    {
        $sSuffix = '';
        if (($oCategory = $this->getActCategory())) {
            $sSuffix = $oCategory->oxcategories__oxdesc->value;
        }

        if ($this->getActManufacturer()->oxmanufacturers__oxshowsuffix->value) {
            $sSuffix = $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }

        if ($sSuffix == '') {
            $aArticleList = $this->getArticleList();
            if (count($aArticleList)) {
                $buffer = array();
                foreach ($aArticleList as $oArticle) {
                    $buffer[] = $oArticle->oxarticles__oxtitle->value;
                }
                $sSuffix = implode(' ', $buffer);
            }
        }

        if ($this->getActCategory()->oxcategories__oxshowsuffix->value) {
            $sSuffix .= ' ' . $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }

        if ($sSuffix == '') {
            $sSuffix = null;
        } else {
            $sSuffix = substr($sSuffix, 0, 200);
        }

        return $sSuffix;
    }
}