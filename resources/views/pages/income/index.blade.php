@extends('layouts.app')
@section('title', 'Income')
@section('content')
    <x-table>
        <x-slot name="form">{{ route('income.create') }}</x-slot>
        <x-slot name="thead">
            <tr>
                <th class="text-center">
                    #
                </th>
                <th>buyer</th>
                <th>item</th>
                <th>price</th>
                <th>total</th>
                <th>total price</th>
                <th>action</th>
            </tr>
        </x-slot>
        <x-slot name="tbody"></x-slot>
    </x-table>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var t = $('.dataTable').DataTable({
                    processing : true,
                    searching : false,
                    serverSide : true,
                    info: true,
                    ajax : {
                            url : '{!! route('income.data') !!}',
                        },
                    columns:[
                            { data:'DT_RowIndex',name:'DT_RowIndex',  orderable: false, searchable: false, className:'text-center'},
                            { data:'buyer', name:'buyer',  className: 'text-center'},
                            { data:'item', name:'item',  className: 'text-center'},
                            { data:'price', name: 'price',  className: 'text-center'},
                            { data:'total', name: 'total',  className: 'text-center'},
                            { data:'total_price', name: 'total_price',  className: 'text-center'},
                            { data:'action', name:'action', orderable: false, searchable: false, className: 'text-center'}
                    ]

                    }); 
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        })
    </script>
@endpush