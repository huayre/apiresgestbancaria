<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class GestionCuentas extends Controller
{
    public function createclient(Request $request)
    {
     Client::create($request->all());

     return response()->json(['message'=>'cliente creado correctamente']);
    }

    public function listclients()
    {
        $ListClients=Client::all();
        return response()->json($ListClients);
    }

    public function createaccount(Request $request)
    {
        Account::create($request->all());
        return response()->json(['message'=>'cuenta creada correctamente']);
    }

    public function listaccounts()
    {
        $Listaccounts=Account::all();
        return response()->json($Listaccounts);
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
