@extends('layouts.app')
@section('content')
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">TOTALS</h5>
    <p class="card-text">{{$cart->getTotals()}}</p>
  </div>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
@foreach($cartItems as $key => $obj)
<tr>
<td><img src="{{$obj->getItem()->image}}" width="70" height="100"></td>
<td>{{$obj->getItem()->name}}</td>
<td>
    <div class="row">
        <div class="pr-2">
            <form action="{{action('CartController@remove')}}" method="post">
            @csrf
                <input type="hidden" name="productID" value="{{$obj->getID()}}">
                <button type="submit">-</button>
            </form>
        </div>
        {{ $obj->getAmount()}}
        <div class="pl-2"> 
            <form action="{{action('CartController@add')}}" method="post">
            @csrf
                <input type="hidden" name="productID" value="{{$obj->getID()}}">
                <button type="submit">+</button>
            </form>
        </div>
    </div>
</td>
<td>
<form action="{{action('CartController@destroy', $obj->getID())}}" method="post">
@csrf
<input name="_method" type="hidden" value="DELETE">
<button class="btn btn-danger" type="submit">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>