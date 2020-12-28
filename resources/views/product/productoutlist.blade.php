@extends("../master")

@section('content')
    <br />
    <div>
        <form method=" get" style="display:flex;" action="{{ route('product.search') }}" class="col-md-4 offset-md-4">
            <input type="text" name="searchdata" placeholder="Search data by name!!" class="form-control " />
            <input type="date" name="searchdate" class="form-control " />
            <button class="btn btn-success"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <br />
    <hr />
    <div class="row">
        <table class="table col-md-10 offset-md-1">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity </th>
                    <th scope="col">Out_at</th>
                    <th scope="col">Action</th>


                </tr>
            </thead>
            <tbody>

                @php($i = 0)
                    @foreach ($output as $pro)
                        <tr>

                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $pro->name }}</td>
                            <td>{{ $pro->price }}</td>
                            <td>{{ $pro->quantityout }}</td>
                            <td>{{ $pro->out_date }}</td>
                            <input type="hidden" value="{{ $pro->id }}" class="editid" />
                            <td>
                                <div style="display:flex;">
                                    <a href="/productout/edit/{{ $pro->id }}" type="button" class="btn btn-success edit"
                                        value="{{ $pro->id }}" data-toggle="modal" data-target="#exampleModal"><i
                                            class="fa fa-edit">
                                        </i>
                                    </a>
                                    <form method="post" action="/productout/delete/{{ $pro->id }}" style="">
                                        @csrf
                                        @method("delete")
                                        {{-- <a href="/productout/delete/{{ $pro->id }}"
                                            class="btn btn-danger">Delete</a> --}}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>


                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>




        <!-- Modal -->
        <div class="modal fade modaldata" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Productout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        {{-- @method("put") --}}
                        <div class="modal-body">


                            <label>Quantity</label>
                            <input type="number" min="0" class="form-control quantityout" name="quantityout" />
                            <label>Date</label>
                            <input type="date" class="form-control date" name="date" />
                            <input type="hidden" class="updateid" />

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".edit").on("click", function() {
                    b = $(this).closest("tr")
                    a = b.find(".editid").val();
                    // alert(a);
                    $.ajax({
                        method: "get",
                        url: "/productout/edit/" + a,
                        success: function(result) {
                            console.log(result);
                            //  console.log(result.price);
                            $(".quantityout").val(result.quantityout);
                            $(".date").val(result.out_date);
                            $(".updateid").val(result.id);
                        },
                        error: function() {
                            alert("Error");
                        }

                    })

                })


                $(".update").click(function() {
                    id = $(".updateid").val();
                    quan = $(".quantityout").val();
                    date = $(".date").val();

                    $.ajax({

                        type: "post",
                        headers: {
                            "X-HTTP-Method-Override": "PUT",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/productout/update/" + id,
                        data: {
                            "quantityout": quan,
                            "out_date": date
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(err) {
                            // console.log(err);
                            alert("error");
                        }
                    })
                })
            });

        </script>
    @endsection
