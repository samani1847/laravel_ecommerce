@extends('layouts.basewithoutcart')



@section('content')
  <h1>Transaction</h1>

  <br>

  <table class="table bordered table-stripped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Paypal Code</th>
            <th>Subtotal</th>
            <th>Voucher Code</th>
            <th>Status</th>
            <th>Payment Date</th>
        </tr>

    </thead>
    <tbody>
         @foreach ($transaction as $key => $row)
            <tr>
                <td> {{ ++$key }}</td>
                <td>{{ $row->paypal_code }}</td>
                <td>Rp {{ $row->subtotal }}</td>
                <td>{{ $row->voucher_code}}</td> 
                <td>{{ $row->status }}</td> 
                <td>{{ $row->updated_at->format('d M Y - H:i:s') }}</td> 
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection


@section('scriptfile')
     @if ($message = Session::get('success'))
        <script>
            $(function(){
                toastr.clear();
                toastr.success('{{$message}}', 'Success');
            })
        </script>
    @elseif ($message = Session::get('error'))
        <script>
            $(function(){
                toastr.clear();
                toastr.error('{{$message}}', 'Payment Error');
            })
        </script>
    @endif
@endsection
