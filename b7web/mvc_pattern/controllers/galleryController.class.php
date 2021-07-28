<?php
class galleryController extends Controller {
    
    public function index() {
        $aData = [
            'nPhotos' => 10
        ];

        $this->loadTemplate('gallery', $aData);
    }

}