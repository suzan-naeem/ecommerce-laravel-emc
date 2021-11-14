@extends('dashboard.layout')
@section('content')

    <div class="wrapper">
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">@lang('dashboard.products')</h4>
                            <ol class="breadcrumb">
                                <li><a href="">@lang('dashboard.products')</a></li>
                                <li class="active">@lang('dashboard.viewAll')</li>
                            </ol>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <form>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>@lang('dashboard.price')</label>
                                        <input type="text" name="price_from" class="form-control m-b-10" placeholder="@lang('dashboard.from')" value="{{ $_GET['price_from'] ?? '' }}">
                                        <input type="text" name="price_to" class="form-control" placeholder="@lang('dashboard.to')" value="{{ $_GET['price_to'] ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>@lang('dashboard.quantity')</label>
                                        <input type="text" name="quantity_from" class="form-control m-b-10" placeholder="@lang('dashboard.from')" value="{{ $_GET['quantity_from'] ?? '' }}">
                                        <input type="text" name="quantity_to" class="form-control" placeholder="@lang('dashboard.to')" value="{{ $_GET['quantity_to'] ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>@lang('dashboard.category')</label>
                                        <select id="category" name="category" class="form-control">
                                            <option value="">---</option>
                                            @php($_GET['category'] = $_GET['category'] ?? '')
                                            @foreach($categories as $category)
                                                <option {{ $category['id'] == $_GET['category'] ? 'selected' : '' }} value="{{ $category['id'] }}">{{ $category['name_' . app()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>@lang('dashboard.name')</label>
                                        <input type="text" name="name" class="form-control" value="{{ $_GET['name'] ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary">بحث</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            @include('dashboard.layouts.messages')
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align:center;">@lang('dashboard.name_ar')</th>
                                        <th style="text-align:center;">@lang('dashboard.name_en')</th>
                                        <th style="text-align:center;">@lang('dashboard.category')</th>
                                        <th style="text-align:center;">@lang('dashboard.price')</th>
                                        <th style="text-align:center;">@lang('dashboard.image')</th>
                                        <th style="text-align:center;">@lang('dashboard.visibility')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($products) > 0)
                                        @foreach($products as $key => $product)
                                        <tr class="gradeX {{ $product['id'] }}">
                                            <td style="text-align:center;">{{ $key + 1 }}</td>
                                            <td style="text-align:center;">{{ $product['name_ar'] }}</td>
                                            <td style="text-align:center;">{{ $product['name_en'] }}</td>
                                            <td style="text-align:center;">
                                                <a href="{{ route('categories.show', $product['category_id']) }}">{{ $product['category']['name_' . app()->getLocale()] }}</a>
                                            </td>
                                            <td style="text-align:center;">{{ $product['price'] }}</td>
                                            <td style="text-align:center;">

                                            
                                                @if (!empty($product->images) && count($product->images) > 0)
                                                <img  src="{{ $product->images[0]['image'] ?? ""}}" alt="{{ $product['name_en'] }}" width="150">
                                                @else 
                                                <h5>لا يوجد صورة</h5>
                                                @endif

                                            </td>
                                            <td style="text-align:center;">
                                                @if ($product['display'] == 1)
                                                <input class="off" data-id="{{ $product['id'] }}" type="checkbox" checked data-plugin="switchery" data-color="#81c868"/>
                                                @else
                                                <input class="on" data-id="{{ $product['id'] }}" type="checkbox" data-plugin="switchery" data-color="#81c868"/>
                                                @endif
                                            </td>

                                           {{-- <td>
                                                <a href="{{ route('products.show', $product['id']) }}" class="on-default"><i class="fa fa-eye"></i></a>
                                            </td> --}}
                                            {{-- <td>
                                                <a href="{{ route('products.comments', $product['id']) }}" class="on-default"><i class="fa fa-comment-o"></i></a>
                                            </td> --}}

                                            <td>
                                                <a href="{{ route('products.edit', $product['id']) }}" class="on-default"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <td class="actions">
                                                <a data-id="{{ $product['id'] }}" class="deletemsg" id="deleteParent"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" style="text-align: center!important;">@lang('dashboard.noElements')</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" class="deleteForm">
        @csrf
        @method('DELETE')
    </form>

@endsection

@push('custom-css')
    <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets_' . app()->getLocale() . '/plugins/switchery/css/switchery.min.css') }}" rel="stylesheet" />
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets_' . app()->getLocale() . '/plugins/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets_' . app()->getLocale() . '/plugins/bootbox/ui-alert-dialog-api.js') }}"></script>
    <script>
        $("#itemProducts").addClass('active');
        let body = $('body');

        body.on('click', '.deletemsg', function () {
            const id = $(this).attr('data-id');

            bootbox.dialog({
                message: "@lang('dashboard.askDelete')",
                title: "@lang('dashboard.deleteMessage')",
                buttons: {
                    danger: {
                        label: "@lang('dashboard.cancel')",
                        className: "btn-danger"
                    },
                    main: {
                        label: "@lang('dashboard.delete')",
                        className: "btn-primary",
                        callback: function () {
                            let deleteForm = $(".deleteForm");
                            deleteForm.attr('action', "products/" + id);
                            deleteForm.submit();
                        }
                    }
                }
            });
        });

        body.on('change', '.off', function () {
            const id = $(this).attr('data-id');
            swal({
                title: "@lang('dashboard.hideProduct')",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('dashboard.yes')",
                cancelButtonText: "@lang('dashboard.cancel')",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("@lang('dashboard.hiddenProduct')", "", "success");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('products.switch') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            display: 0
                        },
                        dataType: 'text',
                        cache: false,
                        success: function () {
                            $(".off[data-id=" + id + "]").toggleClass('on off');
                        }
                    });
                }
            });
        });

        body.on('change', '.on', function () {
            const id = $(this).attr('data-id');
            swal({
                title: "@lang('dashboard.showProduct')",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "@lang('dashboard.yes')",
                cancelButtonText: "@lang('dashboard.cancel')",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("@lang('dashboard.showedProduct')", "", "success");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('products.switch') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                            display: 1
                        },
                        dataType: 'text',
                        cache: false,
                        success: function () {
                            $(".on[data-id=" + id + "]").toggleClass('on off');
                        }
                    });
                }
            });
        });
    </script>
@endpush


