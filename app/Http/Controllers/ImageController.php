<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    public function uploadForm()
    {
        return view('home');
    }


    public function uploadSubmit(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();

        $destinationPath = public_path('/images');
        $img = imagecreatefromjpeg($image->path());

        // Save the processed image
        imagejpeg($img, $destinationPath.'/'.$input['imagename']);

        $this->imageToPencilSketch($img, $destinationPath.'/sketch_'.$input['imagename']);

        return back()
            ->with('success','Image uploaded successfully.')
            ->with('imageName', $input['imagename']);

    }


    private function imageToPencilSketch($image, $outputPath)
    {
        // Convert the image to grayscale
        imagefilter($image, IMG_FILTER_GRAYSCALE);

        // Invert the colors
        imagefilter($image, IMG_FILTER_NEGATE);

        // Apply a Gaussian blur to simulate pencil lines
        imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);

        // Invert the colors again to get the final pencil sketch effect
        imagefilter($image, IMG_FILTER_NEGATE);

        // Removes noise from image and gives pencil sketchy effect
        imagefilter($image, IMG_FILTER_MEAN_REMOVAL);

        // Except you can specify the color
        imagefilter($image, IMG_FILTER_COLORIZE, 128, 127, 125);

        // Save the processed image
        imagejpeg($image, $outputPath);

        // Free up memory
        imagedestroy($image);
    }
}
