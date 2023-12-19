<?php


namespace App\Filters;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class ApiFilter{
  protected $allowParma=[];
  protected $columnMap=[];
  protected $operatorMap=[];


  public function transformData(Request $request){
    $eloQuery=[];
    foreach ($this->allowParma as $param => $operator) {
        $query= $request->query($param);
        if(!isset($query)){
            continue;
        }
        $column= $this->columnMap[$param] ?? $param;
        Log::info($column);
        foreach ($operator as $operator) {
            if(isset($query[$operator])){
                $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
            }
        }
    }
    return $eloQuery;
  }
  

}