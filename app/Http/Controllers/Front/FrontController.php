<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Review;
class FrontController extends Controller
{

    public function get_district_from_division(Request $request){

      $get_district_from_div = DB::table('rede')->where('Division',$request->currentId)->select('District')->groupBy('District')->get();
       $data = view('front.productPages.get_district_from_division',compact('get_district_from_div'))->render();
        return response()->json($data);



}

public function get_thana_from_district(Request $request){

      $get_district_from_div = DB::table('rede')->where('District',$request->currentId)->select('Upazila_Thana')->groupBy('Upazila_Thana')->get();
       $data = view('front.productPages.get_thana_from_district',compact('get_district_from_div'))->render();
        return response()->json($data);



}


public function get_price_from_thana(Request $request){


    $get_district_from_div = DB::table('rede')->where('Upazila_Thana',$request->currentId)->value('Delivery_Charge');
    $data = $get_district_from_div;
     return response()->json($data);


}
     public function search_product_ajax(Request $request){


        $data="";
        if($request->category_name == 1){

            $products=DB::table('main_products')->where('product_name','LIKE','%'.$request->product_name.'%')->get();

        }else{


        $products=DB::table('main_products')->where('cat_name',$request->category_name)
        ->where('product_name','LIKE','%'.$request->product_name.'%')->get();
    }


    foreach ($products as $key => $product) {


                $image_location = 'https://adminpanel.spotlightattires.com/'.$product->front_image;

                $product_url_single = url('productDetail/'.$product->slug);

            $data.='<tr>'.
            '<td>'.' <img src="'.$image_location.'"  class="searchImage" style="height:40px;"> '. '</td>'.
            '<td>'.'<a href="'.$product_url_single.'">'.$product->product_name.'</a>'.'</td>'.
 '<td>'.'<a href="">&#2547; '.$product->selling_price.'</a>'.'</td>'.
            //'<td>'.'<button onclick="singleData('.$product->product_slug.')">'.$product->product_name.'</button>'.'</td>'.

            '</tr>';
            }
        return Response($data);




    }


