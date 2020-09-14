@extends('admin.index')

@section('content')
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				{{Breadcrumbs::render('admin.serm.settings')}}
			</div>
		</div><!-- /.container-fluid -->
    </section>
	
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 card">
					<div class="card-header">
						<h3 class="card-title"></h3>
					</div>
					<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="{{route('admin.serm.settings.save')}}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="card-body">
								<div class="form-group">
									<label>{{ __('SeRanking Token') }}</label>
									<input type="text" class="form-control" name="settings[serm.SeRankingToken]" placeholder="295bc582cd3db40be36b0e788a6bc87c3a9a1cd7" value="{{option('serm.SeRankingToken','295bc582cd3db40be36b0e788a6bc87c3a9a1cd7')}}">
								</div>
								<div class="row">
								<div class="col-6">
								@for ($i =1; $i <=20; $i++)
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">CTR {{$i}}</span>
										</div> 
										<input type="text" class="form-control" name="settings[serm.ctr.{{$i}}]" placeholder="{{$ctrs[$i]??0}}" value="{{option('serm.ctr.'.$i,$ctrs[$i]??0)}}">
									</div>									
								</div>
								@if($i==10) </div><div class="col-6"> @endif
								@endfor 
								</div>
								</div>
								<div class="form-group">
									<label>{{ __('Поправочный коэфф-т для Google в тематике') }}</label>
									<input type="text" class="form-control" name="settings[serm.ctr.google]" placeholder="0,600340136" value="{{option('serm.ctr.google','0,600340136')}}">
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer text-center">
								<button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
							</div>
						</form>
				<!-- /.card-body -->
				</div>
			</div>
        <!-- /.row -->
		</div><!-- /.container-fluid -->
    </section>
@stop

@section('footer-js')
<script>$(document).ready(function(){ $('#frequencyRegion').select2(); });</script>
@stop