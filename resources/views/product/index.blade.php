 @extends("../master")
 @section("content")

<h1 class="text-primary text-center">Product Infromation</h1>

<form action="{{route("product.store")}}" method="post" class="col-md-4 offset-md-4">
    @csrf
    <label>Name</label>
    <input type="text"  name="name" class="form-control"/>
    <label>Price</label>
    <input type="number"  name="price" class="form-control"/>

    <br/>
    <button class="btn btn-success form-control">Add Product</button>

</form> 
@endsection
