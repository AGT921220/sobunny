@extends('install.layouts.master')
@section('title', trans('messages.database_info_title'))

@section('content')

    <h3 class="title-3">
        <i class="bi bi-database"></i> {{ trans('messages.database_info_title') }}
    </h3>
    
    <form method="POST" name="databaseInfoForm" action="{{ data_get($stepsUrls, 'databaseInfo') }}" novalidate>
        {!! csrf_field() !!}
        
        <div class="row">
            <div class="col-md-6">
                @include('install.helpers.form_control', [
	                'label'      => trans('messages.database_host'),
                    'type'       => 'text',
                    'name'       => 'host',
                    'value'      => $databaseInfo['host'] ?? '',
                    'help_class' => 'install',
					'hint'       => trans('messages.database_host_hint', [
						'socket' => mb_strtolower(trans('messages.database_socket'))
                    ]),
                    'required'   => true,
                ])
            </div>
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'       => trans('messages.database_port'),
                    'type'        => 'text',
                    'name'        => 'port',
                    'value'       => $databaseInfo['port'] ?? '3306',
                    'placeholder' => '3306',
                    'help_class'  => 'install',
					'hint'       => trans('messages.database_port_hint', [
						'socket' => mb_strtolower(trans('messages.database_socket'))
                    ]),
                    'required'    => true,
                ])
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'      => trans('messages.database_socket') . trans('messages.optional'),
                    'type'       => 'text',
                    'name'       => 'socket',
                    'value'      => $databaseInfo['socket'] ?? '',
                    'help_class' => 'install',
					'hint'       => trans('messages.database_socket_hint', [
						'host' => mb_strtolower(trans('messages.database_host')),
						'port' => mb_strtolower(trans('messages.database_port'))
                    ]),
                    'required'   => false,
                ])
            </div>
            {{--
            <div class="col-md-6">
                @include('install.helpers.form_control', [
                    'label'   => trans('messages.database_driver'),
					'type'    => 'select',
					'name'    => 'connection',
					'value'   => $databaseInfo['connection'] ?? '',
					'options' => [
						['value' => 'mysql', 'text' => trans('messages.mysql')],
						['value' => 'mariadb', 'text' => trans('messages.mariadb')],
					],
					'hint'     => trans('messages.database_driver_hint'),
					'required' => false,
				])
            </div>
            --}}
        </div>
    
        <div class="row">
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'      => trans('messages.database_name'),
                    'type'       => 'text',
                    'name'       => 'database',
                    'value'      => $databaseInfo['database'] ?? '',
                    'help_class' => 'install',
                    'required'   => true,
                ])
            </div>
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'      => trans('messages.database_tables_prefix') . trans('messages.optional'),
					'type'       => 'text',
					'name'       => 'prefix',
					'value'      => $databaseInfo['prefix'] ?? '',
					'help_class' => 'install',
					'hint'       => trans('messages.database_tables_prefix_hint'),
					'required'   => false,
				])
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'      => trans('messages.database_username'),
                    'type'       => 'text',
                    'name'       => 'username',
                    'value'      => $databaseInfo['username'] ?? '',
                    'help_class' => 'install',
                    'required'   => true,
                ])
            </div>
            <div class="col-md-6">
                @include('install.helpers.form_control', [
					'label'      => trans('messages.database_password'),
                    'type'       => 'text',
                    'name'       => 'password',
                    'value'      => $databaseInfo['password'] ?? '',
                    'help_class' => 'install',
                    'required'   => false,
                ])
            </div>
        </div>
        
        <hr class="border-0 bg-secondary">
        
        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                {!! trans('messages.database_connect_btn_label') !!} <i class="bi bi-plugin"></i>
            </button>
        </div>
    </form>

@endsection

@section('after_scripts')
@endsection