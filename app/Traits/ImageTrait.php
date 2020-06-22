<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Config;

trait ImageTrait {

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndStoreImage( Request $request, $fieldname = 'image', $directory = 'unknown', $oldimage = ' ' ) {

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();
            }

            $file_dir = config('app.' . $directory . '_filefolder');

            // Check if the old image exists inside folder
            if (file_exists( $file_dir . '/' . $oldimage)) {
                unlink($file_dir . '/' . $oldimage);
            }

            // Set image name
            $image = $request->image;
            $image_name = md5($directory . '_' . time()) . '.' . $image->getClientOriginalExtension();

            // Move image to folder
            $image->move($file_dir, $image_name);

            return $image_name;
        }

        return null;

    }

}
