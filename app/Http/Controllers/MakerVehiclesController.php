<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Maker;
use App\Vehicle;
use App\Http\Requests\CreateVehicleRequest;
// use App\Http\Requests\CreateMakerRequest;


use Illuminate\Http\Request;

class MakerVehiclesController extends Controller {

    public function __construct()

    {
        $this->middleware('auth.basic.once',['except' => ['index','show']]);
    }




    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{

        $maker = Maker::find($id);



        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Does not Exist','code' => 404],404);
        }

        return response()->json(['data' => $maker->vehicles], 200);



        //return "Showing Vehicles of $id";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function store( CreateVehicleRequest $request, $makerId)

	{
		$maker = Maker::find($makerId);

        if(!$maker)
        {


            return response()->json(['message' =>'This Maker Does not Exist','code' => 404],404);

        }

        $values=$request->all();

        $maker->vehicles()->create($values);

            return response()->json(['message' =>'Vehicle associated was created'],201);



        //Vehicle::create($values);


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $vehicleId)
	{
        $maker = Maker::find($id);




        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Does not Exist','code' => 404],404);
        }


        $vehicle =$maker->vehicles->find($vehicleId);



        if(!$vehicle)
        {

            return response()->json(['message' =>'This vehicle is not associated with requested maker','code' => 404],404);
        }



            return response()->json(['data' => $vehicle], 200);


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update(CreateVehicleRequest $request,$vehicleId,$makerId)
	{
        $maker=Maker::find($makerId);

        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }


        $vehicle= $maker->vehicles->find($vehicleId);

        if(!$vehicle)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }

        $color= $request->get('color');
        $power= $request->get('power');
        $capacity= $request->get('capacity');
        $speed= $request->get('speed');


        $vehicle->color=$color;
        $vehicle->power=$power;
        $vehicle->capacity=$capacity;
        $vehicle->speed=$speed;



        $vehicle->save();

        return response()->json(['message'=>'The maker has been updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($makerId,$vehicleId)
	{
        $maker = Maker::find($makerId);



        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }


        $vehicle=$maker->vehicles->find($vehicleId);

        if(!$vehicle)

        {
            return response()->json(['message' =>'This vehicle does not exists','code' => 404],404);

        }

        $vehicle->delete();

        return response()->json(['message' =>'This vehicle have been deleted','code' => 200],200);

    }


}
