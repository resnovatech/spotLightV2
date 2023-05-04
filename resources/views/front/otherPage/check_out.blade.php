@extends('front.master.master')

@section('title')

Checkout

@endsection


@section('body')

      <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        {{-- <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Check out</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="{{route('index')}}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Check out</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}


        <?php

$get_all_address = DB::table('delivary_addresses')
->where('user_id',Auth::user()->id)->value('first_name');





        ?>

<form action="{{route('final_confirm')}}" method="post" enctype="multipart/form-data" id="form1" data-parsley-validate="">
    @csrf
           <!-- Start checkout page area -->
    <div class="checkout__page--area">
        <div class="container">
            <div class="checkout__page--inner d-flex">
                <div class="main checkout__mian">

                    <!--new code -->

                    @if(empty($get_all_address))
                    <main class="main__content_wrapper">

                            <div class="checkout__content--step section__contact--information">
                                <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                    <h2 class="section__header--title h3">Contact information</h2>

                                </div>
                                <div class="customer__information">
                                    <div class="checkout__email--phone mb-12">
                                       <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Email or mobile phone mumber" name="ephone" value="{{ Auth::user()->phone }}"  type="text" required>
                                       </label>
                                    </div>

                                </div>
                            </div>
                            <div class="checkout__content--step section__shipping--address">
                                <div class="section__header mb-25">
                                    <h3 class="section__header--title">Shipping address</h3>
                                </div>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        <div class="col-lg-12 mb-12">
                                            <div class="checkout__input--list ">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="First name (optional)" name="first_name" value="{{ Auth::user()->name }}"   type="text" required>
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Address1" name="address"  type="text" required>
                                                </label>
                                            </div>
                                        </div>

<?php


$district_list_all_dis = DB::table('rede')->select('District')->groupBy('District')->get();
$district_list_all_div = DB::table('rede')->select('District')->groupBy('District')->get();
?>



 <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <select  class="checkout__input--field border-radius-5 " placeholder="Division"
name="district"    required id="district" >
<option value="">-- Select District --</option>
@foreach($district_list_all_dis as $all_district_list_all)
<option value="{{$all_district_list_all->District}}">{{$all_district_list_all->District}}</option>
@endforeach
</select>
                                                </label>
                                            </div>
                                        </div>


 <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <select  class="checkout__input--field border-radius-5" placeholder="Division"
name="town"    required id="town" >
<option value="">-- Select Thana/Upazila --</option>
</select>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                    </main>
                    @else

                    <?php

                    $get_all_address12 = DB::table('delivary_addresses')
                    ->where('user_id',Auth::user()->id)->first();

?>
                    <main class="main__content_wrapper">

                            <div class="checkout__content--step section__contact--information">
                                <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                    <h2 class="section__header--title h3">Contact information</h2>

                                </div>
                                <div class="customer__information">
                                    <div class="checkout__email--phone mb-12">
                                       <label>
                                            <input class="checkout__input--field border-radius-5" placeholder="Email or mobile phone mumber" name="ephone" value="{{ $get_all_address12->phone }}"  type="text">
                                       </label>
                                    </div>

                                </div>
                            </div>
                            <div class="checkout__content--step section__shipping--address">
                                <div class="section__header mb-25">
                                    <h3 class="section__header--title">Shipping address</h3>
                                </div>
                                <div class="section__shipping--address__content">
                                    <div class="row">
                                        <div class="col-lg-12 mb-12">
                                            <div class="checkout__input--list ">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="First name (optional)" name="first_name" value="{{ $get_all_address12->first_name }}"  type="text">
                                                </label>
                                            </div>
                                        </div>


                                        <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <input class="checkout__input--field border-radius-5" placeholder="Address1" name="address" value="{{ $get_all_address12->address }}"  type="text">
                                                </label>
                                            </div>
                                        </div>



<?php


$district_list_all_dis = DB::table('rede')->select('District')->groupBy('District')->get();
$district_list_all_thana = DB::table('rede')->select('Upazila_Thana')->groupBy('Upazila_Thana')->get();
?>



 <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <select  class="checkout__input--field border-radius-5 " placeholder="Division"
name="district"    required id="district" >
<option value="">-- Select District --</option>
@foreach($district_list_all_dis as $all_district_list_all)
<option value="{{$all_district_list_all->District}}" {{ $get_all_address12->district == $all_district_list_all->District ? 'selected':'' }}>{{$all_district_list_all->District}}</option>
@endforeach

</select>
                                                </label>
                                            </div>
                                        </div>


 <div class="col-12 mb-12">
                                            <div class="checkout__input--list">
                                                <label>
                                                    <select  class="checkout__input--field border-radius-5" placeholder="Division"
name="town"    required id="town" >
<option value="">-- Select Thana/Upazila --</option>
@foreach($district_list_all_thana as $all_district_list_all)
<option value="{{$all_district_list_all->Upazila_Thana}}" {{ $get_all_address12->town == $all_district_list_all->Upazila_Thana ? 'selected':'' }}>{{$all_district_list_all->Upazila_Thana}}</option>
@endforeach

</select>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                    </main>


                    @endif

                    <!--end code -->

                </div>
                <aside class="checkout__sidebar sidebar" style="display:block !important; border-top: 1px solid #e4e4e4; padding: 15px; margin-bottom: 30px;">
                    <div class="">
                        <table class="cart__table--inner">
                            <tbody class="cart__table--body">

                                @foreach($cartCollection1 as $item)
                                <tr class="cart__table--body__items">
                                    <td class="cart__table--body__list">
                                        <div class="product__image two  d-flex align-items-center">
                                            <div class="product__thumbnail border-radius-5">
                                                <a href="#"><img class="border-radius-5" src="{{ $url_name }}{{$item->attributes->image }}" alt="cart-product"></a>
                                                <span class="product__thumbnail--quantity">{{ $item->quantity }}</span>
                                            </div>
                                            <div class="product__description">
                                                <h3 class="product__description--name h4"><a href="#">{{ $item->name }}</a></h3>
                                                <span class="product__description--variant">COLOR: Blue</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__table--body__list">
                                        <span class="cart__price">৳ {{ $item->price }}</span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <?php
                    $client_type_new = DB::table('clients')->where('user_id',Auth::user()->id)->value('c_type');
                    $client_area_new = DB::table('delivary_addresses')->where('user_id',Auth::user()->id)->value('town');

                    $clientDeliveryCharge = DB::table('rede')->where('Upazila_Thana',$client_area_new)->value('Delivery_Charge');

                    ?>
                    <div class="pt-4">
                        <table class="checkout__total--table">
                            <tbody class="checkout__total--body">
                                <tr class="checkout__total--items">
                                    <td class="checkout__total--title text-left">Delivery Charge </td>
                                    <td class="checkout__total--amount text-right">৳
                                        <span id="delivery_charge_value">{{ $clientDeliveryCharge }}</span>
                                        <input class="checkout__discount--code__input--field border-radius-5" id="ship_price_c" value="{{ $clientDeliveryCharge }}" name="ship_price_c" placeholder="Delivery Charge"  type="hidden">
                                    </td>
                                </tr>


@if( $client_type_new == 'Silver')
<?php
 if(\Cart::getTotal() > 1){
$get_discount_value = (\Cart::getTotal()*5)/100;
$get_main_value = \Cart::getTotal() - $get_discount_value;
}else{
$get_main_value = '';
}
?>
 <tr class="checkout__total--items">
                                                <td class="checkout__total--title text-left">Special Discount</td>
                                                <td class="checkout__total--amount text-right">5%</td>
                                            </tr>
 <tr class="checkout__total--items">
                                                <td class="checkout__total--title text-left">Grand Total</td>
                                                <td class="checkout__total--amount text-right">৳  <span id="grand_final_value">{{$get_main_value + $clientDeliveryCharge}}</span></td>
                                            </tr>




@elseif( $client_type_new == 'Platinum')
<?php
 if(\Cart::getTotal() > 1){
$get_discount_value = (\Cart::getTotal()*10)/100;
$get_main_value = \Cart::getTotal() - $get_discount_value;
}else{
$get_main_value = '';
}
?>
 <tr class="checkout__total--items">
                                                <td class="checkout__total--title text-left">Special Discount</td>
                                                <td class="checkout__total--amount text-right">10%</td>
                                            </tr>
 <tr class="checkout__total--items">
                                                <td class="checkout__total--title text-left">Grand Total</td>
                                                <td class="checkout__total--amount text-right" >৳  <span id="grand_final_value">{{$get_main_value + $clientDeliveryCharge}}</span></td>
                                            </tr>

@else
<tr class="checkout__total--items">
    <td class="checkout__total--title text-left">Grand Total </td>
    <td class="checkout__total--amount text-right">৳  <span id="grand_final_value">{{ \Cart::getTotal() + $clientDeliveryCharge}}</span></td>
</tr>
@endif



                            </tbody>
                        </table>

<!-- check box start -->
<div class="checkout_content--step section_shipping--address checkout__total">
        <div class="section__header">
            <h3 class="section__header--title">Delivery Method</h3>
        </div>
        <div class="checkout_content--step_inner3 border-radius-5">
            <div class="checkout_address--content_header">




                           </div>

                           <div class="checkout__discount--code mt-3">
                            <form class="d-flex" action="#">
                                <label>
                                    <input class="checkout__discount--code__input--field border-radius-5" placeholder="Promo code"  type="text">
                                </label>
                                <button class="checkout__discount--code__btn primary__btn border-radius-5 mt-2" type="submit">Apply</button>
                            </form>
                        </div>
        </div>
    </div>
<!-- check box end -->


                    </div>

                   <div class="checkout__content--step__footer d-flex align-items-center mt-4">

                        <input type="submit" style="margin-bottom: 25px;" class="continue__shipping--btn primary__btn border-radius-5" value="Checkout" />

                        <a style="margin-bottom: 25px;margin-left:5px;" class="continue__shipping--btn primary__btn border-radius-5" href="{{ route('index') }}">Shopping</a>
                        <a style="margin-bottom: 25px;" class="previous__link--content" href="{{ route('cart') }}">Return to cart</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <!-- End checkout page area -->

</form>
        </main

@endsection

@section('script')
<script></script>
<script>
    $(document).ready(function(){
          $("#division").change(function(){


                var currentId  = $(this).val();

                  $.ajax({
url: "{{ route('get_district_from_division') }}",
type: "GET",
data: {
'currentId':currentId
},
success: function (data) {

$("#district").html('');
$('#district').html(data);


}

});





          });
});
</script>

<script>
    $(document).ready(function(){
          $("#district").change(function(){


                var currentId  = $(this).val();

                  $.ajax({
url: "{{ route('get_thana_from_district') }}",
type: "GET",
data: {
'currentId':currentId
},
success: function (data) {

$("#town").html('');
$('#town').html(data);


}

});





          });
});
</script>


<script>
    $(document).ready(function(){
          $("#town").change(function(){

                var grandTotal  = $('#grand_final_value').html();
                var currentId  = $(this).val();

                  $.ajax({
url: "{{ route('get_price_from_thana') }}",
type: "GET",
data: {
'currentId':currentId
},
success: function (data) {

    var final_val = parseInt(grandTotal) + parseInt(data);


    $('#grand_final_value').html(final_val);



$("#delivery_charge_value").html('');
$('#delivery_charge_value').html(data);

$('#ship_price_c').val(data);

}

});





          });
});
</script>

@endsection
