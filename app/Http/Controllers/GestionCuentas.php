<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GestionCuentas extends Controller
{
    public function createclient(Request $request)
    {
        $data=$this->validate($request,[
            'name'      =>'required',
            'lastname'  =>'required',
            'sex'       =>'required'
        ]);
               

        $client=Client::create($data);

        if(isset($client))
        {
            return response()->json(['message'=>'cliente creado correctamente']);
        }

     
    }

    public function listclients()
    {
        $ListClients=Client::all();
        if(isset($ListClients))
        {
            return response()->json($ListClients);
        }
        else
        {
            return response()->json(['message'=>'no hay registros']);
        }

       
    }

    public function createaccount(Request $request)
    {   
        $data=$this->validate($request,[
            'number'          =>'required|unique:accounts',
            'type'            =>'required',
            'client_id'       =>'required',
            'amount'          =>'required'
        ]);

        $account=Account::create($data);
        if(isset($account))
        {
            return response()->json(['message'=>'cuenta creada correctamente']);
        }
    }

    public function listaccounts()
    {
        $Listaccounts=Account::all();
        if(isset($Listaccounts))
        {
            return response()->json($Listaccounts);
        }
        else
        {
            return response()->json(['message'=>'no hay registros']);
        }        
        
    }

    public function  checkbalance($number_account){
        $account=Account::where('number',$number_account)->get();
        foreach ($account as $item)
        {
            $amount=$item->amount;
        }
        return response()->json(['amount'=>$amount]);
    }


    public function updateamount(Request $request,$number_account)
    {

                // 0 deposito
        if($request->operacion==0)
        {
                 Account::where('number',$number_account)->increment('amount',$request->amount);

        }
        else{
            //1 retiro
            if($request->operacion==1)
            {
                Account::where('number',$number_account)->decrement('amount',$request->amount);
            }
        }

        return response()->json(['message'=>'la cuenta fue actualizada correctamente']);

    }

    public function showaccount($number_account)
    {
        $account=Account::where('number',$number_account)->get();      
       return response()->json($account);
    }

    public function showaclient($id_client)
    {
        $client=Client::find($id_client);        
       return response()->json($client);
    }

}
