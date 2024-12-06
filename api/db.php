<?php
   class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db02";
     protected $pdo;
     protected $table;
     
     function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
     }
     
     //求id
      function max($col,$where=[]){
        return $this->math('max',$col,$where);
     }
     //有幾筆資料，如果有where[]，看條件有幾個
     function count($where=[]){
        return $this->math('count','*',$where);
     }
     //欄位相加
     function sum($col,$where=[]){
        return $this->math('sum',$col,$where);
    }
    //最小欄位
    function min($col,$where=[]){
        return $this->math('min',$col,$where);
    }
    //平均欄位
    function avg($col,$where=[]){
        return $this->avg('avg',$col,$where);
    }    
     
     
     
     
     
     
     
     
     
     //方便使用各個聚合函式
     protected function math($math,$col='id',$where=[]){
        $sql="SELECT $math($col) FROM $this->table";

        if(!empty($where)){
            $tmp=$this->a2s($where);
            $sql=$sql . " WHERE " . join(" && ", $tmp);
        }

        return $this->pdo->query($sql)->fetchColumn();
    }
   //撈出全部資料
     //整張資料表
     //有條件
     //其他sql功能
    function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                  $where=$this->a2s($arg[0]);
                  $sql=$sql . " WHERE ". join(" && ",$where);
            }else{
                //$sql=$sql.$arg[0];
                $sql .= $arg[0];
            }
        }
        if(!empty($arg[1])){
            $sql=$sql . $arg[1];
        }
        return $this->fetchAll($sql);
    }
    //撈出單筆資料

    function find($id){
        $sql="SELECT * FROM $this->table ";
             if(is_array($id)){
                  $where=$this->a2s($id);
                  $sql=$sql . " WHERE ". join(" && ",$where);
            }else{
                //$sql=$sql.$arg[0];
                $sql .= " WHERE `id`='$id'";
            }
        
        
        return $this->fetchOne($sql);
    }
    function save($array){
            if(isset($array['id'])){
                //update
                $id=$array['id'];
                unset($array['id']);
                $set=$this->a2s($array);
                $sql ="UPDATE $this->table SET ".join(',',$set)." where `id`='$id'";
                 echo $sql;
            }else{
                //insert
                $cols=array_keys($array);
                $sql="INSERT INTO $this->table (`".join("`,`",$cols)."`) VALUES('".join("','",$array)."')";
                echo $sql;
            }
            
            return $this->pdo->exec($sql);

    }
    
    
    function del($id){
        $sql="DELETE FROM $this->table ";
             if(is_array($id)){
                  $where=$this->a2s($id);
                  $sql=$sql . " WHERE ". join(" && ",$where);
            }else{
                //$sql=$sql.$arg[0];
                $sql .= " WHERE `id`='$id'";
            }
        echo $sql;
        
        return $this->pdo->exec($sql);
    }//把陣列轉成條件字串陣列
     function a2s($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
     }
     protected function fetchOne($sql){
        //echo $sql;
          return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
     }
     protected function fetchAll($sql){
       //echo $sql;
       return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
     }
     
}
function q($sql){
    //echo $sql;
   return $this->pdo->query($sql)->fetchAll();
}
function dd($array){
       echo "<pre>";
       print_r($array);
       echo "<pre>";
     } 
       $DEPT=new DB('imgs');
       //$dept=$DEPT->q("SELECT * FROM imgs");
       //$dept=$DEPT->all();
       //$DEPT->del(5);
       //$DEPT->save(['filename'=>'010.jpg','desc'=>'123']);
       //dd($dept);
       //echo $DEPT->math('max','id',['desc'=>'123']);
       //echo "<br>";
       //echo $DEPT->max('id',['desc'=>'123']);
       //echo "<br>";
       //echo $DEPT->count(['desc'=>'123']);
       //echo "<br>";
       //echo $DEPT->count();
       //echo "<br>";
       //echo $DEPT->sum('id');
       //echo "<br>";
       //echo $DEPT->min('id');
       //echo "<br>";
       //echo $DEPT->avg('id');
       //echo "<br>";
   //['sh'=>'2']


   $Title=new DB('titles');

   function to($url){
    header("location:".$url);
}
?>