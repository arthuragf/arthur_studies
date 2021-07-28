<?php
class Core {

    public function run() {
        $sUrl = filter_input(INPUT_GET, 'url') ?? '';
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

        $oController = new $sCurrentController();
        call_user_func_array([$oController, $sCurrentAction], $aParams);
    }
    

}
