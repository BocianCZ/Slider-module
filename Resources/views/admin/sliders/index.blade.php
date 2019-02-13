@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('slider::sliders.titles.slider') }}
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li class="active">{{ trans('slider::sliders.breadcrumb.slider') }}</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                <a href="{{ route('admin.slider.slider.create') }}" class="btn btn-primary btn-flat">
                    <i class="fa fa-pencil"></i> {{ trans('slider::sliders.button.create slider') }}
                </a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('slider::sliders.table.status') }}</th>
                            <th>{{ trans('slider::sliders.table.name') }}</th>
                            <th>{{ trans('slider::sliders.table.system name') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($sliders)): ?>
                        <?php foreach ($sliders as $slider): ?>
                            <tr>
                                <td>
                                    <span class="label bg-{{ $slider->active == '0' ? 'red':'green'}}">
                                        {{ $slider->active == '1' ? 'Online':'Offline'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.slider.slider.edit', [$slider->id]) }}">
                                        {{ $slider->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.slider.slider.edit', [$slider->id]) }}">
                                        {{ $slider->system_name }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.slider.slider.edit', [$slider->id]) }}" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#confirmation-{{ $slider->id }}"><i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ trans('slider::sliders.table.status') }}</th>
                            <th>{{ trans('slider::sliders.table.name') }}</th>
                            <th>{{ trans('slider::sliders.table.system name') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>
            <!-- /.box-body -->
            </div>
        <!-- /.box -->
        </div>
    </div>
</div>
<?php if (isset($sliders)): ?>
    <?php foreach ($sliders as $slider): ?>
    <!-- Modal -->
    <div class="modal fade modal-danger" id="confirmation-{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('core::core.modal.title') }}</h4>
                </div>
                <div class="modal-body">
                    {{ trans('core::core.modal.confirmation-message') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-flat" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
                    {!! Form::open(['route' => ['admin.slider.slider.destroy', $slider->id], 'method' => 'delete', 'class' => 'pull-left']) !!}
                        <button type="submit" class="btn btn-outline btn-flat"><i class="glyphicon glyphicon-trash"></i> {{ trans('core::core.button.delete') }}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
@stop

@section('footer')

@stop
@section('shortcuts')

@stop

@section('scripts')
<?php $locale = App::getLocale(); ?>
<script type="text/javascript">
    $(function () {
        $('.data-table').dataTable({
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            "autoWidth": true,
            "order": [[ 1, "asc" ]],
            "language": {
                "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
            }
        });
    });
</script>
@stop
