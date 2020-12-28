@extends("../master")

@section('content')
    <form class="form-group col-md-3 offset-md-4" method="get" action="/productin/search">
        From:<input type="date" name="startdate" class="form-control" />
        To:<input type="date" name="enddate" class="form-control" />
        <button class="btn btn-success form-control"><i class="fa fa-search"></i></button>
    </form>

    @if (count($output) > 0)
        <table class="table col-md-8 offset-md-1">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity </th>
                    <th scope="col">Added_at</th>
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
                            <td>{{ $pro->quantityin }}</td>
                            <td>{{ $pro->added_date }}</td>
                            <input type="hidden" value="{{ $pro->id }}" class="editid" />
                            <td>
                                <div style="display:flex;">
                                    <a href="/productin/edit/{{ $pro->id }}" type="button" class="btn btn-success edit"
                                        value="{{ $pro->id }}" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form method="post" action="/productin/delete/{{ $pro->id }}">
                                        @csrf
                                        @method("delete")

                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach


                </tbody>


            </table>

        @else
            <div class="text-primary text-center">
                <h3>No result found!!</h3>
            </div>

        @endif
        {{-- <div style="margin:0% 45% "> {{ $output->links() }}</div>
        --}}

        <!-- Modal -->
        <div class=" modal fade modaldata" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <input type="number" min="0" class="form-control quantityin" name="quantityin" />
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
                    alert(a);
                    $.ajax({
                        method: "get",
                        url: "/productin/edit/" + a,
                        success: function(result) {

                            console.log(result);
                            //  console.log(result.price);
                            $(".quantityin").val(result.quantityin);
                            $(".date").val(result.added_date);
                            $(".updateid").val(result.id);
                        },
                        error: function() {
                            alert("Error");
                        }

                    })

                })


                $(".update").click(function() {
                    id = $(".updateid").val();
                    quan = $(".quantityin").val();
                    date = $(".date").val();

                    $.ajax({

                        type: "post",
                        headers: {
                            "X-HTTP-Method-Override": "PUT",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/productin/update/" + id,
                        data: {
                            "quantityin": quan,
                            "add_date": date
                        },
                        success: function(response) {
                            console.log(response);
                            window.location = "http://pro.test/productinlist";
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
