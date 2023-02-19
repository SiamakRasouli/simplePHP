<?php

function view($view, $data = '') {
    if(!empty($data)) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        } else {
            dd('The Views only accepts Arrays!');
        }
    }
    include base_path('\App\Views\\' . $view . '.php');
}