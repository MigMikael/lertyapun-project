<?php

namespace App\Http\Controllers;

use App\Models\DaliveryService;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Log;
use App\Traits\ValidateTrait;

class DaliveryServiceController extends Controller
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
            $deliveries = DaliveryService::where("name", "like", "%".$query."%")
                ->orderBy('name', 'ASC')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $deliveries = DaliveryService::where("name", "like", "%".$query."%")
                ->orderBy('name', 'DESC')
                ->paginate($page);
        } else {
            $deliveries = DaliveryService::where("name", "like", "%".$query."%")
                ->orderBy('updated_at', 'DESC')
                ->paginate($page);
        }
        $deliveries->appends(['query' => $query]);
        $deliveries->appends(['sort' => $sort]);
        return view('admin.dalivery.index', [
            'deliveries' => $deliveries,
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
        return redirect("admin/deliveries?query=".$query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dalivery.create', [
            'status' => $this->status,
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
        $this->validateDeliverService($request);

        $newDelivery = $request->all();
        $newDelivery['slug'] = (new StringGenerator())->generateSlug();

        if($request->hasFile('delivery_image')) {
            $file = $request->file('delivery_image');
            $delivery_image = $this->storeImage($file, "");
            $newDelivery['image_id'] = $delivery_image->id;
        }

        $newDelivery = DaliveryService::create($newDelivery);
        return redirect()
            ->action([DaliveryServiceController::class, 'index'])
            ->with('success', 'Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaliveryService  $daliveryService
     * @return \Illuminate\Http\Response
     */
    public function show(DaliveryService $daliveryService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaliveryService  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(DaliveryService $delivery)
    {
        return view('admin.dalivery.edit', [
            'delivery' => $delivery,
            'status' => $this->status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaliveryService  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaliveryService $delivery)
    {
        $this->validateDeliverService($request);

        $newDelivery = $request->all();

        if($request->hasFile('delivery_image')) {
            $file = $request->file('delivery_image');
            $delivery_image = $this->storeImage($file, "");
            $newDelivery['image_id'] = $delivery_image->id;
        }

        $delivery->update($newDelivery);
        return redirect()
            ->action([DaliveryServiceController::class, 'index'])
            ->with('success', 'Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaliveryService  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaliveryService $delivery)
    {
        $delivery->delete();
        return redirect()->back()->with('success', 'Delete Success');
            //->action([DaliveryServiceController::class, 'index'])
            //->with('success', 'Delete Success');
    }
}
