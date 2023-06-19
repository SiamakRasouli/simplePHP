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
    include __DIR__ .'/../../App/Views/loader.php';
}
function assets($assets) {
    echo '/Themes/' . $assets;
}
