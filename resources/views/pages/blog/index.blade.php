@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <x-table>
        <x-slot name="form">{{ route('blog.create')}}</x-slot>
        <x-slot name="thead">
            <tr>
                <th class="text-center">
                  #
                </th>
                <th>title</th>
                <th>created at</th>
                <th>updated at</th>
                <th>action</th>
              </tr>
        </x-slot>
        <x-slot name="tbody">
        </x-slot>
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
                            url : '{!! route('blog.data') !!}',
                        },
                    columns:[
                            { data:'DT_RowIndex',name:'DT_RowIndex',  orderable: false, searchable: false, className:'text-center'},
                            { data:'title', name:'title',  className: 'text-center'},
                            { data:'created_at', name: 'created_at',  className: 'text-center'},
                            { data:'updated_at', name: 'updated_at',  className: 'text-center'},
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