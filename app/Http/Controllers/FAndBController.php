<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Services\ImgService;
use Illuminate\Http\Request;
use Exception;
use Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FAndBController extends Controller
{
    /**
     * user management index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function query()
    {
        $restaurant = Restaurant::orderBy('booking_type')->get();

        return view('restaurant.manage', ['restaurant' => $restaurant]);
    }

    public function edit($id)
    {
        $id = intval(trim($id));
        if ($id < 0) {
            return redirect()->route('admin.restaurant.query');
        }

        $restaurant = Restaurant::whereId($id)->first();

        return view('restaurant.edit', ['restaurant' => $restaurant]);
    }

    public function update(Request $request, $id)
    {
        $restaurantId = intval(trim($id));

        $restaurant = Restaurant::whereId($restaurantId)->first();

        $name = trim($request->input('name'));
        if (mb_strlen($name) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $bookingHour = $request->input('booking_hours');

        if (count($bookingHour) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }
        $bookingHour = json_encode($bookingHour);

        $contactName = trim($request->input('contact_name'));
        if (mb_strlen($contactName) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $openHour = trim($request->input('open_hours'));
        if (mb_strlen($openHour) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $contactPhone = trim($request->input('contact_phone'));
        if (mb_strlen($contactPhone) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

//        $imageUrl = trim($request->image_url);
        $imageUrl = trim($request->input('image_url'));
        Log::info('image_url:' . $request->image_url);

        $scTitle = trim($request->input('sc_title'));

        $enTitle = trim($request->input('en_title'));

        $tcTitle = trim($request->input('tc_title'));

        $scDescription = trim($request->input('sc_description'));

        $enDescription = trim($request->input('en_description'));

        $tcDescription = trim($request->input('tc_description'));

        $logo_url = trim($request->input('logo_url'));
        if (mb_strlen($logo_url) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $location = trim($request->input('location'));
        if (mb_strlen($location) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $bookingType = $request->input('booking_style');
        if (count($bookingType) == 0) {
            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);
        }
        if (count($bookingType) == 2) {
            $bookingType = 2;
        } else {
            $bookingType = intval($bookingType[0]);
        }

        $active = $request->input('active');

        if ($active == 'on') {
            $active = 1;
        } else {
            $active = 0;
        }

        $url = trim($request->input('url'));
        if (mb_strlen($url) == 0) {

            $result = 'Save Error';

            return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => $result]);

        }

        $restaurant->name = $name;
        $restaurant->open_hours = $openHour;
        $restaurant->booking_hours = $bookingHour;
        $restaurant->image_url = $imageUrl;
        $restaurant->contact_name = $contactName;
        $restaurant->contact_phone = $contactPhone;
        $restaurant->location = $location;
        $restaurant->sc_title = $scTitle;
        $restaurant->en_title = $enTitle;
        $restaurant->tc_title = $tcTitle;
        $restaurant->sc_description = $scDescription;
        $restaurant->en_description = $enDescription;
        $restaurant->tc_description = $tcDescription;
        $restaurant->logo_url = $logo_url;
        $restaurant->booking_type = $bookingType;
        $restaurant->active = $active;
        $restaurant->restaurant_url = $url;

        $result = 0;

        try {
            $restaurant->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store Restaurant exception ,exception:' . $e->getMessage());
        }
        if ($result == 1) {
            return redirect()->route('admin.restaurant.query');
        }

        return view('restaurant.edit', ['restaurant' => $restaurant, 'result' => 'Save Error']);
    }

    public function delete($id)
    {
        $id = intval($id);

        $restaurant = Restaurant::whereId($id)->first();

        if (is_null($restaurant)) {
            return redirect()->route('admin.restaurant.query');
        }

        $result = 'Delete Error';

        try {
            $restaurant::destroy($id);

            $result = 'Delete Success';
        } catch (Exception $e) {
            Log::error('delete Restaurant exception,id:' . $id . ',exception:' . $e->getMessage());
        }

        return view('restaurant.delete', ['result' => $result]);
    }

    public function create()
    {
        return view('restaurant.create', ['restaurant' => new Restaurant()]);
    }

    public function store(Request $request)
    {
        $restaurant = new Restaurant();

        $name = trim($request->input('name'));
        if (mb_strlen($name) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $bookingHour = $request->input('booking_hours');

        if (count($bookingHour) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }
        $bookingHour = json_encode($bookingHour);

        $contactName = trim($request->input('contact_name'));
        if (mb_strlen($contactName) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $openHour = trim($request->input('open_hours'));
        if (mb_strlen($openHour) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $contactPhone = trim($request->input('contact_phone'));
        if (mb_strlen($contactPhone) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $imageUrl = trim($request->image_url);
        Log::info('image_url:' . $request->image_url);

        $scTitle = trim($request->input('sc_title'));

        $enTitle = trim($request->input('en_title'));

        $tcTitle = trim($request->input('tc_title'));

        $scDescription = trim($request->input('sc_description'));

        $enDescription = trim($request->input('en_description'));

        $tcDescription = trim($request->input('tc_description'));

        $logo_url = trim($request->input('logo_url'));
        if (mb_strlen($logo_url) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $location = trim($request->input('location'));
        if (mb_strlen($location) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $bookingType = $request->input('booking_style');
        if (count($bookingType) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }
        if (count($bookingType) == 2) {
            $bookingType = 2;
        } else {
            $bookingType = intval($bookingType[0]);
        }

        $active = $request->input('active');

        if ($active == 'on') {
            $active = 1;
        } else {
            $active = 0;
        }

        $url = trim($request->input('url'));
        if (mb_strlen($url) == 0) {
            $result = 'Add Error';

            return view('restaurant.create', ['restaurant' => $restaurant, 'result' => $result]);
        }

        $restaurant->name = $name;
        $restaurant->open_hours = $openHour;
        $restaurant->booking_hours = $bookingHour;
        $restaurant->image_url = $imageUrl;
        $restaurant->contact_name = $contactName;
        $restaurant->contact_phone = $contactPhone;
        $restaurant->location = $location;
        $restaurant->sc_title = $scTitle;
        $restaurant->en_title = $enTitle;
        $restaurant->tc_title = $tcTitle;
        $restaurant->sc_description = $scDescription;
        $restaurant->en_description = $enDescription;
        $restaurant->tc_description = $tcDescription;
        $restaurant->logo_url = $logo_url;
        $restaurant->booking_type = $bookingType;
        $restaurant->active = $active;
        $restaurant->restaurant_url = $url;

        $result = 0;

        try {
            $restaurant->save();

            $result = 1;
        } catch (Exception $e) {
            Log::error('store Restaurant exception ,exception:' . $e->getMessage());
        }
        if ($result == 1) {
            return redirect()->route('admin.restaurant.query');
        }
        return view('restaurant.create', ['restaurant' => $restaurant, 'result' => 'Add Error']);
    }

    public function uploadImage(Request $request)
    {
        $url = 'http://' . $_SERVER['HTTP_HOST'];
        Log::info($_SERVER['HTTP_HOST']);

        $imgA = trim($request->image_a);

        if (mb_strlen($imgA) == 0)
            return response()->json(['result' => 2]);//2：没传图片

        $checkImgA = ImgService::checkBase64Img($imgA);

        if ($checkImgA['result'] == 0) {
            return response()->json(['result' => 2]);
        }

        $backendId = session('bk_auth');

        $time = time();

        $image_name = md5($backendId . $time);

        $pathA = 'data/restaurant/' . $image_name . $checkImgA['img_suffix'];

        $statusA = ImgService::upload($pathA, $checkImgA['img_data']);

        if ($statusA) {
            return response()->json(['result' => 2]);
        }

        $pathA = $url . '/' . $pathA;//绝对路径

        return response()->json(['result' => 1, 'path' => $pathA]);
    }
}
