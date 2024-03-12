<?php

function imgUpload($image, $folder, $title)
{
    $img = $image;
    $folderName = $folder;
    $fileName = $folderName.time().Str::slug($title).'.'.$img->getClientOriginalExtension();
    $img->move(public_path($folderName),$fileName);
    return $fileName;
}

function imgDelete($img)
{
    if (file_exists($img))
    {
        if ($img)
        {
            unlink($img);
        }
    }
}
