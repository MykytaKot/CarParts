<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Part;

class CarsController extends Controller
{
    public function index()
    {

        $products = Car::orderBy('name', 'DESC')->get()->toArray();
        return array_reverse($products);
    }
    public function store(Request $request)
    {
        if ($request->input('action') == 'save') {


            $isregisted = $request->input('is_registered');

            if (!isset($isregisted)) {
                $isregisted = 0;
            }

            $product = new Car([
                'name' => $request->input('name'),
                'registration_number' => $request->input('registration_number'),
                'is_registered' => $isregisted
            ]);
            $product->save();
            return response()->json('car created');
        }

        if ($request->input('action') == 'filter') {

            if (!$request->input('abc')) {
                $abc = 'ASC';
            } else {
                $abc = 'DESC';
            }

            if ($request->input('is_reg')) {
                $products = Car::where('is_registered', 1)->orderBy('name', $abc)->get()->toArray();
            } else {
                $products = Car::orderBy('name', $abc)->get()->toArray();
            }

            return array_reverse($products);
        }
    }
    public function show($id)
    {
        $product = Car::find($id);
        return response()->json($product);
    }
    public function update($id, Request $request)
    {
        $product = Car::find($id);
        $product->update($request->all());
        return response()->json('car updated');
    }
    public function destroy($id)
    {
        $product = Car::find($id);
        $product->delete();
        Part::deletePartsWithCarId($id);
        return response()->json('product deleted');
    }
}
