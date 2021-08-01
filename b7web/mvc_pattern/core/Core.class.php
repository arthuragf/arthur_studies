<?php
class Core {

    public function run() {
        $sUrl = filter_input(INPUT_GET, 'url') ?? '';

        $sUrl = $this->checkRoutes($sUrl);

        $sCurrentController = 'homeController';
        $sCurrentAction = 'index';
        $aParams = [];
        
        if(!empty($sUrl)){
            $aParams = explode('/', $sUrl);
            $sCurrentController = $aParams[0] . 'Controller';
            array_shift($aParams);

            if (!empty($aParams[0])) {
                $sCurrentAction = $aParams[0];
                array_shift($aParams);
            }

            $aParams = array_filter($aParams);
            
        }

        if (!file_exists('controllers/' . $sCurrentController . '.class.php') 
            || !method_exists($sCurrentController,$sCurrentAction)) {
                $sCurrentController = 'pageNotFoundController';
                $sCurrentAction = 'index';
        }

        $oController = new $sCurrentController();
        call_user_func_array([$oController, $sCurrentAction], $aParams);
    }
    
    public function checkRoutes($sUrl) {
        global $aRoutes;

        foreach ($aRoutes as $sRoute => $sNewUrl) {
            $aMatches = [];
            $sPattern = preg_replace('/\{.*\}/', '(.*)', $sRoute);
            if (preg_match('#^('.$sPattern.')*$#i', $sUrl, $aMatches)) {
                $aMatches = array_slice($aMatches, 2);

                $aMatchVars = [];
                
                if(preg_match_all('/(?<=\{).*?(?=\})/', $sRoute, $aMatchVars)) {
                    $aMatchVars = $aMatchVars[0];
                }
                $aVars = [];
                foreach($aMatches as $key => $val) {
                    $aVars[$aMatchVars[$key]] = $val;
                }

                foreach($aVars as $sVar => $urlVal) {
                    $sNewUrl = str_replace(':' . $sVar, $urlVal, $sNewUrl);
                }
                $sUrl = $sNewUrl;
                break;
            }
        }
        return $sUrl;
    }
}