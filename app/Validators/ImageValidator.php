<?php

namespace App\Validators;

class ImageValidator
{
    public static function check_image_dimensions($files, string $dimensions, array &$error = null): bool
    {

        list($filename, $expected_width, $expected_height) = explode(',', $dimensions);
        if ($filename) {
            $request = \Config\Services::request();

            $get_file = $request->getFiles();


            $file_name = explode('.', $filename);
            if (count($file_name) > 1) {
                $filename = $file_name[0];
                $index = $file_name[1];
                $file = $get_file[$filename][$index]->getTempName();
            } else if (count($file_name) == 1) {
                $filename = $file_name[0];
                $file = $get_file[$filename]->getTempName();
            }
            // dd($get_file[$filename][$index]->getTempName());

            // Memeriksa apakah file adalah instance dari UploadedFile
            // if ($file instanceof \CodeIgniter\HTTP\Files\UploadedFile) {
            // dd($file);
            // }

            if (file_exists($file)) {
                $image_info = getimagesize($file);
                if ($image_info === false) {
                    $error[] = 'The file is not a expected size image.';
                    return false;
                }

                $width = $image_info[0];
                $height = $image_info[1];

                if ($width != $expected_width || $height != $expected_height) {
                    $errors[] = "The image dimensions must be {$expected_width}x{$expected_height}.";
                    return false;
                }
            }

            return true;
        } else {
            return true;
        }
    }
}
