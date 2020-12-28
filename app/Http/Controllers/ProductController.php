<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Productin;
use App\Productout;
class ProductController extends Controller
{
    public function productinlist(){
        $product=Product::all();
        $output=DB::table("products as p")
        ->join("productin as i","i.product_id","=","p.id")
        // ->join("productout","productout.product_id","=","products.id")
        ->select("i.id","name","price","quantityin","added_date")
        ->paginate(5);
        // return view("product.list")->with(['product'=>$product,'productin'=>$productin]);
        return view("product.list")->with(['output'=>$output]);
    }
    
    public function index(){
        return view("product.index");
    }
    
    public function store(Request $req)
    {
        
        $result=DB::transaction(function() use ($req){
            
            $product = new Product();
            $product->name=$req->name;
            $product->price=$req->price;
            $product->save();
       
        });
        return redirect("/"); 
            
       
        
    }


    public function getdata($id){
        $data=Product::find($id);
        return $data;
    }

    //productin code 

    public function productinview(){
        $products=Product::all();
        return view('product.productin')->with(['products'=>$products]);
    }
    
   

    public function productinstore(Request $req){
       
        $productin =new Productin();
        echo("<pre>");
        print_r($req->all());
        echo("</pre>");
        if(count($req->product)>0){
            foreach($req->product as $key=>$val){
                // print($key);
                // print_r($val);
                // print("<br/>");
                // print("<br/>");
                // print_r($val);
                //  print("<br/>");
                //  print_r($req->product);
                //  print("<br/>");
                //  print($req->product[$key]);
                //  print("<br/>");
                $data=array(
                    'product_id'=>$req->product[$key],
                    'quantityin'=>$req->quantity[$key],
                    'added_date'=>$req->date
                );

                $productin->insert($data);
                
                // print_r($data);
                // echo("<br/>");
                

                
            }
            // print_r($data);
        }
        return redirect()->route("productin.list");
      
    }



    public function productoutview(){
        $products=Product::all();
        // foreach($products as $product){

        // }
        return view('product.productout')->with(['products'=>$products]);
    }


    public function productoutstore(Request $req){
       
        $productout =new Productout();
       
        if(count($req->product)>0){
            foreach($req->product as $key=>$val){
                $data=array(
                    'product_id'=>$req->product[$key],
                    'quantityout'=>$req->quantity[$key],
                    'out_date'=>$req->date,
                );

                $productout->insert($data);
            }
            
        }

        return redirect()->route("productout.list");
      
    }


    public function productoutlist(){
        $products=Product::all();
        $output=DB::table("products as p")
        ->join("productout as pout","pout.product_id","=","p.id")
        ->select("pout.id","p.name","p.price","pout.quantityout","pout.out_date")
        ->get();
         
        // foreach($product as $pro){
        //     dd($pro->productsin);
        // }
        
        return view("product.productoutlist")->with(['output'=>$output]);
    }

