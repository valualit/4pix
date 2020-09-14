{{ csrf_field() }}
<div class="form-group">
	<label for="search_engine_id">{{ __('Поисковый запрос') }}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-search"></i></span>
		</div> 
		<select class="form-control" id="search_engine_id" name="search[search_engine_id]" required>
		@foreach ($SermSearchs as $indexKay=>$SermSearch)
		<option value="{{$SermSearch->serach_id}}" data-type="{{$SermSearch->type}}" data-region="{{$SermSearch->region_id}}">{{$SermSearch->serach_name}}</option>
		@endforeach
		</select>
	</div>
</div>
<div class="form-group d-none" id="YandexRegionBlock">
	<label for="yandex_region">{{ __('Yandex регион') }}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-search"></i></span>
		</div> 
		<select class="form-control" id="yandex_region" name="search[yandex_region]" required>
		@foreach ($SermYandexRegion as $region_id=>$name)
		<option value="{{$region_id}}">{{$name}}</option>
		@endforeach
		</select>
	</div>
</div>

<script>
$(document).ready(function(){
	$('#search_engine_id').select2();
	$('#search_engine_id').change(function() {
		let type = $(this).find(':selected').data("type");
		let region = $(this).find(':selected').data("region");
		if(type=='yandex'){
			$('#YandexRegionBlock').removeClass("d-none");
			$('#yandex_region').select2();
		} else {
			$('#YandexRegionBlock').addClass("d-none");
		}
	});
});
</script> 