@extends('layouts.app')
@section('title', 'Log Activity')
@section('content')
    <x-table>
        <x-slot name="thead">
            <tr>
                <th class="text-center">
                  #
                </th>
                <th>username</th>
                <th>activity</th>
                <th>timestamp</th>
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
                            url : '{!! route('log.data') !!}',
                        },
                    columns:[
                            { data:'DT_RowIndex',name:'DT_RowIndex',  orderable: false, searchable: false, className:'text-center'},
                            { data:'username', name:'username',  className: 'text-center'},
                            { data:'activity', name: 'activity',  className: 'text-center'},
                            { data:'timestamp', name: 'timestamp',  className: 'text-center'},
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