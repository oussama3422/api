<?php


namespace App\Filters\V1;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter {
  protected $allowParma=[
    'customerId'=>['eq'],
    'amount'=>['eq','lt','gt','lte','gte'],
    'status'=>['eq','ne'],
    'billedDate'=>['eq','lt','gt','lte','gte'],
    'paidDate'=>['eq','lt','gt','lte','gte'],
  ];

  protected $columnMap=[
    'customerId'=>'customer_id',
    'billedDate'=>'billed_date',
    'paidDate'=>'paid_date',
  ];
  protected $operatorMap=[
    'eq'=>'=', //greather than
    'lt'=>'<', // less tham
    'lte'=>'<=', // less than or equal
    'gt'=>'>', //greather
    'gte'=> '>=',//greather or 
    'ne'=>'!=' ,// not equal
  ];


  // public function transformData(Request $request){
  //   $eloQuery=[];
  //   foreach ($this->allowParma as $param => $operator) {
  //       $query= $request->query($param);
  //       if(!isset($query)){
  //           continue;
  //       }
  //       $column= $this->columnMap[$param] ?? $param;
  //       Log::info($column);
  //       foreach ($operator as $operator) {
  //           if(isset($query[$operator])){
  //               $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
  //           }
  //       }
  //   }
  //   return $eloQuery;
  // }
  

}