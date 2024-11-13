{{-- select2 --}}
@php
	$field ??= [];
	
	$field['fake'] ??= false;
	$field['allows_null'] ??= false;
	
	$entityModel = !empty($xPanel) ? $xPanel->model : null;
	$isNullAllowed = is_null($entityModel) || $entityModel::isColumnNullable($field['name']);
	
	$entityEntries = $field['model']::all();
	
	$fieldValue = $field['value'] ?? ($field['default'] ?? null);
	$fieldValue = old($field['name'], $fieldValue);
@endphp
<div @include('admin.panel.inc.field_wrapper_attributes') >
	<label class="form-label fw-bolder">
		{!! $field['label'] !!}
		@if (isset($field['required']) && $field['required'])
			<span class="text-danger">*</span>
		@endif
	</label>
	@include('admin.panel.fields.inc.translatable_icon')
 
	<select name="{{ $field['name'] }}" style="width: 100%"
			@include('admin.panel.inc.field_attributes', ['default_class' => 'form-select select2_field'])
	>
		
		@if (!$field['fake'])
			@if ($isNullAllowed)
				<option value="">-</option>
			@endif
		@else
			@if ($field['allows_null'])
				<option value="">-</option>
			@endif
		@endif
		
		@foreach ($entityEntries as $entityEntry)
			@php
				$entityEntryKey = $entityEntry->getKey();
				if (!empty($field['key']) && isset($entityEntry->{$field['key']})) {
					$entityEntryKey = $entityEntry->{$field['key']};
				}
				$selectedAttr = ($fieldValue == $entityEntryKey) ? ' selected' : '';
			@endphp
			<option value="{{ $entityEntryKey }}"{!! $selectedAttr !!}>{{ $entityEntry->{$field['attribute']} }}</option>
		@endforeach
	</select>
	
	{{-- HINT --}}
	@if (isset($field['hint']))
		<div class="form-text">{!! $field['hint'] !!}</div>
	@endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($xPanel->checkIfFieldIsFirstOfItsType($field, $fields))
	
	{{-- FIELD CSS - will be loaded in the after_styles section --}}
	@push('crud_fields_styles')
		{{-- include select2 css--}}
		<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	@endpush
	
	{{-- FIELD JS - will be loaded in the after_scripts section --}}
	@push('crud_fields_scripts')
	{{-- include select2 js--}}
	<script src="{{ asset('assets/plugins/select2/js/select2.js') }}"></script>
	<script>
		onDocumentReady((event) => {
			// trigger select2 for each untriggered select2 box
			$('.select2_field').each(function (i, obj) {
				if (!$(obj).hasClass("select2-hidden-accessible"))
				{
					$(obj).select2({
						theme: "bootstrap"
					});
				}
			});
		});
	</script>
	@endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}