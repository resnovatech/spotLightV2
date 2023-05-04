<div class="offCanvas__minicart">
    <div class="minicart__header ">
        <div class="minicart__header--top d-flex justify-content-between align-items-center">
            <h2 class="minicart__title h3"> Shopping Cart</h2>
            <button class="minicart__close--btn" aria-label="minicart close button" data-offcanvas>
                <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/></svg>
            </button>
        </div>
        {{-- <p class="minicart__header--desc">Clothing and fashion products are limited</p> --}}
    </div>
    <div id="main_sidebar">



<div class="minicart__product">

    <?php  $totalProductPrice = 0; ?>
    @foreach($cartCollection1 as $item)
    <div class="minicart__product--items d-flex">
        <div class="minicart__thumb">
            <a href="product-details.html"><img src="{{ $url_name }}{{$item->attributes->image }}" alt="prduct-img"></a>
        </div>
        <div class="minicart__text">
            <h3 class="minicart__subtitle h4"><a href="product-details.html">{{ $item->name }}</a></h3>
            @if($item->attributes->color == 0)

            @else
            <span class="color__variant"><b>Color:</b> {{$item->attributes->color }}</span>
            @endif


            @if($item->attributes->color == 0)

            @else
            <span class="color__variant"><b>Size:</b> {{$item->attributes->size }}</span>
            @endif



            <div class="minicart__price">
                <span class="current__price">৳ {{ $item->price }}</span>
                {{-- <span class="old__price">$140.00</span> --}}
            </div>
            <div class="minicart__text--footer d-flex align-items-center">
                <div class="quantity__box minicart__quantity">
                    <button type="button"  class="quantity__value " id="dcrease_data_from_side_bar{{$item->id}}" aria-label="quantity value" value="Decrease Value">-</button>
                    <label>
                        <input type="number" class="quantity__number" value="{{ $item->quantity }}" id="sidebarQuantity{{$item->id}}" />
                    </label>
                    <button type="button" class="quantity__value " id="increase_data_from_side_bar{{$item->id}}"  value="Increase Value">+</button> 
                </div>
                {{-- <button class="minicart__product--remove">Remove</button> --}}
            </div>
        </div>
    </div>

   <?php $totalProductPrice = $totalProductPrice  +  ($item->price*$item->quantity)  ?>
    @endforeach
</div>
<div class="minicart__amount">
    {{-- <div class="minicart__amount_list d-flex justify-content-between">
        <span>Sub Total:</span>
        <span><b>$240.00</b></span>
    </div> --}}
    <div class="minicart__amount_list d-flex justify-content-between">
        <span>Total:</span>
        <span><b> ৳ {{ $totalProductPrice }}</b></span>
    </div>
</div>

<div class="minicart__button d-flex justify-content-center mt-4">
    <a class="primary__btn minicart__button--link" href="{{ route('cart') }}">View cart</a>
    <a class="primary__btn minicart__button--link" href="{{ route('check_out_from_cart') }}">Checkout</a>
</div>


    </div>
</div>
