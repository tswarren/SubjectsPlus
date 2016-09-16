<?php
/**
 * Created by PhpStorm.
 * User: acarrasco
 * Date: 8/23/2016
 * Time: 2:19 PM
 */
/**
 * Class BookList
 */

namespace SubjectsPlus\Control;
require_once("Pluslet.php");


class Pluslet_BookList extends Pluslet
{

    public function __construct($pluslet_id, $flag="", $subject_id, $isclone=0) {
        parent::__construct($pluslet_id, $flag, $subject_id, $isclone);

        $this->_type = "BookList";
        $this->_pluslet_id = $pluslet_id;
        $this->_subject_id = $subject_id;
        $this->_isclone = $isclone;
        $this->_pluslet_bonus_classes = "type-booklist";

    }

    protected function onEditOutput()
    {
        if($this->_extra == "")
        {
            $this->_extra = array();

        }else
        {
            $this->_extra = json_decode( $this->_extra, true );
        }

        $this->_bookListSettings = $this->getBookListSettings();
        $this->_body = $this->loadHtml(__DIR__ . '/views/BookListEditOutput.php');
    }

    protected function onViewOutput()
    {
        $this->_extra = json_decode( $this->_extra, true );
        $this->_body = $this->loadHtml(__DIR__ . '/views/BookListViewOutput.php');

    }

    static function getMenuName()
    {
        return _('Book List');
    }

    static function getMenuIcon()
    {
        $icon="<span class=\"icon-text \">" . _("Book List") . "</span>";
        return $icon;
    }

    private function getBookListSettings() {

        $data = $this->_extra;

        $checkBoxesSetttings = array(
            'openLibraryCover' => isset($data['openLibraryCover']) && !empty($data['openLibraryCover']) ? $data['openLibraryCover'][0] : "",
            'syndeticsCover' => isset($data['syndeticsCover']) && !empty($data['syndeticsCover']) ? $data['syndeticsCover'][0] : "",
            'googleBooksCover' => isset($data['googleBooksCover']) && !empty($data['googleBooksCover']) ? $data['googleBooksCover'][0] : "",
            'openLibraryMetadata' => isset($data['openLibraryMetadata']) && !empty($data['openLibraryMetadata']) ? $data['openLibraryMetadata'][0] : "",
            'googleBooksMetadata' => isset($data['googleBooksMetadata']) && !empty($data['googleBooksMetadata']) ? $data['googleBooksMetadata'][0] : ""
        );

        return $this->checkBoxes($checkBoxesSetttings);;

    }

    private function checkBoxes($checkBoxSettings){

        foreach ($checkBoxSettings as $key => $val) {
            if (strcmp($val, 'on') == 0){
                $checkBoxSettings[$key] = 'checked = "checked"';
            }
        }

        return $checkBoxSettings;
    }
}