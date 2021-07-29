<?php
class Ads extends Models {

    public function getAds() {
        $nAds = 0;
        $sSql = 'SELECT count(id) AS nAds FROM ads';
        $oSql = $this->oDb->query($sSql);
        if ($oSql->rowCount() > 0) {
            $aRs = $oSql->fetch();
            $nAds = $aRs['nAds'];
        }
        return $nAds;
    }

}