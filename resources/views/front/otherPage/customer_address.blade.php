@extends('front.master.master')

@section('title')

Customer Dasboard

@endsection


@section('body')
<main class="main__content_wrapper">

        {{-- <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">My Account</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">My Account</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">
               <?php
                        $client_type_new = DB::table('clients')->where('user_id',Auth::user()->id)->value('c_type');

                        ?>


                <p class="account__welcome--text">Hello, {{ Auth::user()->name }} welcome to your dashboard!</p>


                <p class="account__welcome--text">Customer Type: {{$client_type_new}}</p>

                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title h3 mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list {{ Route::is('customer_dashboard')  ? 'active' : '' }}"><a href="{{route('customer_dashboard')}}">Dashboard</a></li>

                            <li class="account__menu--list {{ Route::is('customer_address')  ? 'active' : '' }}"><a href="{{route('customer_address')}}">Address</a></li>

                             <li class="account__menu--list {{ Route::is('customer_wishlist')  ? 'active' : '' }}"><a href="{{route('customer_wishlist')}}">Wishlist</a></li>

                               <li class="account__menu--list {{ Route::is('customer_profile')  ? 'active' : '' }}"><a href="{{route('customer_profile')}}">Profile</a></li>

                            <li class="account__menu--list"><a href="{{ route('signout') }}">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="account__wrapper">
                        @include('flash_message')
                        <div class="account__content">
                        <!--<h2 class="account__content--title h3 mb-20">Personal Info</h2>-->

                        <!--<p>{{ Auth::user()->name }}</p>-->
                        <!--<hr>-->
                        <?php

                        $get_all_address12_id = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('id');


                         $get_all_address12_first = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('first_name');

                 $get_all_address12_last = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('last_name');

                $get_all_address12_phone = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('phone');




              $get_all_address12_address = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('address');


       $get_all_address12_town = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('town');


                          $get_all_address12_district = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('district');

                   $get_all_address12_division = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('division');


                   $get_all_address12_post_code = DB::table('delivary_addresses')
                        ->where('user_id',Auth::user()->id)->value('post_code');


 ?>
<h2 class="account__content--title h3 mb-20">Delivery Address</h2>
<form method="post" action="{{ route('address_update_code') }}" method="post" enctype="multipart/form-data" id="form" data-parsley-validate="">
@csrf
    <input type="hidden" value="{{ $get_all_address12_id }}" name="id" />

    <p>Name : <input type="text" class="checkout__discount--code__input--field border-radius-5" name="first_name" value="{{ $get_all_address12_first}}"  maxlength="50" required/> </p>


    <p> Phone : <input type="text" class="checkout__discount--code__input--field border-radius-5" name="phone" value="{{ $get_all_address12_phone}}" maxlength="11" required /> </p>


    <p> Address : <input type="text" class="checkout__discount--code__input--field border-radius-5" name="address" maxlength="200" required value="{{ $get_all_address12_address}}" /> </p>
<?php


$district_list_all_dis = DB::table('rede')->select('District')->groupBy('District')->get();
$district_list_all_thana = DB::table('rede')->select('Upazila_Thana')->groupBy('Upazila_Thana')->get();
?>



<p> District : <select  class="js-example-basic-single checkout__input--field border-radius-5 " placeholder="Division"
name="district"    required id="district" >
<option value="">-- Select District --</option>
@foreach($district_list_all_dis as $all_district_list_all)
<option value="{{$all_district_list_all->District}}" {{ $get_all_address12_district == $all_district_list_all->District ? 'selected':'' }}>{{$all_district_list_all->District}}</option>
@endforeach

</select>
 </p>


    <p> Thana/Upozila :  <select  class="js-example-basic-single1 checkout__input--field border-radius-5" placeholder="Division"
name="town"    required id="town" >
<option value="">-- Select Thana/Upazila --</option>
@foreach($district_list_all_thana as $all_district_list_all)
<option value="{{$all_district_list_all->Upazila_Thana}}" {{ $get_all_address12_town == $all_district_list_all->Upazila_Thana ? 'selected':'' }}>{{$all_district_list_all->Upazila_Thana}}</option>
@endforeach

</select>
 </p>



<button type="submit" class="account__details--footer__btn"> Update</button>

</form>



                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my account section end -->

        <!-- Start shipping section -->
        <section class="shipping__section2 shipping__style3 section--padding pt-0">
            <div class="container">
                <div class="shipping__section2--inner shipping__style3--inner d-flex justify-content-between">
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="{{asset('/')}}public/shipping1.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Shipping</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="{{asset('/')}}public/shipping2.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Payment</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="{{asset('/')}}public/shipping3.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Return</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="{{asset('/')}}public/shipping4.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Support</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>

@endsection
@section('script')

<script>
    $(document).ready(function(){
          $("#division").change(function(){


                var currentId  = $(this).val();

                  $.ajax({
url: "https://spotlightattires.com/get_district_from_division",
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
url: "https://spotlightattires.com/get_thana_from_district",
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

@endsection
