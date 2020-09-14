@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.sermupdate')}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header">
						<h3 class="card-title"></h3>
						<a href="{{route('admin.serm.sermupdate.project')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Синхронизировать проекты')}}</a>
						<a href="{{route('admin.serm.sermupdate.pc')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Синхронизировать поисковые системы и регионы')}}</a>
						<a href="{{route('admin.serm.sermupdate.projectkeys')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Синхронизировать ключевые слова всех проектов')}}</a>
						<a href="{{route('admin.serm.sermupdate.projectsearch')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Синхронизировать поисковые системы всех проектов')}}</a>
						<a href="{{route('admin.serm.sermupdate.projectinfo')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Синхронизировать сводную статистику')}}</a>
						<hr />
						<a href="{{route('serm.crontasks')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Cron мониторинг')}}</a>
						<a href="{{route('serm.cronprojectinfo')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Cron сводная статистика')}}</a>
						<a href="{{route('serm.cronfrequencytask')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Cron задания проверки частотности')}}</a>
						<a href="{{route('serm.cronfrequency')}}" target="_blank" class="btn btn-success btn-sm m-1">{{__('Cron проверка частотности по заданиям')}}</a>
					</div>
					<!-- /.card-header -->
				<!-- /.card-body -->
				</div>
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
@stop