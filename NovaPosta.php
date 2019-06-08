<?php
class NovaPosta
{
    
    // public $html;
    public $address;
    public $status;

    public function get_address($cargo_number) {
        $url = "https://novaposhta.ua/tracking/?cargo_number=$cargo_number&newtracking=1";

        $html = file_get_html($url); // get html

        $element = $html->find('a[class=address]', 0); // find element
        if (gettype($element) == 'object') $this->address = $element->innertext;
        else $this->address = 'Адреса невідома';

        $element = $html->find('div[class=status]', 0);
        if (gettype($element) == 'object') $this->status = $element->innertext;
        else $this->status = 'Статус невідомий';

        return $this->address;
    }

}