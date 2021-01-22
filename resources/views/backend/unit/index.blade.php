@extends('backend.layouts.app')

@section('title', __('Unit'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        @lang('Unit')
    </x-slot>

    <x-slot name="headerActions">
        <x-utils.link
            icon="c-icon cil-plus"
            class="card-header-action"
            :href="route('admin.unit.create')"
            :text="__('Create Unit')"
        />
    </x-slot>

    <x-slot name="body">
      <livewire:backend.units-table />
    </x-slot>
</x-backend.card>
@endsection
