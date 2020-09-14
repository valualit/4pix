@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.summary',$project,$setdate)}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header pl-0">
						<h3 class="card-title"></h3>
						<a href="?xlsx=1&date1={{$date1}}&date2={{$date2}}" class="btn btn-success btn-sm">Скачать XLSX</a>
						
						<a href="{{route('admin.serm.monitoring', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Мониторинг')}}</a>
						<a href="{{route('admin.serm.statistics', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Cтатистика')}}</a>
						<a href="{{route('admin.serm.report', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Отчет')}}</a>
						<a href="{{route('admin.serm.negative', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Негатив')}}</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
					<table class="table table-head-fixed text-nowrap">
						<tbody>
						@foreach ($table as $keyRow=>$rowTable)
						@if($rowTable==false) 
							<tr><td colspan="{{$countColumn}}"><br /></td></tr> 
						@else
						<tr class="{{isset($rowTable['0'])&&$rowTable['0']=='title'?'bg-success':null}} {{isset($rowTable['0'])&&$rowTable['0']=='keyword'?'bg-primary':null}}">
							@if (isset($rowTable['99'])&&$rowTable['99']>0)
								<td{!!$rowTable['99']>0?' rowspan="'.$rowTable['99'].'"':null!!} class="{{$keyRow>0?'bg-secondary text-center align-middle':null}}"><b>{!!$rowTable[1]!!}</b></td> 
							@endif
							@foreach ($rowTable as $keyCol=>$col) @if($keyCol>1&&$keyCol<99)
							<td class="{{isset($rowTable[$keyCol+100])&&isset($bgList[$rowTable[$keyCol+100]])?$bgList[$rowTable[$keyCol+100]]:null}}">{!!$col!!}</td>
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