<?php

namespace App\Http\Controllers;

use App\Models\RealEstate\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RealEstateController extends Controller
{
    public function create(Request $request)
    {
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
            // 'category'=>$data[],
            'main_image_url' => $data['main_image_url'],
            'contract_type' => $data['contract_type'],
            'has_commision' => $data['has_commision'],
        ]);
        $re->save();

        return $re;
    }

    public function update(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        $re = RealEstate::find($id);
        if ($re) {
            return response()->json($re);
        } else {
            return response('Not found', 404);
        }
    }

    public function delete(Request $request, $id)
    {
        //
    }

    public function getFeatured(Request $request)
    {
        $res_q = DB::table('real_estates')->select('id');
        // todo select
        // todo paginate!

        if ($request->exists('reid')) {
            $reid = $request->query('reid', '');
            if (trim($reid) != '') {
                $res_q->where('inner_id', $reid);
            }
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
                $has_cm = $request->query('cm');
                $res_q->where('has_commision', $has_cm);
            }
        }

        return $res_q->get();
    }

    /   **
     * some extra functions
     */

    public function setAdvVisibility($isVisible)
    {
        //
    }

    public function clearImages(Request $request, $id)
    {
    }

    public function deleteImage(Request $request, $url)
    {
    }
}
