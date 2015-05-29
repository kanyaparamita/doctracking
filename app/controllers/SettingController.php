<?php

class SettingController extends \BaseController {
	public function show()
	{
		$setting = Auth::user()->organization->setting;

		return View::make('settings.show')
				->with('setting', $setting);
	}


	public function update()
	{
		$setting = Auth::user()->organization->setting;
		$logo = Input::file('logo');
		$header_image = Input::file('header_image');
		$background_image = Input::file('background_image');

		$destinationPath = 'img/settings/';
		// save logo
		if ($logo != null) {
            $extension = $logo->getClientOriginalExtension(); //if you need extension of the file
            $logo_name = Auth::user()->organization->id.'_logo.'.$extension;
            $uploadSuccess = Input::file('logo')->move($destinationPath, $logo_name);
            $setting->logo = $logo_name;
		}

		// save header
		if ($header_image != null) {
            $extension = $header_image->getClientOriginalExtension(); //if you need extension of the file
            $header_image_name = Auth::user()->organization->id.'_header_image.'.$extension;
            $uploadSuccess = Input::file('header_image')->move($destinationPath, $header_image_name);
            $setting->header_image = $header_image_name;
		}

		// save background
		if ($background_image != null) {
            $extension = $background_image->getClientOriginalExtension(); //if you need extension of the file
            $background_image_name = Auth::user()->organization->id.'_background_image.'.$extension;
            $uploadSuccess = Input::file('background_image')->move($destinationPath, $background_image_name);
            $setting->background_image = $background_image_name;
		}

		$setting->title = Input::get('title');
		$setting->is_active = Input::get('is_active');
        $setting->title_color = Input::get('title_color');
		$setting->save();

		return Redirect::to('settings/')->with('message', 'Setting updated');
	}

    public function reset() {
        $setting = Auth::user()->organization->setting;
        $setting->title = '';
        $setting->logo = '';
        $setting->header_image = '';
        $setting->background_image = '';
        $setting->save();

        return Redirect::to('settings/')->with('message', 'Setting reset');
    }
}
