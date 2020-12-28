@extends("../master")

@section('content')



    <div class="col-md-8 offset-md-2">
        <table class="table">
            <thead>
                <tr>

                    <th>Product name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($availables as $available)
                    <tr>

                        <td>{{ $available->name }}</td>
                        <td>{{ $available->resulttotal }}</td>
                    </tr>

                @endforeach
            </tbody>
    </div>

@endsection
