<?php

namespace App\CustomLib;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
ini_set('memory_limit', '-1');
// Imaging
class ImageCompress
{
    
    // Variables
    private $img_input;
    private $img_output;
    private $img_src;
    private $format;
    private $quality = 80;
    private $x_input;
    private $y_input;
    private $x_output;
    private $y_output;
    private $resize;

    // Set image
    public function set_img($img)
    {

        // Find format
        $ext = strtoupper(pathinfo($img, PATHINFO_EXTENSION));
        
        // JPEG image
        if($ext == "JPG" OR $ext == "JPEG" OR strpos($ext,'JPEG'))
        {   
           
            $this->format = $ext;
            $this->img_input = ImageCreateFromJPEG($img);
            $this->img_src = $img;
            

        }

        // PNG image
        elseif($ext == "PNG" OR $this->format == "png")
        {

            $this->format = $ext;
            $this->img_input = ImageCreateFromPNG($img);
            $this->img_src = $img;

        }

        // GIF image
        elseif($ext == "GIF" OR $this->format == "gif")
        {

            $this->format = $ext;
            $this->img_input = ImageCreateFromGIF($img);
            $this->img_src = $img;

        }

        // Get dimensions
        $this->x_input = imagesx($this->img_input);
        $this->y_input = imagesy($this->img_input);

    }

    // Set maximum image size (pixels)
    public function set_size($size)
    {

        // Resize
        if($this->x_input > $size )
        {

            // Wide
            if($this->x_input >= $this->y_input)
            {

                $this->x_output = $size;
                $this->y_output = ($this->x_output / $this->x_input) * $this->y_input;

            }

            // Tall
            else
            {

                $this->y_output = $size;
                $this->x_output = ($this->y_output / $this->y_input) * $this->x_input;

            }

            // Ready
            $this->resize = TRUE;

        }

        // Don't resize
        else { $this->resize = FALSE; }

    }

    // Set image quality (JPEG only)
    public function set_quality($quality)
    {

        if(is_int($quality))
        {

            $this->quality = $quality;

        }

    }

    // Save image
    public function save_img($path)
    {

        try{
            // Resize
            if($this->resize)
            {

                $this->img_output = ImageCreateTrueColor($this->x_output, $this->y_output);
                ImageCopyResampled($this->img_output, $this->img_input, 0, 0, 0, 0, $this->x_output, $this->y_output, $this->x_input, $this->y_input);

            }

            // Save JPEG
            if($this->format == "JPG" OR $this->format == "JPEG" OR $this->format == "jpg" OR $this->format == "jpeg")
            {

                if($this->resize) { imageJPEG($this->img_output, $path, $this->quality); }
                else {copy($this->img_src, $path);}

            }

            // Save PNG
            elseif($this->format == "PNG" OR $this->format == "png")
            {

                if($this->resize) { imagePNG($this->img_output, $path); }
                else { copy($this->img_src, $path); }

            }

            // Save GIF
            elseif($this->format == "GIF" OR $this->format == "gif")
            {

                if($this->resize) { imageGIF($this->img_output, $path); }
                else { copy($this->img_src, $path); }

            }
            return 'success';
        }catch (\Exception $e)
        {
            return 'fail';
        }
    }

    // Get width
    public function get_width()
    {

        return $this->x_input;

    }

    // Get height
    public function get_height()
    {

        return $this->y_input;

    }

    // Clear image cache
    public function clear_cache()
    {

        @ImageDestroy($this->img_input);
        @ImageDestroy($this->img_output);

    }

}

?>