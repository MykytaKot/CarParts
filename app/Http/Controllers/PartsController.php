<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;

class PartsController extends Controller
{
    public function index()
    {
        $products = Part::orderBy('name', 'DESC')->get()->toArray();
        return array_reverse($products);
    }
    public function store(Request $request)
    {
        if ($request->input('action') == 'save') {


            $product = new Part([
                'name' => $request->input('name'),
                'serialnumber' => $request->input('serialnumber'),
                'car_id' => $request->input('car_id')
            ]);
            $product->save();
            return response()->json('Part created');
        }
        if ($request->input('action') == 'getforcar') {
            $product = Part::getPartsByCarId($request->input('id'));
            return response()->json($product);
        }

        if ($request->input('action') == 'filter') {

            if ($request->input('abc')) {
                $abc = 'ASC';
            } else {
                $abc = 'DESC';
            }


            $product = Part::getPartsByCarId($request->input('id'), $abc);


            return response()->json($product);
        }
        if ($request->input('action') == 'filterAll') {

            if (!$request->input('abc')) {
                $abc = 'ASC';
            } else {
                $abc = 'DESC';
            }


            $products = Part::orderBy('name', $abc)->get()->toArray();
            return array_reverse($products);
        }
    }


    public function show($id)
    {
        $product = Part::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {
        $product = Part::find($id);
        $product->update($request->all());
        return response()->json('Part updated');
    }
    public function destroy($id)
    {
        $product = Part::find($id);
        $product->delete();
        return response()->json('Part deleted');
    }
}
