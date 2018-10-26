<?php
#****************************************#
# * @Author: steve tran                  #
# * @Email: stevetran.bao@gmail.com      #
# * @Website: https://gocnhinsteve.wordpress.com  #
# * @Copyright: 2018 - 2019              #
#****************************************#
function size_thumbnail($pathImage = 'media/images/default/photo_not_available.jpg', $maxWidth = 120, $maxHeight = 120)
{
    if(file_exists($pathImage))
    {
        $infoImage = @getimagesize($pathImage);
        $width = $infoImage[0];
        $height = $infoImage[1];
        $percent = $width/$height;
        $width = min($width, $maxWidth);
        $height = min($width/$percent, $maxHeight);
        $width = $height*$percent;
        return array('width'=>$width, 'height'=>$height);
    } else {
        return array('width'=>$maxWidth, 'height'=>$maxHeight);
    }
}

function show_thumbnail($path = '', $image = '', $thumb = 1, $type = 'product')
{
    $image = explode(',', $image);
    $pathThumbnail = 'media/images/'.$type.'/'.$path.'/thumbnail_'.$thumb.'_'.$image[0];
    if (file_exists($pathThumbnail)) {
        return 'thumbnail_'.$thumb.'_'.$image[0];
    } else {
        return $image[0];
    }
}

function show_image($image = '')
{
    $image = explode(',', $image);
    return $image[0];
}