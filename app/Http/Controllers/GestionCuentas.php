<?php


namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;

class GestionCuentas extends Controller
{
    public function createclient(Request $request)
    {
     Client::create($request->all());

     return response()->json('cliente creado correctamente');
    }

    public function listclients()
    {
        $ListClients=Client::all();
        return response()->json($ListClients);
    }

    public function createaccount(Request $request)
    {
        Account::create($request->all());
        return response()->json('cuenta creada correctamente');
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

}
