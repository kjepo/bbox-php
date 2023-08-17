// place $jpeg image in bounding box (x0,y0) -- (x1,y1)                                                            
// $doc is GDImage destination image resource                                                                      
// $jpeg is GDImage element to be placed inside bounding box                                                       
// optional argument $align can be either "center" (default) or "top"/"bottom"/"left"/"right"                      
function bbox($doc, $jpeg, $x0, $y0, $x1, $y1, $align = "center") {
    $jpegw = ImageSX($jpeg);
    $jpegh = ImageSY($jpeg);

    if ($jpegw/$jpegh < ($x1-$x0)/($y1-$y0)) {
        $dst_height = $y1 - $y0;
        $dst_width = ($jpegw / $jpegh) * $dst_height;
        $dst_x = $x0 + ($x1 - $x0 - $dst_width)/2;
        if ($align == "left")
            $dst_x = $x0;
        if ($align == "right")
            $dst_x = $x1 - $dst_width;
        $dst_y = $y0;
    } else {
        $dst_width = $x1 - $x0;
        $dst_height = ($jpegh / $jpegw) * $dst_width;
        $dst_y = $y0 + ($y1 - $y0 - $dst_height)/2;
        if ($align == "top")
            $dst_y = $y0;
        if ($align == "bottom")
            $dst_y = $y1 - $dst_height;
        $dst_x = $x0;
    }

    imagecopyresampled($doc, $jpeg, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $jpegw, $jpegh);
}

