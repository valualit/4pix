@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.report',$project,$setdate)}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header pl-0">
						<h3 class="card-title"></h3>
						<div class="d-inline form-inline">
							<select class="d-inline form-control form-control-sm" style="min-width:120px" id="DateList">
								@foreach ($DateList as $date)
								<option value="{{route('admin.serm.report', $project->id)}}?date={{$date}}" {{$date==$setdate?'selected':null}}>{{$date}}</option>
								@endforeach
							</select>
						</div>
						<a href="?xlsx=1&date={{$setdate}}" class="btn btn-success btn-sm">Скачать XLSX</a>
						
						<a href="{{route('admin.serm.monitoring', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Мониторинг')}}</a>
						<a href="{{route('admin.serm.statistics', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Cтатистика')}}</a>
						<!--a href="{{route('admin.serm.report', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Отчет')}}</a-->
						<a href="{{route('admin.serm.negative', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Негатив')}}</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<thead>
							<tr>
								<th class="pl-0" colspan="{{$countColumn}}" style="color:#008000">{{$project->name}} {{$setdate}} {{$project->url}}</th>
							</tr>
						</thead>
					</table>
					@foreach ($TaskDateList as $searchID=>$taskSearch)
					<table id="Search{{$searchID}}" class="panel-group table table-head-fixed text-nowrap table-bordered">
						<thead class="panel panel-default">
							<tr class="panel-heading">
								<td class="panel-title" colspan="{{$countColumn}}" style="background-color:#000000;color:#FFFFFF">
									<a data-toggle="collapse" data-parent="#Search{{$searchID}}" href="#collapse{{$searchID}}">{{$SearchEnginesList[$searchID]->name}}</a>
								</td>
							</tr>
						</thead>
						<tbody id="collapse{{$searchID}}" class="panel-collapse collapse in show">
						<tr>
							<td style="text-align:center;vertical-align:middle"><b>Ссылка</b></td>
							@foreach ($KeywordsList as $keywordID=>$keyword)
							<td class="p-0" style="width:30px;vertical-align: text-bottom;"><div class="rotate"><span><b>{{$keyword->text}}</b></span></div></td>
							@endforeach
						</tr>
						@if (isset($table[$searchID])&&count($table[$searchID])>0) @foreach ($table[$searchID] as $url=>$keywordUrl)
						<tr>
							<td class="nowrapoverflow" style="max-width:150px"><a href="{{$url}}" target="_blank">{{parse_url($url,PHP_URL_PATH)}}</a></td>
							@foreach ($KeywordsList as $keywordID=>$keyword)
							<td class="text-center">{{$keywordUrl[$keyword->text]??null}}</td>
							@endforeach
						</tr>
						@endforeach @endif
						</tbody>
					</table>
					@endforeach
					</div>
				<!-- /.card-body -->
				</div>
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
@stop


@section('footer-js')
<script>$(document).ready(function(){ $("#DateList").change(function(){document.location.href = $(this).val();});});</script>
@stop