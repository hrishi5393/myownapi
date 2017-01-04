<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\createMakerRequest;

use App\Maker;
use App\vehicle;
use Illuminate\Http\Request;

class MakerController extends Controller {



    public function __construct()

    {
        $this->middleware('auth.basic.once',['except' => ['index','show']]);
    }



    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$makers=Maker::all();


        return response()->json(['data'=>$makers],200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function store(createMakerRequest $request)
	{
		$values = $request-> only(['name','phone']);

        Maker::create($values);

        return response()->json(['message'=>'Maker correctly added'],201);


        //return 'right'
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
    {
        $maker = Maker::find($id);



        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }

        return response()->json(['data' => $maker], 200);


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return Response
         */
    }
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreateMakerRequest $request,$id)
	{
        $maker=Maker::find($id);

        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }

        $name= $request->get('name');
        $phone= $request->get('phone');

        $maker->name=$name;
        $maker->phone=$phone;

        $maker->save();

        return response()->json(['message'=>'The maker has been updated'],200);




	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $maker = Maker::find($id);



        if(!$maker)

        {
            return response()->json(['message' =>'This Maker Doesnot Exist','code' => 404],404);
        }


        $vehicles=$maker->vehicles;

        if(sizeof($vehicles)>0)

        {
            return response()->json(['message' =>'This maker has associated vehicles,Please delete his vehicle first','code' => 409],409);

        }

	$maker->delete();

        return response()->json(['message' =>'This maker has been deleted','code' => 200],200);

	}

}
