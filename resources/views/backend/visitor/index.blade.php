@extends('backend.layouts.app')

@section('title', __('Visitor'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        <x-utils.link :href="route('admin.visitor.index')" :text="__('All Visitor')" /> | 
        <x-utils.link :href="route('admin.visitor.index', ['filter' => 'pending_checkout'])" :text="__('Visitor pending checkout')" />
    </x-slot>

    <x-slot name="headerActions">
        <x-utils.link
            icon="c-icon cil-plus"
            class="card-header-action"
            :href="route('admin.visitor.create')"
            :text="__('Log new visit')"
        />
    </x-slot>

    <x-slot name="body">
      <livewire:backend.visitors-table />
    </x-slot>
</x-backend.card>
@endsection
