{{ csrf_field() }}
<input type="hidden" name="date" value="{{$date}}" />
<div class="form-group">
    <label>Количество конкурентов</label>
    <select class="custom-select" name="settings[limit]">
        <option value="10" {{$options['limit']==10?'selected':null}}>ТОП 10</option>
        <option value="20" {{$options['limit']==20?'selected':null}}>ТОП 20</option>
        <option value="50" {{$options['limit']==50?'selected':null}}>ТОП 50</option>
        <option value="100" {{$options['limit']==100?'selected':null}}>ТОП 100</option>
    </select>
</div>
<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="SwitchURL" name="settings[short-url]" {{$options['short-url']=='on'?'checked':null}}>
        <label class="custom-control-label" for="SwitchURL">Показывать URL полностью</label>
    </div>
</div>
<h4 class="text-primary">Фильтр по ключевым словам:</h4>
<div class="form-group">
	@foreach ($Keywords as $Keyword)
    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" name="settings[keywords][{{$Keyword->id}}]" id="keyword{{$Keyword->id}}" value="{{$Keyword->id}}" {{isset($options['keywords'][$Keyword->id])||count($options['keywords'])==0?'checked':null}}>
        <label for="keyword{{$Keyword->id}}" class="custom-control-label">{{$Keyword->text}}</label>
    </div>
	@endforeach
</div>

<div class="form-group" id="YandexRegionBlock">
	<label for="frequencyRegion">{{ __('Регион для частотности') }}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-search"></i></span>
		</div> 
		<select class="form-control" id="frequencyRegion" name="settings[frequencyRegion]" required>
		@foreach ($frequencyRegion as $region)
			<option value="{{$region->id}}" {{$region->id==$options['frequencyRegion']?'selected':null}}>{{$region->name}}</option>
		@endforeach
		</select>
	</div>
</div>