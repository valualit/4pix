@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.search',$project)}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.search.add',$project->id)}}','','bg-light', '{{__('Добавить проект')}}')" class="btn btn-success btn-sm">{{__('Добавить поисковую систему')}}</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<thead>
							<tr>
								<th class="d-none d-sm-table-cell" style="width: 10px">#</th>
								<th style="width: 20px"></th>
								<th>{{__('Поисковая система')}}</th>
								<th>{{__('Serm ID key')}}</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($SearchEngines as $indexKay=>$SearchEngine)
						<tr>
							<td class="d-none d-sm-table-cell">{{$indexKay+1}}.</td>
							<td>
								<div class="btn-group">
									<a href="{{route('admin.serm.search.delete',[$project->id,$SearchEngine->id])}}" id="pagedrop{{$SearchEngine->id}}" data-confirm-text="{{__('Подтвердите удаление')}}" title="{{__('Удалить')}}" class="btn btn-tool zk-confirm dropdown-item"><i class="fas fa-trash"></i></a> 
								</div>
							</td>
							<td>
								<b>{{$SearchEngine->name}}</b>
								{{$SearchEngine->type=='yandex'&&isset($SermYandexRegion[$SearchEngine->region_id])?$SermYandexRegion[$SearchEngine->region_id]:null}}
							</td>
							<td>{{$SearchEngine->site_engine_id}} / {{$SearchEngine->search_engine_id}}</td>
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