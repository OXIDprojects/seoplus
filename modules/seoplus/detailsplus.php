<?php

class DetailsPlus extends DetailsPlus_parent
{

    /**
     * will be added to title and description
     * @var bool
     */
    protected $_sCatTitle = false;

    protected function GetCatTitle()
    {
        if ($this->_sCatTitle === false) {
            $sCatTitle = '';
            $oCatTree  = $this->getCatTreePath();
            if ($oCatTree) {
                foreach ($oCatTree as $oCat) {
                    $sCatTitle = $oCat->oxcategories__oxtitle->value;
                }
            }
            $this->_sCatTitle = $sCatTitle;
        }

        return $this->_sCatTitle;
    }

    public function getTitle()
    {
        if ($oProduct = $this->getProduct()) {
            return $oProduct->oxarticles__oxtitle->value . ' in ' . $this->GetCatTitle() . ($oProduct->oxarticles__oxvarselect->value ? ' ' . $oProduct->oxarticles__oxvarselect->value : '');
        }
    }

    protected function _prepareMetaDescription($sMeta, $iLength = 200, $blDescTag = false)
    {
        if (!$sMeta) {
            $oProduct = $this->getProduct();
            $sMeta    = $oProduct->getLongDescription()->value;
            $sMeta    = str_replace(array('<br>', '<br />', '<br/>'), "\n", $sMeta);

            $sMeta = $oProduct->oxarticles__oxtitle->value . ' in ' . $this->GetCatTitle() . ' - ' . $sMeta;
            $sMeta = strip_tags($sMeta);
        }

        return parent::_prepareMetaDescription($sMeta, $iLength, $blDescTag);
    }

    public function getMetaDescription()
    {
        // set special meta description ?
        if ($sDescription = $this->_getMetaFromSeo('oxdescription')) {
            $sDescription = $this->GetCatTitle() . ': ' . $sDescription;

            return $sDescription;
        } elseif (($sDescription = $this->_getMetaFromContent($this->_sMetaDescriptionIdent))) {
            return $this->_prepareMetaDescription($sDescription);
        } else {
            return $this->_prepareMetaDescription(false);
        }

        return '-';
    }

}