    public function search_product(Request $request){
//dd($request->all());


            $main_product=DB::table('main_products')->where('product_name','LIKE','%'.$request->product_name.'%')->paginate(28);



        $cartCollection1 = \Cart::getContent();


$main_category = DB::table('product_categories')->get();

$cat_name = 'Search';

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.productList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));


    }


    public function mobile_search_product(Request $request){

        if($request->ajax())
        {
        $data="";
        $products=DB::table('main_products')->where('product_name','LIKE','%'.$request->search_product_in_mobile.'%')->get();


        if($products)
        {
            foreach ($products as $key => $product) {


                $image_location = 'https://adminpanel.spotlightattires.com/'.$product->front_image;

                $product_url_single = url('productDetail/'.$product->slug);

            $data.='<tr>'.
            '<td>'.' <img src="'.$image_location.'"  class="searchImage" style="height:40px;"> '. '</td>'.
            '<td>'.'<a href="'.$product_url_single.'">'.$product->product_name.'</a>'.'</td>'.
 '<td>'.'<a href="">&#2547;'.$product->selling_price.'</a>'.'</td>'.
            //'<td>'.'<button onclick="singleData('.$product->product_slug.')">'.$product->product_name.'</button>'.'</td>'.

            '</tr>';
            }
        return Response($data);
           }
           }
    }


    public function check_email_value(Request $request){

        $data = DB::table('users')->where('email',$request->email)->count();

        return $data;

    }
    public function index(){
        $banner_first_lists = DB::table('bannerfirsts')->get();


        $first_banner_one= DB::table('category_banners')->where('id',2)->first();
        $first_banner_two= DB::table('category_banners')->where('id',3)->first();
        $first_banner_three= DB::table('category_banners')->where('id',4)->first();
        $first_banner_four= DB::table('category_banners')->where('id',6)->first();


        $cartCollection1 = \Cart::getContent();


        $banner_second_list_one = DB::table('bannerseconds')->where('id',1)->first();

        $banner_second_list_two = DB::table('bannerseconds')->where('id',2)->first();

        $banner_second_list_three = DB::table('bannerseconds')->where('id',3)->first();

        $banner_second_list_four = DB::table('bannerseconds')->where('id',4)->first();

          $banner_second_list_four_new = DB::table('bannerseconds')->where('id',5)->first();


        $banner_second_list_five = DB::table('bannerseconds')->where('id',5)->first();


        $banner_second_list_six = DB::table('bannerseconds')->whereIn('id',[6,7])->get();


        $banner_second_list_seven = DB::table('bannerseconds')->where('id',8)->first();


        $client_list_all = DB::table('reviews')->where('status',1)->latest()->get();

        $animation_cat_lists = DB::table('animationcategories')->latest()->get();



        return view('front.homePage.index',compact('banner_second_list_four_new','banner_second_list_seven','banner_second_list_six','banner_second_list_five','banner_second_list_four','banner_second_list_three','animation_cat_lists','cartCollection1','client_list_all','banner_second_list_two','banner_second_list_one','banner_first_lists','first_banner_one','first_banner_two','first_banner_three','first_banner_four'));
    }


 public function shop(){

        $cartCollection1 = \Cart::getContent();


    $main_product = DB::table('main_products')->latest()->paginate(28);;
$main_category = DB::table('product_categories')->get();

$cat_name = 'Shop';

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.productList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));

    }



    public function categoryProduct($id){

        $cartCollection1 = \Cart::getContent();

        $get_product_name = DB::table('assaign_categories')->where('cat_name',$id)->select('product_name')->get();

        $convert_name_title = $get_product_name->implode("product_name", " ");


$separated_data_title = explode(" ", $convert_name_title);

if($id == 'allProduct'){

    $main_product = DB::table('main_products')->latest()->paginate(28);
}else{

$main_product = DB::table('main_products')->whereIn('slug',$separated_data_title)->latest()->paginate(28);
}
$main_category = DB::table('product_categories')->get();

$cat_name = $id;

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.productList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));

    }


    public function offerAndEventProduct(){

        $cartCollection1 = \Cart::getContent();

        $get_product_name = DB::table('assaign_categories')->where('cat_name','discount_product')->select('product_name')->get();

        $convert_name_title = $get_product_name->implode("product_name", " ");


$separated_data_title = explode(" ", $convert_name_title);

$main_product = DB::table('main_products')->whereIn('slug',$separated_data_title)->latest()->paginate(28);

$main_category = DB::table('product_categories')->get();

$cat_name = 'discount_product';

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.productList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));
    }



    public function animationCategory($id){

        $cartCollection1 = \Cart::getContent();

        $get_product_name = DB::table('assaign_animation_cats')->where('name',$id)->select('product_id')->get();

        $convert_name_title = $get_product_name->implode("product_id", " ");


$separated_data_title = explode(" ", $convert_name_title);

$main_product = DB::table('main_products')->whereIn('id',$separated_data_title)->latest()->paginate(28);

$main_category = DB::table('animationcategories')->get();

$cat_name = $id;

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.animationCategoryProductList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));

    }




    public function animationCategoryProductList(){

        $cartCollection1 = \Cart::getContent();

        $get_product_name = DB::table('assaign_animation_cats')->select('product_id')->get();

        $convert_name_title = $get_product_name->implode("product_id", " ");


$separated_data_title = explode(" ", $convert_name_title);

$main_product = DB::table('main_products')->whereIn('id',$separated_data_title)->latest()->paginate(28);

$main_category = DB::table('animationcategories')->get();

$cat_name = 34;

$color_atttribute = DB::table('attribute_details')
->where('main_id_att','color')->latest()->get();

$size_atttribute = DB::table('attribute_details')
->where('main_id_att','size')->latest()->get();

return view('front.productPages.animationCategoryProductList',compact('size_atttribute','color_atttribute','cartCollection1','cat_name','main_category','main_product'));
    }




    public function productDetail($id){

        $cartCollection1 = \Cart::getContent();

        $product_information = DB::table('main_products')->where('slug',$id)->first();

        $feature_image_first = DB::table('feature_product_images')->where('product_name',$product_information->id)->orderBy('id','desc')->value('filename');
        $feature_image_all = DB::table('feature_product_images')->where('product_name',$product_information->id)->orderBy('id','desc')->get();


        $catch_product_name_first = DB::table('main_products')
        ->where('cat_name',$product_information->cat_name)
        ->latest()->inRandomOrder()->limit(7)->get();

        $assaign_color_all = DB::table('imageuploads')->where('product_id',$product_information->id)->orderBy('id','desc')->get();
        $assaign_size_all = DB::table('assaign_sizes')->where('product_name',$product_information->id)->orderBy('id','desc')->get();

        $total_review_list = Review::where('product_name',$product_information->slug )->where('status','Yes')->latest()->get();


        $total_review_list_count = Review::where('product_name',$product_information->slug )->where('status','Yes')->latest()->count();


        $total_review_list_avg = Review::where('product_name',$product_information->slug)->where('status','Yes')->latest()->avg('total_star');

        $total_quantity = DB::table('size_charts')->where('product_name',$product_information->id)->get();

        return view('front.productPages.productDetail',compact('total_quantity','assaign_size_all','assaign_color_all','cartCollection1','total_review_list_avg','total_review_list_count','product_information','feature_image_first','feature_image_all','total_review_list','catch_product_name_first'));

    }



    public function quick_view_data(Request $request){

        $product_id = $request->id_for_pass;

        $feature_product_list3 = DB::table('main_products')->where('id',$product_id)->first();

        $feature_image_one =DB::table('feature_product_images')->where('product_name',$feature_product_list3->id)->orderBy('id','desc')->get();


        $data = view('front.productPages.quick_view_data',compact('feature_product_list3','feature_image_one'))->render();
        return response()->json($data);

       }

       public function quick_view_data1(Request $request){

        $product_id = $request->id_for_pass;

        $assaign_color_all = DB::table('imageuploads')->where('product_id',$product_id)->orderBy('id','desc')->get();


        $data = view('front.productPages.quick_view_data1',compact('assaign_color_all'))->render();
        return response()->json($data);

       }


       public function quick_view_data2(Request $request){

        $product_id = $request->id_for_pass;


        $assaign_color_all = DB::table('assaign_sizes')->where('product_name',$product_id)->orderBy('id','desc')->get();

        $data = view('front.productPages.quick_view_data2',compact('assaign_color_all'))->render();
        return response()->json($data);

       }


       public function quick_view_data3(Request $request){

        $product_id = $request->id_for_pass;


        $total_quantity = DB::table('size_charts')->where('product_name',$product_id)->get();

        $data = view('front.productPages.quick_view_data3',compact('total_quantity'))->render();
        return response()->json($data);

       }

  public function forget_password_link(){

        $cartCollection1 = \Cart::getContent();

        return view('front.otherPage.forget_password_link',compact('cartCollection1'));
       }

       public function send_code_for_verification(Request $request){


        $user_id = User::where('email',$request->email)->value('id');

        $cartCollection1 = \Cart::getContent();
        return view('front.otherPage.password_update_page',compact('cartCollection1','user_id'));

       }


       public function password_update_store(Request $request){


        $customer =  User::find($request->id);
        $customer->password = Hash::make($request->password);
        $customer->save();

        return redirect('/login_page_dash');
       }
}
