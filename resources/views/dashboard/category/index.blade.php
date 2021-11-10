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
                            <h4 class="page-title">@lang('dashboard.categories')</h4>
                            <ol class="breadcrumb">
                                <li><a href="">@lang('dashboard.categories')</a></li>
                                <li class="active">@lang('dashboard.viewAll')</li>
                            </ol>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            @include('dashboard.layouts.messages')
                            <div class="table-responsive">
                                <table class="table table-striped" id="custom_tbl_dt">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="text-align:center;">@lang('dashboard.name_ar')</th>
                                        <th style="text-align:center;">@lang('dashboard.name_en')</th>
                                        <th style="text-align:center;">@lang('dashboard.image')</th>
                                        <th style="text-align:center;">@lang('dashboard.visibility')</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($categories) > 0)
                                        @foreach($categories as $key => $category)
                                        <tr class="gradeX {{ $category['id'] }}">
                                            <td style="text-align:center;">{{ $key + 1 }}</td>
                                            <td style="text-align:center;">{{ $category->name_ar }}</td>
                                            <td style="text-align:center;">{{ $category->name_en }}</td>
                                            <td style="text-align:center;">
                                                <img src="{{ $category->image }}" alt="{{ $category->name_en }}" width="150">
                                            </td>
                                            <td style="text-align:center;">
                                                @if ($category['display'] == 1)
                                                <input class="off" data-id="{{ $category->id }}" type="checkbox" checked data-plugin="switchery" data-color="#81c868"/>
                                                @else
                                                <input class="on" data-id="{{ $category->id }}" type="checkbox" data-plugin="switchery" data-color="#81c868"/>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('categories.show', $category->id) }}" class="on-default"><i class="fa fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('categories.edit', $category->id ) }}" class="on-default"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <td class="actions">
                                                <a data-id="{{ $category->id }}" class="deletemsg" id="deleteParent"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" style="text-align: center!important;">@lang('dashboard.noElements')</td>
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
        $("#itemCategory").addClass('active');
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
                            deleteForm.attr('action', "categories/" + id);
                            deleteForm.submit();
                        }
                    }
                }
            });
        });

        body.on('change', '.off', function () {
            const id = $(this).attr('data-id');
            swal({
                title: "@lang('dashboard.hideCategory')",
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
                    swal("@lang('dashboard.hiddenCategory')", "", "success");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('categories.switch') }}",
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
                title: "@lang('dashboard.showCategory')",
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
                    swal("@lang('dashboard.showedCategory')", "", "success");
                    $.ajax({
                        type: "POST",
                        url: "{{ route('categories.switch') }}",
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


