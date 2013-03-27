<?php
class aListPlus extends aListPlus_parent {

    public function getTitleSuffix()
    {
 				$sSuffix = '';
        if ( ( $oCategory = $this->getActCategory() ) ) {
            $sSuffix = $oCategory->oxcategories__oxdesc->value;
        }
				
        if ( $this->getActManufacturer()->oxmanufacturers__oxshowsuffix->value ) {
            $sSuffix = $this->getConfig()->getActiveShop()->oxshops__oxtitlesuffix->value;
        }

			  if ($sSuffix == '') {
          $aArticleList = $this->getArticleList();
          if (count($aArticleList)) {
              foreach ( $aArticleList as $oArticle ) {
                  $sSuffix .= $oArticle->oxarticles__oxtitle->value . ' ';
              }
          }
        }
				
				if ( $this->getActCategory()->oxcategories__oxshowsuffix->value ) {
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
