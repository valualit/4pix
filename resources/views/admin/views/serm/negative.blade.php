@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.negative',$project,$setdate)}}
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
								<option value="{{route('admin.serm.negative', $project->id)}}?date={{$date}}" {{$date==$setdate?'selected':null}}>{{$date}}</option>
								@endforeach
							</select>
						</div>
						<a href="?xlsx=1&date={{$setdate}}" class="btn btn-success btn-sm">Скачать XLSX</a>
						
						<a href="{{route('admin.serm.monitoring', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Мониторинг')}}</a>
						<a href="{{route('admin.serm.statistics', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Cтатистика')}}</a>
						<a href="{{route('admin.serm.report', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Отчет')}}</a>
						<!--a href="{{route('admin.serm.negative', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Негатив')}}</a-->
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<tbody>
						@foreach ($table as $rowTable)
						@if($rowTable==false) 
							<tr><td colspan="{{$countColumn}}"><br /></td></tr> 
						@else
						<tr class="{{isset($rowTable['0'])&&$rowTable['0']=='title'?'bg-success':null}}">
							@foreach ($rowTable as $keyCol=>$col) @if($keyCol>0)
							<td>{!!$col!!}</td>
							@endif @endforeach
						</tr>
						@endif
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


@section('footer-js')
<script>$(document).ready(function(){ $("#DateList").change(function(){document.location.href = $(this).val();});});</script>
@stop