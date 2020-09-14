@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm')}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.add')}}','','bg-light', '{{__('Добавить проект')}}')" class="btn btn-success btn-sm">{{__('Добавить проект')}}</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<thead>
							<tr>
								<th class="d-none d-sm-table-cell" style="width: 10px">#</th>
								<th style="width: 20px"></th>
								<th>{{__('Проект')}}</th>
								<th>{{__('ИКС')}}</th>
								<th title="Количесво поисковых запросов">{{__('ПЗ')}}</th>
								<th>{{__('ТОП 5 / 10 / 30')}}</th>
								<th>{{__('СР. ПОЗ.')}}</th>
								<th>{{__('В ИНДЕКСЕ')}}</th>
								<th title="Администратор проекта">{{__('Адм.')}}</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($projects as $indexKay=>$project)
						<tr>
							<td class="d-none d-sm-table-cell">{{$indexKay+1}}.</td>
							<td>
								<div class="btn-group">
									<a href="{{route('admin.serm.delete',$project->id)}}" id="pagedrop{{$project->id}}" data-confirm-text="{{__('Подтвердите удаление')}}" title="{{__('Удалить')}}" class="btn btn-tool zk-confirm dropdown-item"><i class="fas fa-trash"></i></a>
									<a href="javascript://" onClick="zk.open_dialog('ModalEditUser','{{route('admin.serm.edit',$project->id)}}','modal-xl','bg-light', '{{__('Редактировать')}}')" title="{{__('Редактировать')}}" class="btn btn-tool dropdown-item"><i class="fas fa-edit"></i></a>
									<a href="{{route('admin.serm.keys',$project->id)}}" class="btn btn-tool" title="{{__('Поисковые запросы')}}"><i class="fas fa-tags" title="{{__('Поисковые запросы')}}"></i></a>
									<a href="{{route('admin.serm.search',$project->id)}}" class="btn btn-tool" title="{{__('Поисковые системы + регионы')}}"><i class="fas fa-search" title="{{__('Поисковые системы + регионы')}}"></i></a>
									<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.summary.add', $project->id)}}','','bg-light', '{{__('Сводка')}}')" class="btn btn-tool" title="{{__('Сводка')}}"><i class="fa fa-chart-line" aria-hidden="true" title="{{__('Сводка')}}"></i></a>
									<!--a href="" class="btn btn-tool" title="{{__('Отчет')}}"><i class="fas fa-file-contract" title="{{__('Отчет')}}"></i></a-->
									<!--a href="" target="_blank" class="btn btn-tool" title="{{__('Мониторинг')}}"><i class="fas fa-tasks" aria-hidden="true" title="{{__('Мониторинг')}}"></i></a-->
								</div>
							</td>
							<td><a href="{{route('admin.serm.monitoring',$project->id)}}"><b>{{$project->name}}</b></a> <small> ({{$project->serm_id}})</small><br />{{$project->url}}</td>
							<td>{{$project->getInfo('yandex_x')}}</td>
							<td>{{$project->getKeywordCount()}}</td>
							<td>{{$project->getInfo('top5')}} / {{$project->getInfo('top10')}} / {{$project->getInfo('top30')}}</td>
							<td>{{$project->getInfo('today_avg')}}</td>
							<td><i class="fab fa-google text-primary mr-1"></i>{{$project->getInfo('index_google')}} / <i class="fab fa-yandex text-danger mr-1"></i> {{$project->getInfo('index_yandex')}}</td>
							<td>{{$project->userInfo->name}}</td>
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