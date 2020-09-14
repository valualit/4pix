<div class="form-group">
	<!--label for="name">{{ __('Название проекта') }}</label-->
	<div class="input-group">
		<label for="date1">{{ __('Выбор даты для сравнения') }}</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
			</div> 
			<select class="custom-select" name="date1" id="date1">
				@foreach ($DataList as $date)
				<option value="{{$date}}">{{$date}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div> 
<div class="form-group">
	<!--label for="name">{{ __('Название проекта') }}</label-->
	<div class="input-group">
		<label for="date2">{{ __('Выбор даты для сравнения') }}</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
			</div> 
			<select class="custom-select" name="date2" id="date2">
				@foreach ($DataList as $date)
				<option value="{{$date}}">{{$date}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div> 