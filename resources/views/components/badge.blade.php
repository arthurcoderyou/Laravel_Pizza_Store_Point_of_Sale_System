@php 
    if($condition == "null"){
        $count = 0;
        $crs = DB::table($tableName)->where('user_id',$userId)->count();
    }else if($userId == 0){
        $count = 0;
        $crs = DB::table($tableName)->where('status',$condition)->count();
        //$crs = DB::select('select * from orders where user_id = ? AND status = ?',[$userId,$condition])->count();
    }else{
        $count = 0;
        $crs = DB::table($tableName)->where('user_id',$userId)->where('status',$condition)->count();
        //$crs = DB::select('select * from orders where user_id = ? AND status = ?',[$userId,$condition])->count();
    }
    
@endphp

<span class="badge badge-{{ $color }}">{{ $crs }}</span>