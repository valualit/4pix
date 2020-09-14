{{ csrf_field() }}
<div class="form-group">
	<!--label for="name">{{ __('Название проекта') }}</label-->
	<div class="input-group">
		<label for="date">{{ __('Выберите дату генерации мониторинга') }}</label>
		<div class="input-group">
			<div class="input-group-prepend" data-target="#date" data-toggle="datetimepicker">
				<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
			</div> 
			<input type="text" class="form-control datetimepicker-input" id="date" value="{{date('Y-m-d')}}" name="monitoring[date]" required placeholder="{{ __('Выберите дату генерации мониторинга') }}" />
		</div>
	</div>
</div> 
<div class="form-group">
	<!--label for="name">{{ __('Название проекта') }}</label-->
	<div class="input-group">
		<label for="keysource">{{ __('Источник тональности') }}</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
			</div> 
			<select class="custom-select" name="monitoring[keysource]">
				@foreach ($DataList as $date)
				<option value="{{$date}}">{{$date}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div> 

<script>$(function(){$("#date").datetimepicker({locale:'ru',format:'YYYY-MM-DD'});});</script>