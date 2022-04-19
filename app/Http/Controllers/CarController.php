<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $cars = Car::all();
            return view('cars', compact('cars'));
    }

    public function checkout(request $request)
    {
        // dd($request->id);   
        if(!Session::has('list')){
            //put 'list' and the cars id in session
            Session::put('list' , [$request->id]);
        }
        
        $car_id = request()->id;
        $car_id = $request->id;
        //only allow one car to be added to the list
       
        $list = session()->get('list');
        
        if(!in_array($car_id, Session::get('list'))){
            Session::push('list', $car_id);
        }
       
        // dd($list);
        session()->put('list', $list);
        Session::save();
       
        return redirect()->route('newReservation')->with('success', 'Car added successfully');
    }

   
}