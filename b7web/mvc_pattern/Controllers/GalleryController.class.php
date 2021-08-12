<?php
namespace Controllers;

use \Core\Controller;

class GalleryController extends Controller {
    
    public function index() {
        $aData = [
            'nPhotos' => 10
        ];

        $this->loadTemplate('gallery', $aData);
    }

    public function open($nId = 0) {
        $aData = [
            'nId' => $nId
        ];

        $this->loadTemplate('galleryPhoto', $aData);
    }

}