    public function available(){
        $products=Product::all();

        // $a=DB::table('productin as i')
        //       ->leftJoin('productout as o','o.product_id','=','i.product_id')
        //       ->leftJoin('products as p','p.id','=','i.product_id')
        //       ->selectRaw('p.name , (ifnull(SUM(i.quantityin),0) - ifnull(SUM(o.quantityout),0)) AS total')
        //       ->groupBy('i.product_id')
        //       ->get();
         
        // $db=DB::table("products as p")
        // ->selectRaw("p.name ,a.product_id,(intotal-outtotal) as total")
        // ->join("a","a.product_id","=","p.id")
        // ->selectRaw("pin.product_id,SUM(pin.quantityin) AS intotal FROM productin AS pin")
        // ->groupBy("pin.product_id  as a")
        // ->join("b","b.product_id","=","a.product_id")
        // ->selectRaw("pout.product_id,SUM(pout.quantityout) AS outtotal FROM productout AS pout")
        // ->groupBy("pout.product_id as b")
        // ->get();
        // dd($db);
        // $b=DB::table("productout")
        // ->selectRaw("pout.product_id,IFNULL(-pout.quantityout,0) AS intotal 
        // FROM productout AS pout");


//  $inVsOut = DB::table('productin as inn')
//  ->leftJoin('inn')
            // $innQuery = DB::table('productin as inn')
            // ->selectRaw('inn.product_id,SUM(inn.quantityin)')
            // ->groupBy('inn.product_id');

            // $outQuery = DB::table('productout')
            // ->joinSub($innQuery, 'inn_product', function ($join) {
            //    $join->on('productout.product_id', '=', 'inn_product.product_id')
            //    ->groupBy('productout.product_id');
            //  })->toSql();
            //  echo($outQuery);
            //  die();

            // $outQuery = DB::table('productout as ouu')
            // ->selectRaw('ouu.product_id,SUM(ouu.quantityout)')
            // ->groupBy('ouu.product_id');
            // $all = DB::table('products')
            // ->joinSub('')

        // $a=DB::table("products as p")
        // ->selectRaw("p.name,sum(a.intotal) AS instotal")
        // ->join("p.id","=","a.product_id")
        // ->selectRaw("pin.product_id,IFNULL(SUM(pin.quantityin),0) AS intotal FROM productin AS pin")
        // ->groupBy("pin.product_id")
        // ->unionAll("pout.product_id,IFNULL(-pout.quantityout,0) AS intotal 
        // FROM productout AS pout  as a")
        // ->groupBy("p.id")
        // ->toSql();
        // dd($a);


        $a=DB::select(DB::raw("SELECT p.name,sum(a.intotal) AS resulttotal  FROM products AS p
        JOIN 
        (
        SELECT  pin.product_id,IFNULL(SUM(pin.quantityin),0) AS intotal 
        FROM productin AS pin
        GROUP BY pin.product_id
        UNION all
        SELECT  pout.product_id,IFNULL(-pout.quantityout,0) AS intotal 
        FROM productout AS pout
        
        ) AS a
        ON p.id=a.product_id
        GROUP BY p.id"));
        
       
        
       return view("product.available")->with(["availables"=>$a,"products"=>$products]);
    }
    

    public function productoutedit($id){
        $productout=Productout::find($id);
        return $productout;
    }


    public function productoutupdate($id,Request $request){
        $productout=Productout::find($id);
        $productout->quantityout=$request->quantityout;
        $productout->out_date=$request->out_date;
        $productout->save();
        return $productout;
    }
    

    public function productoutdelete($id){
        $productout=Productout::find($id);
        $productout->delete();
        return redirect()->route("productout.list");
    }


    public function productinedit($id){
        $productin=Productin::find($id);
        return $productin;
    }

    public function productinupdate($id,Request $request){
        $productin=Productin::find($id);
        $productin->quantityin=$request->quantityin;
        $productin->added_date=$request->add_date;
        $productin->save();
        return $productin;
    }

    public function productindelete($id){
        $productin=Productin::find($id);
        $productin->delete();
        return redirect()->route("productin.list");
    }

    public function excessquantity($id){
        $a=DB::select(DB::raw("SELECT p.name,sum(a.intotal) AS resulttotal  FROM products AS p
        JOIN 
        (
        SELECT  pin.product_id,IFNULL(SUM(pin.quantityin),0) AS intotal 
        FROM productin AS pin
        GROUP BY pin.product_id
        UNION all
        SELECT  pout.product_id,IFNULL(-pout.quantityout,0) AS intotal 
        FROM productout AS pout
        
        ) AS a
        ON p.id=a.product_id
        where p.id=$id
        GROUP BY p.id"));


        return $a;
    }


    public function searchdata(Request $req){
        $a=DB::table("products as p")
        ->select("name","quantityout","out_date","price","p.id")
        ->where("name","like","%".$req->searchdata."%")
        ->where("out_date","=",$req->searchdate)
        ->join("productout as pout","pout.product_id","=","p.id")
        ->get();
        // dd($a);

        return view("product.productoutsearch")->with(["output"=>$a]);

    }


    public function searchproductindata(Request $req)
    {
        $a=DB::table("products as p")
        ->select("name","price","quantityin","added_date","pin.id")    //wskti
        ->join("productin as pin","pin.product_id","=","p.id")
        ->whereBetween("added_date",[$req->startdate,$req->enddate])
        ->orderBy("added_date","asc")
        ->get();

        return view("product.productinsearch")->with(["output"=>$a]);
    }


}
