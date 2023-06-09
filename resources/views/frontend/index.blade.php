@extends('frontend.layouts.master')

@section('title', 'Finnifty')
@section('content')

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit"> </i>
                </div>
                <div>RELIANCE.XNSE </div>
               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- <label for="expiry_date"><b>Select Expiry:</b></label>
                        <select style="width: 234px; height: 37px; color: #a37213;" id="expiry_date">
                            <option value="" selected>Options</option>


                            @if (isset($expiryDate1))



                                @foreach ($expiryDate1 as $option)
                                    <option value="{{ $option }}">{{ date('d-M-Y', strtotime($option)) }}</option>
                                @endforeach
                            @endif
                        </select> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: center;">

        
@if ($apiData)
    <table>
        <thead >
            <tr>
                <th>Date</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($apiData as $data)
                <tr>
                    <td>{{ $data['date'] }}</td>
                    <td>{{ $data['open'] }}</td>
                    <td>{{ $data['high'] }}</td>
                    <td>{{ $data['low'] }}</td>
                    <td>{{ $data['close'] }}</td>
                    <td>{{ $data['volume'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Failed to retrieve stock market data. Please try again later.</p>
@endif
    </div>

    <style>
        @media screen and (min-width: 768px) {
            #myModal .modal-dialog {
                width: 70%;
                border-radius: 5px;
            }
        }
    </style>
    <script>
        $(function() {
            table = $('#manage_all').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/allBlogs',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'file_path',
                        name: 'file_path'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                "columnDefs": [{
                    "className": "",
                    "targets": "_all"
                }],
                "autoWidth": false,
            });
            $('.dataTables_filter input[type="search"]').attr('placeholder', 'Type here to search...').css({
                'width': '220px',
                'height': '30px'
            });
        });
    </script>
    <script type="text/javascript">
        function create() {
            ajax_submit_create('blogs');
        }

        $(document).ready(function() {
            // View Form
            $("#manage_all").on("click", ".view", function() {
                var id = $(this).attr('id');
                ajax_submit_view('blogs', id)
            });

            // Edit Form
            $("#manage_all").on("click", ".edit", function() {
                var id = $(this).attr('id');
                ajax_submit_edit('blogs', id)
            });


            // Delete
            $("#manage_all").on("click", ".delete", function() {
                var id = $(this).attr('id');
                ajax_submit_delete('blogs', id)
            });

        });
    </script>
    
    <script>
        // JavaScript code to handle table filtering based on selected expiry date

        $("#expiry_date").change(function(){
            const selectedOption = $("#expiry_date").val();
            const tableRows = document.querySelectorAll('tbody tr');
               
            tableRows.forEach((row) => {
                console.log(row);
                if (row.classList.contains(selectedOption)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
    </script>


@endsection
