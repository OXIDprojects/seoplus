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

        $oxtitleSuffix = '';
        if ($this->getActCategory()->oxcategories__oxshowsuffix->value) {
            $oxtitleSuffix = ' ' . $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }
        
        $sSuffix = $this->truncateRespectWords($sSuffix, 200 - strlen($oxtitleSuffix)) . $oxtitleSuffix;

        if ($sSuffix == '') {
            $sSuffix = null;
        }

        return $sSuffix;
    }
    
    private function truncateRespectWords($text, $length) {
        if(strlen($text) > $length) {
           $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1', $text);
        }
        return($text);
    }
}
