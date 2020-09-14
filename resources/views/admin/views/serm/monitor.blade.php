@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.monitoring',$project)}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header pl-0">
						<!--h3 class="card-title"></h3-->
						<div class="d-inline form-inline">
							<select class="d-inline form-control form-control-sm" style="min-width:120px" id="DateList">
								@foreach ($DateList as $date)
								<option value="{{route('admin.serm.monitoring', $project->id)}}?date={{$date}}" {{$date==$setdate?'selected':null}}>{{$date}}</option>
								@endforeach
							</select>
						</div>
						<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.monitoring.add', $project->id)}}','','bg-light', '{{__('Новый мониторинг')}}')" class="btn btn-success btn-sm m-1">{{__('Новый мониторинг')}}</a>
						<a href="javascript://" onClick="zk.open_dialog('ModalAddRole','{{route('admin.serm.monitoring.setting', $project->id)}}?date={{$setdate}}','','bg-light', '{{__('Настройки мониторинга')}}')" class="btn btn-warning btn-sm m-1">{{__('Фильтр')}}</a> 
						<a href="{{route('admin.serm.monitoring.xml', $project->id)}}?date={{$setdate}}" target="_blank" class="btn btn-danger btn-sm m-1">{{__('XML мониторинг')}}</a>
						<a href="{{route('admin.serm.statistics', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Cтатистика')}}</a>
						<a href="{{route('admin.serm.report', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Отчет')}}</a>
						<a href="{{route('admin.serm.negative', $project->id)}}?date={{$setdate}}" class="btn btn-info btn-sm m-1">{{__('Негатив')}}</a>
						
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0 mt-2 border-0">
						@if ($maxDate==false)
							<div class="m-3">
								<h3>Мониторинг за {{$setdate}} и другие даты отсутствует!</h3>
								<b>Сформируйте новый мониторинг</b>
							</div>
						@else
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							@foreach ($TaskDateList as $searchID=>$taskSearch)
							<li class="nav-item">
								<a class="nav-link {{$taskSearch==reset($TaskDateList)?'active':null}}" id="tab{{$searchID}}-tab" data-toggle="tab" href="#tab{{$searchID}}" role="tab" aria-controls="tab{{$searchID}}" aria-selected="false">{{$SearchEnginesList[$searchID]->name}}</a>
							</li>
							@endforeach
						</ul>
						<div class="tab-content" id="myTabContent">
							@foreach ($TaskDateList as $searchID=>$taskSearch)
							<div class="tab-pane fade {{$taskSearch==reset($TaskDateList)?'show active':null}}" id="tab{{$searchID}}" role="tabpanel" aria-labelledby="tab{{$searchID}}-tab">
								@foreach ($taskSearch as $keywordText=>$task)
								@if (isset($options['keywords'][$task->KeywordID]) || count($options['keywords'])==0)
								<div class="panel-group" id="taskSearch{{$searchID}}">
									<div class="panel panel-default">
										<div class="panel-heading">
											<div class="panel-title">
												<a class="btn btn-sm btn-info d-block text-left" data-toggle="collapse" data-parent="#taskSearch{{$searchID}}" href="#collapse{{$searchID}}-{{$task->id}}">
													<i class="fa fa-key mr-2" aria-hidden="true"></i>
													<b>{{$keywordText}}</b>
												</a>
											</div>
										</div>
										<div id="collapse{{$searchID}}-{{$task->id}}" class="panel-collapse collapse {{$task->isResult!==false?'in show':null}}">
											<div class="panel-body">
											@if($task->isResult===false)
												<b>Данные не доступны по состоянию на {{$setdate}}</b>
											@elseif($task->isResult==0)
												<b>Данные обновляются</b>
											@elseif($task->isResult==1)
												<table class="table table-head-fixed text-nowrap p-0">
													<tbody>
													@foreach ($competitors[$task->taskID] as $position=>$competitor)
														<tr id="tr{{$competitor->id}}" class="{{$bgList[$competitor->tonality]??null}} {{md5($competitor->urlCode)}}" data-urlcode="{{md5($competitor->urlCode)}}" >
															<td style="width:20px">{{$position}}</td>
															<td class="text-left">
																<div class="btn-group mr-2">
																	<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
																		<i class="fa fa-paint-brush" aria-hidden="true"></i>
																	</button>
																	<div class="dropdown-menu dropdown-menu-left" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(46px, 19px, 0px);">
																		<a href="javascript://" onClick="setTonality('{{$competitor->id}}','4','{{route('admin.serm.setTonality',[$project->id,$competitor->urlCode,$competitor->date,4])}}')" class="dropdown-item bg-success"><i class="far fa-thumbs-up mr-2"></i> Положительная</a>
																		<a href="javascript://" onClick="setTonality('{{$competitor->id}}','3','{{route('admin.serm.setTonality',[$project->id,$competitor->urlCode,$competitor->date,3])}}')" class="dropdown-item bg-danger"><i class="far fa-thumbs-down mr-2"></i> Отрицательная</a>
																		<a href="javascript://" onClick="setTonality('{{$competitor->id}}','2','{{route('admin.serm.setTonality',[$project->id,$competitor->urlCode,$competitor->date,2])}}')" class="dropdown-item bg-warning"><i class="fa fa-sort mr-2" aria-hidden="true"></i> Смешанная</a>
																		<a href="javascript://" onClick="setTonality('{{$competitor->id}}','1','{{route('admin.serm.setTonality',[$project->id,$competitor->urlCode,$competitor->date,1])}}')" class="dropdown-item bg-secondary"><i class="fa fa-window-close mr-2" aria-hidden="true"></i> Не имеет отношения</a>
																		<a href="javascript://" onClick="setTonality('{{$competitor->id}}','0','{{route('admin.serm.setTonality',[$project->id,$competitor->urlCode,$competitor->date,0])}}')" class="dropdown-item"><i class="fa fa-undo mr-2" aria-hidden="true"></i> Отсутствует</a>
																	</div>
																</div>
																<img class="mr-2" src="https://www.google.by/s2/favicons?domain={{$competitor->host}}" alt="" />
																<h6 class="d-inline">{{$options['short-url']=='on'?$competitor->url:$competitor->host}}</h6>
															</td>
														</tr>
													@endforeach
													</tbody>
												</table>
											@endif
											</div>
										</div>
									</div>
								</div>
								@endif
								@endforeach
							</div>
							@endforeach
						</div>
						@endif
					</div>
				<!-- /.card-body -->
				</div>
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
@stop


