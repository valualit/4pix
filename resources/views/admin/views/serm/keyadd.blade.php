{{ csrf_field() }}
<div class="form-group">
	<label for="keytext">{{ __('Поисковый запрос') }}</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fab fa-amilia"></i></span>
		</div> 
		<input type="text" class="form-control" id="keytext" name="keytext" required placeholder="{{ __('Поисковый запрос') }}" />
	</div>
</div> 