@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.keys',$project)}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.keys.add',$project->id)}}','','bg-light', '{{__('Добавить проект')}}')" class="btn btn-success btn-sm">{{__('Добавить запрос')}}</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<thead>
							<tr>
								<th class="d-none d-sm-table-cell" style="width: 10px">#</th>
								<th style="width: 20px"></th>
								<th>{{__('Запрос')}}</th>
								<th>{{__('Serm ID key')}}</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($keywords as $indexKay=>$keyword)
						<tr>
							<td class="d-none d-sm-table-cell">{{$indexKay+1}}.</td>
							<td>
								<div class="btn-group">
									<a href="{{route('admin.serm.keys.delete',[$project->id,$keyword->id])}}" id="pagedrop{{$keyword->id}}" data-confirm-text="{{__('Подтвердите удаление')}}" title="{{__('Удалить')}}" class="btn btn-tool zk-confirm dropdown-item"><i class="fas fa-trash"></i></a> 
								</div>
							</td>
							<td><b>{{$keyword->text}}</b></td>
							<td>{{$keyword->serm_key_id}}</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					</div>
				<!-- /.card-body -->
				</div>
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
@stop