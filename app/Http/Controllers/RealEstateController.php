<?php

namespace App\Http\Controllers;

use App\Models\RealEstate\RealEstate;
use App\Models\RealEstate\RealEstateCategory;
use App\Models\RealEstate\RealEstatePhotoUrl;
use App\Models\User;
use App\Services\FileUploaderHelper;
use App\Services\QueryHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RealEstateController extends Controller
{
    public function create(Request $request)
    {
        $user_id = User::where('token', $request->bearerToken())->first()->id;

        $data = $request->all();
        $re = new RealEstate([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'price_per_square_meter' => $data['price_per_square_meter'],
            'square' => $data['square'],
            'address' => $data['address'],
            'inner_id' => $data['inner_id'],
            'agent' => $data['agent'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'real_estate_category_id' => $data['real_estate_category_id'],
            'contract_type_id' => $data['contract_type_id'],
            'has_commision' => $data['has_commision'],

            'realized' => $data['realized'] ?? false,
            'currency_id' => $data['currency_id'] ?? null,

            'modified_by_user_id' => $user_id,
            'created_by_user_id' => $user_id,
        ]);
        $re->save();

        return $re;
    }

    public function update(Request $request, $id)
    {
        $re = RealEstate::find(intval($id));
        if (!$re) {
            return response('Resource not found', 404);
        }

        $data = $request->all();

        $re->title = $data['title'];
        $re->description =  $data['description'];
        $re->price = $data['price'];
        $re->price_per_square_meter = $data['price_per_square_meter'];
        $re->square = $data['square'];
        $re->address = $data['address'];
        $re->inner_id = $data['inner_id'];
        $re->agent = $data['agent'];
        $re->mobile_number = $data['mobile_number'];
        $re->email = $data['email'];
        $re->real_estate_category_id = $data['real_estate_category_id'];
        $re->contract_type_id = $data['contract_type_id'];
        $re->has_commision = $data['has_commision'];

        $user_id = User::where('token', $request->bearerToken())->first()->id;
        $re->modified_by_user_id = $user_id;
        $re->realized = $data['realized'] ?? false;
        $re->currency_id = $data['currency_id'] ?? null;

        $re->save();

        return $re;
    }

    public function show(Request $request, $id)
    {
        $re = RealEstate::find($id);
        if ($re) {
            $re['images'] = $re->photo_urls()->get();
            return response()->json($re);
        } else {
            return response('Not found', 404);
        }
    }

    public function delete(Request $request, $id)
    {
        $re = RealEstate::find($id);
        if (!$re) {
            return response('Resource does not exist', 200);
        }

        $photo_urls = $re->photo_urls()->get();
        foreach ($photo_urls as $photo_url) {
            FileUploaderHelper::deleteRealEstatePhotoUrl($photo_url);
        }

        FileUploaderHelper::deleteMainPhoto($re);
        $re->delete();

        return response('Deleted', 200);
    }

    public function setMainPhoto(Request $request)
    {
        $rsid = intval($request->input('real_estate_id'));
        $re = RealEstate::find($rsid);

        if (!$re) {
            return response('Smth went wrong', 500);
        }

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            if (!$file->isValid()) {
                return response('Bad request', 400);
            } else {
                if ($re->main_image_url !== null) {
                    Storage::delete($re->main_image_url);
                }
                $re->main_image_url = $file->store('img/real-estates');
                $re->save();
                return $re;
            }
        }

        return response('Smth went wrong', 500);
    }

    public function deleteMainPhoto(Request $request, $real_estate_id)
    {
        //$rsid = intval($request->input('real_estate_id'));
        $rsid = intval($real_estate_id);
        $re = RealEstate::find($rsid);

        if (!$re) {
            return response('Resource does not exist', 200);
        }

        if ($re->main_image_url) {
            FileUploaderHelper::deleteMainPhoto($re);
        }

        return response('Deleted', 200);
    }

    public function getFeatured(Request $request)
    {
        $res_q = DB::table('real_estates')->select('*');

        if ($request->exists('reid')) {
            $reid = $request->query('reid', '');
            $res_q->where('inner_id', $reid);
        } else {
            if ($request->exists('p_from')) {
                $p_from = floatval($request->query('p_from'));
                $res_q->where('price', '>=', $p_from);
            }
            if ($request->exists('p_to')) {
                $p_to = floatval($request->query('p_to'));
                $res_q->where('price', '<=', $p_to);
            }
            if ($request->exists('ppsqm_from')) {
                $ppsqm_from = floatval($request->query('ppsqm_from'));
                $res_q->where('price_per_square_meter', '>=', $ppsqm_from);
            }
            if ($request->exists('ppsqm_to')) {
                $ppsqm_to = floatval($request->query('ppsqm_to'));
                $res_q->where('price_per_square_meter', '<=', $ppsqm_to);
            }
            if ($request->exists('ct')) {
                $ct = intval($request->query('ct'));
                $res_q->where('contract_type_id', $ct);
            }
            if ($request->exists('cm')) {
                $has_cm = QueryHelper::stringToBool($request->query('cm'));
                $res_q->where('has_commision', $has_cm);
            }
            if ($request->exists('ids')) {
                $ids = $request->query('ids');
                $res_q->whereIn('id', $ids);
            }
        }

        $per_page = 10;
        if ($request->exists('per_page')) {
            if (intval($request->query('per_page') > 0)) {
                $per_page = intval($request->query('per_page'));
            }
        }

        return $res_q->paginate($per_page);
    }


    public function uploadImage(Request $request)
    {
        $rsid = intval($request->input('real_estate_id'));

        if ($request->isMethod('post')) {
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                if (!$file->isValid()) {
                    return response('Bad request', 400);
                } else {
                    $path = $file->store('img/real-estates');
                    $rs_photo = new RealEstatePhotoUrl([
                        'url' => $path,
                        'real_estate_id' => $rsid,
                    ]);
                    $rs_photo->save();

                    return $rs_photo;
                }
            }
        }

        return response('Smth went wrong', 500);
    }


    public function uploadimages(Request $request)
    {
        $rsid = intval($request->input('real_estate_id'));
        $files = $request->file('images');

        foreach ($files as $f) {
            if (!$f->isValid()) {
                return response('Bad request', 400);
            }
        }

        // TODO: restrict the file size(<8MB) and extension(img, png, gif)
        $photos = array();
        foreach ($files as $f) {
            $path = $f->store('img/real-estates');
            $rs_photo = new RealEstatePhotoUrl([
                'url' => $path,
                'real_estate_id' => $rsid,
            ]);
            $rs_photo->save();
            $photos[] = $rs_photo;
        }

        return $photos;
    }

    public function deleteImage(Request $request, $real_estate_photo_id)
    {
        $re_photo = RealEstatePhotoUrl::find($real_estate_photo_id);
        if ($re_photo) {
            Storage::delete($re_photo->url);
        }
        return RealEstatePhotoUrl::destroy($real_estate_photo_id);
    }

    public function setAdvVisibility($isVisible)
    {
        //
    }

    public function clearImages(Request $request, $id)
    {
    }
}
