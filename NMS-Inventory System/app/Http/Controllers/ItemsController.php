<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\item;
use App\category;
use Illuminate\Http\Request;
use DB;
use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidateRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
class ItemsController extends Controller
{

    // for authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Retreiving of Data.
    function getData(){
        $data['data'] = DB::table('items')->get();

        if(count($data) > 0){
            return view('pages/items_page', $data);
        }
        else{
            return view('pages/items_page');
        }
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $updateitem = item::findOrFail($request->editid);

        $updateitem->itemname =  $request['itemname'];
        $updateitem->itemdesc = $request['itemdesc'];
        $updateitem->price = $request['price'];
        $updateitem->quantity = $request['quantity'];
        $updateitem->catid = $request['catid'];

        $updateitem->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    function insert(Request $req){
        $itemname = $req->input('itemname');
        $itemdesc = $req->input('itemdesc');
        $price = $req->input('price');
        $quantity = $req->input('quantity');
        $catid = $req->input('catid');
        $data = array('itemname'=>$itemname,'itemdesc'=>$itemdesc,'price'=>$price,'quantity'=>$quantity,'catid'=>$catid,'created_at'=>NOW(),'updated_at'=>NULL);


        if (DB::table('items')->where('itemname', '=', $itemname)->exists()) {
            $notification = array(
                'message'=> 'Error!',
                'alert-type' => 'danger'
            );
        }else{
            DB::table('items')->insert($data);
            $notification = array(
                'message'=> 'A New Item is Inserted!',
                'alert-type' => 'success'
            );
        }
        return back()->with($notification);


    }
}