@section('footer-js')
<script>
$(document).ready(function(){ $('#DateList').select2(); $("#DateList").change(function(){document.location.href = $(this).val();});});
function setTonality(id,value,sendUrl){
	let bg = {@foreach ($bgList as $key=>$val){{$key}}:"{{$val}}",@endforeach};
	let tr = $("#tr"+id);
	tdClassName="."+$("#tr"+id).data("urlcode");
	let trClass = $(tdClassName);
	for (const [ClassKey, ClassValue] of Object.entries(bg)) {
		trClass.removeClass(ClassValue);
	}
	if(bg.hasOwnProperty(value)){
		trClass.addClass(bg[value]);
	}
	$.ajax({
		type:'GET', 
		url:sendUrl, 
		dataType: "json", 
		contentType: "application/json; charset=utf-8", 
		data:'_token='+$('meta[name="csrf-token"]').attr('content'), 
		success:function(data) {
			if(data.success!== 'undefined'&&data.success==1){
				/* ok */
			} else {
				/* error */
				$(document).Toasts('create', {
					class: 'bg-danger', 
					title: 'Ошибка', 
					subtitle: '', 
					body: 'Возникла ошибка при установки тональности, перезагрузите страницу!'
				});
			}
		}
	});
	return false;
}
</script>
@stop