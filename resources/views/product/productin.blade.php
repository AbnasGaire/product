 @extends('../master')

 @section('content')
     <h1 class="text-primary text-center">Product in</h1>

     <br />
     <br />

     <div class="col-md-12">
         <form method="post" id="form" action="{{ route('productin.store') }}">
             @csrf
             <input type="date" class="form-control col-md-4" name="date" />
             <table class="table">
                 <thead>
                     <tr>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total Quantity</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr class="rows">
                         <td>
                             <select name="product[]" class="form-control">
                                 <option>--SELECT--</option>
                                 @foreach ($products as $product)
                                     <option class="product" value="{{ $product->id }}">{{ $product->name }}</option>
                                 @endforeach
                             </select>
                         </td>
                         <td>
                             <input type="number" name="price[]" class="form-control input price quantity_price" />
                         </td>

                         <td>
                             <input type="number" name="quantity[]" class="form-control input qinput quantity_input" />
                         </td>


                         <td>
                             <a class="btn btn-danger delete">X</a>
                         </td>

                     </tr>
                 </tbody>
             </table>
             <button type="submit" class="btn btn-success submit" style="float:right;">Submit</button>
         </form>
         <button class="btn btn-primary" id="add">+</a>

     </div>


     <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
         crossorigin="anonymous"></script>


     <script>
         ProductTable = {
             //   init: function() {
             //       this.addRow();

             //   },
             addRow: function() {
                 $('#add').click(function() {
                     let a = $('.rows:first').clone();
                     a.find("input[type=text]").val("");
                     a.find("input[type=number]").val("");
                     a.appendTo("tbody");
                 });
             },

             deleteRow: function() {
                 $("table").on('click', '.delete', function() {
                     let row = $("tr").length;

                     let a = $(this).closest("tr");
                     console.log(a);

                     if (row == 2 && a.is(":first-child")) {
                         $(".input").val("");
                         $(".item_id").val("--SELECT--");
                         let a = $(this).closest("tr");
                     } else {
                         var selected = $(this, "option:selected").val();
                         $(this).each(function() {
                             $('option[value="' + selected + '"]').removeAttr("disabled");
                         });
                         b = confirm("Are you sure you wanna delete !!")
                         if (b) {
                             a.remove();
                         }

                     }

                 })
             },



         }


         AjaxCall = {
             ajaxCall: function() {
                 $("table").on("change", "select", function() {
                     //   let a=$(this).val();
                     let a = $(this).children("option:selected").val();

                     b = $(this).closest("tr");
                     $.ajax({
                         method: "get",
                         url: "/productget/" + a,
                         success: function(result) {
                             console.log(result.price);
                             b.find(".quantity_price").val(result.price);
                         },
                         error: function() {
                             alert("Error");
                         }

                     })

                 })
             }
         }

         $(document).ready(function() {
             //  ProductTable.init();
             ProductTable.addRow();
             ProductTable.deleteRow();
             AjaxCall.ajaxCall();
         });

     </script>
 @endsection
