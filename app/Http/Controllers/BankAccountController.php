<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;
use App\Traits\ValidateTrait;
use Illuminate\Support\Facades\Log;

class BankAccountController extends Controller
{
    use ImageTrait;
    use ValidateTrait;
    public $status = [
        'show' => 'Show',
        'hide' => 'Hide'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 10;
        $sort = $request->query('sort');
        $query = $request->query('query');

        if($sort == 'name_asc') {
            $banks = BankAccount::where("bank_name", "like", "%".$query."%")
                ->orderBy('bank_name', 'ASC')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $banks = BankAccount::where("bank_name", "like", "%".$query."%")
                ->orderBy('bank_name', 'DESC')
                ->paginate($page);
        } else {
            $banks = BankAccount::where("bank_name", "like", "%".$query."%")
                ->orderBy('updated_at', 'DESC')
                ->paginate($page);
        }
        $banks->appends(['query' => $query]);
        $banks->appends(['sort' => $sort]);
        return view('admin.bank.index', [
            'banks' => $banks,
            'search' => $query,
        ]);
    }

    /**
     * Search a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("admin/banks?query=".$query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $bankNames = config('constants.bankNames');
        return view('admin.bank.create', [
            'status' => $this->status,
            // 'bankNames' => $bankNames,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateBankAccount($request);

        $newBank = $request->all();
        $newBank['slug'] = (new StringGenerator())->generateSlug();

        if($request->hasFile('bank_image')) {
            $file = $request->file('bank_image');
            $bank_image = $this->storeImage($file, "");
            $newBank['image_id'] = $bank_image->id;
        }

        $newBank = BankAccount::create($newBank);
        return redirect()
            ->action([BankAccountController::class, 'index'])
            ->with('success', 'Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bank)
    {
        // $bankNames = config('constants.bankNames');
        return view('admin.bank.edit', [
            'bank' => $bank,
            'status' => $this->status,
            // 'bankNames' => $bankNames,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bank)
    {
        $this->validateBankAccount($request);

        $newBank = $request->all();

        if($request->hasFile('bank_image')) {
            $file = $request->file('bank_image');
            $bank_image = $this->storeImage($file, "");
            $newBank['image_id'] = $bank_image->id;
        }

        $bank->update($newBank);
        return redirect()
            ->action([BankAccountController::class, 'index'])
            ->with('success', 'Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bank)
    {
        $bank->delete();
        return redirect()
            ->action([BankAccountController::class, 'index'])
            ->with('success', 'Delete Success');
    }
}
