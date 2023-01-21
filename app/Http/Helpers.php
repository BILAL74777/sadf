<?php
 

function get_storage_url($path){  
    // dd(env('FILESYSTEM_DRIVER'));
    return Storage::url($path);

}
 
