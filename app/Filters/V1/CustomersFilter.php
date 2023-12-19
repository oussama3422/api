<?php


namespace App\Filters\V1;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {

  protected $allowParma=[
    'name'=>['eq'],
    'type'=>['eq'],
    'email'=>['eq'],
    'address'=>['eq'],
    'city'=>['eq'],
    'state'=>['eq'],
    'postalCode'=>['eq','gt','lt'],
  ];

  protected $columnMap=[
    'postalCode'=>'postal_code',
  ];
  protected $operatorMap=[
    'eq'=>'=', //greather than
    'lt'=>'<', // less tham
    'lte'=>'<=', // less than or equal
    'gt'=>'>', //greather
    'gte'=> '>=',//greather or equal
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