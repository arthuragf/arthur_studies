<?php
namespace Core;

class Core {

    public function run() {
        $sUrl = filter_input(INPUT_GET, 'url') ?? '';
        
        $sUrl = $this->checkRoutes($sUrl);
       
        $sCurrentController = 'HomeController';
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
            
        }
        
        $sPrefix = '\Controllers\\';
        $sCurrentController = ucfirst($sCurrentController);
        
        if (!file_exists('Controllers/' . $sCurrentController . '.class.php') 
            || !method_exists($sPrefix . $sCurrentController,$sCurrentAction)) {
                $sCurrentController = 'PageNotFoundController';
                $sCurrentAction = 'index';
        }
    
        $sCurrentController = $sPrefix . $sCurrentController;
        
        $oController = new $sCurrentController();
        call_user_func_array([$oController, $sCurrentAction], $aParams);
    }
    
    public function checkRoutes($sUrl) {
        global $aRoutes;
        
        foreach ($aRoutes as $sRoute => $sNewUrl) {

            $aMatches = [];
            $sPattern = preg_replace('/\{.*\}/', '([0-9]{1,})', $sRoute);

            if (preg_match('#^('.$sPattern.')*$#i', $sUrl, $aMatches)) {
                $aMatches = array_slice($aMatches, 2);
                
                if (!empty($aMatches)) {

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
        }
        return $sUrl;
    }
}