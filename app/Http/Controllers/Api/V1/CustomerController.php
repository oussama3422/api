<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Models\Invoice;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomResource;
use App\Http\Resources\V1\CustomCollection;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter= new CustomersFilter();
        $filterItem = $filter->transformData($request); //['column','operator','value']
        //including Invoices
        $includeInvoices = $request->query('includeInvoices');
        $customers=Customer::where($filterItem);
        
        if($includeInvoices){
            $customers=$customers->with('invoices');
        }
        
        return new CustomCollection($customers->paginate()->appends($request->query()));

        // if(count($filterItem)==0){
            //  return new CustomCollection(Customer::paginate());
        // }else{
        // }
        // Customer::where($queryItem);
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
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        return new CustomResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        $includeInvoices = request()->query('includeInvoices');
        if($includeInvoices){
            return new CustomResource($customer->loadMissing('invoices'));
        }
        return new CustomResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
