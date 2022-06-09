<?php
function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'assets/images/' . $folder . '/' . $filename;
    return $path;



}
