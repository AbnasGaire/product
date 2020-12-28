@extends('../master')

@section('content')
    <h1 class="text-primary text-center">Product out</h1>

    <br />

    <br />

    <div class="col-md-12">
        <form method="post" id="form" action="{{ route('productout.store') }}">
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
                                    {{-- <span>{{ $product->productsin->quantityin }}</span>
                                    --}}
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="price[]" class="form-control input price quantity_price" />
                        </td>

                        <td>
                            <input type="number" name="quantity[]" min="0"
                                class="form-control input qinput quantity_input" />
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
            // addRow: function() {
            //     $('#add').click(function() {
            //         let a = $('.rows:first').clone();
            //         a.find("input[type=text]").val("");
            //         a.find("input[type=number]").val("");
            //         a.appendTo("tbody");
            //     });
            // },

            deleteRow: function() {
                $("table").on('click', '.delete', function() {
                    let row = $("tr").length;
                    alert(row);
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

                        a.remove();
                    }

                })
            },

            maxValue: function() {
                $("table").on("keyup", ".quantity_input", function() {
                    a = $(this).closest("tr");
                    // b = a.find(".quantity_input")
                    c = $(this).attr("max");
                    // c = b.attr("max");
                    d = parseInt($(this).val());

                    // alert(d + ">" + c)
                    if (d > c) {
                        alert("Excessive Quantity!!" + d);
                        $(this).val('');
                    }



                })
            }



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
            },

            totalQuantity: function() {
                $("table").on("change", "select", function() {
                    // alert("hello" + $(this).val());
                    a = $(this).val();
                    $.ajax({
                        method: "get",
                        url: "product/excessquantity/" + a,
                        success: function(response) {
                            console.log(response);
                            console.log(response[0]["name"]);
                            $totalquantity = response[0]["resulttotal"];
                            $(".quantity_input").attr("max", $totalquantity);
                        },
                        error: function(err) {
                            alert("error");
                        }
                    })
                })
            }
        }

        $(document).ready(function() {
            //  ProductTable.init();
            // ProductTable.addRow();

            $('#add').click(function() {
                let a = $('.rows:first').clone();
                a.find("input[type=text]").val("");
                a.find("input[type=number]").val("");
                a.appendTo("tbody");
            });


            ProductTable.deleteRow();


            AjaxCall.ajaxCall();
            AjaxCall.totalQuantity();
            ProductTable.maxValue();
        });

    </script>
@endsection
