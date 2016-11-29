<?php

App::uses('AppController', 'Controller');

class LangResourcesController extends AppController {
    public $components = array('Session');
    var $helpers = array("Lang");
    
    public function admin_index() {
        ini_set('memory_limit', '256M');
        set_time_limit(0);
        
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is('post')) {
            if(isset($this->request->data['submit'])) {
                $from = '"';
                $to = '"';
                $frpath = WWW_ROOT . "lang/sp.php";
                $enpath = WWW_ROOT . "lang/en.php";
                $enlines = file($enpath); //file in to an array
                $noofitem = count($enlines);
                $frlines[0] = '<?php' . "\n";
                $arlines[0] = '<?php' . "\n";
                $newenlines[0] = '<?php' . "\n";

                for ($no = 1; $no < $noofitem; $no++) {
                    if (strpos($enlines[$no], '//') !== false) {
                        $frlines[$no] = $enlines[$no];
                        $arlines[$no] = $enlines[$no];
                        $newenlines[$no] = $enlines[$no];
                    } elseif (strpos($enlines[$no], '?>') !== false) {
                        $frlines[$no] = $enlines[$no];
                        $arlines[$no] = $enlines[$no];
                        $newenlines[$no] = $enlines[$no];
                    } else {
                        $define = $this->getDefineBetween($enlines[$no], $from, $to);
                        $frlines[$no] = 'define("' . $define . '","' . stripslashes($_POST['fr_' . $no]) . '");' . "\n";
                        //$arlines[$no] = 'define("' . $define . '","' . stripslashes($_POST['ar_' . $no]) . '");' . "\n";
                        $newenlines[$no] = 'define("' . $define . '","' . stripslashes($_POST['en_' . $no]) . '");' . "\n";
                    }
                }
                file_put_contents($frpath, $frlines);
                //file_put_contents($arpath, $arlines);
                file_put_contents($enpath, $newenlines);
                $this->Session->setFlash(__('The translation saved.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function getDefineBetween($str, $from, $to) {
        $this->layout = false;
        $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
        $del = substr($sub, 0, strpos($sub, $to));
        return $del;
    }
}
