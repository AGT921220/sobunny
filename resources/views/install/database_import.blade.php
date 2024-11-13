@extends('install.layouts.master')
@section('title', trans('messages.database_import_title'))

@php
	$databaseName = $databaseInfo['database'] ?? null;
@endphp
@section('content')
	
	<div class="row d-flex align-content-between" style="min-height: 160px;">
		<div class="col-12">
			<h3 class="title-3">
				<i class="bi bi-database"></i> {{ trans('messages.database_import_title') }}
			</h3>
		</div>
		
		<div class="col-12 mt-3">
			<form method="POST" name="databaseImportForm" action="{{ data_get($stepsUrls, 'databaseImport') }}" novalidate>
				{!! csrf_field() !!}
				
				<div class="row">
					<div class="col-md-6">
						@include('install.helpers.form_control', [
							'label'    => trans('messages.database_overwrite_tables'),
							'type'     => 'checkbox_switch',
							'name'     => 'overwrite_tables',
							'value'    => '1',
							'checked'  => (data_get($databaseInfo, 'overwrite_tables') == '1'),
							'hint'     => trans('messages.database_overwrite_tables_hint'),
							'required' => false,
						])
					</div>
				</div>
				
				<div class="row mt-4 mb-4">
					<div class="col-md-12">
						<div class="alert alert-info">
							{!! trans('messages.database_import_hint', [
								'btnLabel' => trans('messages.database_import_btn_label'),
								'database' => $databaseName
							]) !!}
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 text-end">
						<a href="{{ data_get($stepsUrls, 'databaseInfo') }}" class="btn btn-default">
							<i class="fa-solid fa-chevron-left"></i> {!! trans('messages.back') !!}
						</a>
						<button type="submit" class="btn btn-primary">
							{!! trans('messages.database_import_btn_label') !!} <i class="bi bi-gear"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection

@section('after_scripts')
	@parent
	<script>
		onDocumentReady((event) => {
			let overwriteTablesEl = document.querySelector('input[type=checkbox][name="overwrite_tables"]');
			if (!overwriteTablesEl) return;
			
			let overwriteTablesParentEl = overwriteTablesEl.closest('div.form-check');
			if (overwriteTablesParentEl) {
				overwriteTablesParentEl.addEventListener('click', e => toggleOverwriteTablesEl(e.target));
			}
		});
		
		function toggleOverwriteTablesEl(el) {
			if (!el) return;
			if (el.tagName.toLowerCase() === 'input') return;
			if (el.tagName.toLowerCase() !== 'div' || !el.classList.contains('form-check')) {
				el = el.closest('div.form-check');
			}
			
			el = el.querySelector('input[type=checkbox]');
			if (el.tagName.toLowerCase() === 'input') {
				el.checked = !el.checked;
				el.dispatchEvent(new Event('change'));
			}
		}
	</script>
@endsection