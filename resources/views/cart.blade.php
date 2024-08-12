@extends('layouts.app')

@section('content')

<div class="container">
  @if($errors->any())

  @foreach($errors->all() as $error)
  <div class="alert alert-danger">{{$error}}</div>
  @endforeach

  @endif
  @if(flash()->message)
                <div class="alert alert-success">
                    {{ flash()->message }}
                </div>
                @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Qty</th>
        <th scope="col">Remove</th>

      </tr>
    </thead>
    <tbody>

      @if($cart)
      @php $i=1 @endphp

      @foreach($cart->items as $product)
      <tr>
        <th scope="row">{{$i++}}</th>

        <td><img src="{{asset($product['image'])}}" width="100"></td>
        <td>{{$product['name']}}</td>
        <td>${{$product['price']}}</td>
        <td>
          <form action="{{route('cart.update',$product['id'])}}" method="post">@csrf
            <input type="text" name="qty" value="{{$product['qty']}}">
            <button class="btn btn-secondary btn-sm">
              <i class="fas fa-sync"></i>Update
            </button>
          </form>
        </td>
        <td>
          <form action="{{route('cart.remove',$product['id'])}}" method="post">@csrf

            <button class="btn btn-danger">Remove</button>
          </form>
        </td>
      </tr>
      @endforeach



    </tbody>
  </table>
  <hr>
  <div class="card-footer">
    <a href="{{url('/')}}"><button class="btn btn-primary">Continue shopping</button></a>
    <span style="margin-left: 300px;">Total Price:${{$cart->totalPrice}}</span>

    <a href="{{route('cart.checkout',$cart->totalPrice)}}"><button class="btn btn-info float-right">Checkout</button></a>



  </div>
  @else
  <td>No items in cart</td>
  @endif

</div>
@endsection