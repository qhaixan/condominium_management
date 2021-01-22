@extends('backend.layouts.app')

@section('title', __('Create Unit'))

@section('content')
    <x-forms.post :action="route('admin.unit.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create Unit')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.unit.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Type')</label>

                        <div class="col-md-10">
                          <div class="form-check">
                            <input
                                name="is_residential"
                                id="is_residential"
                                value="1"
                                class="form-check-input"
                                type="checkbox"
                                {{ (old('is_residential')) ? 'checked' : '' }} />

                            <label class="form-check-label" for="is_residential">
                                Residential
                            </label>
                          </div>
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Unit Block')</label>

                        <div class="col-md-10">
                            <input type="text"  name="unit_block" class="form-control" placeholder="{{ __('Block') }}" value="{{ old('unit_block') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Unit Number')</label>

                        <div class="col-md-10">
                            <input type="text"  name="unit_number" class="form-control" placeholder="{{ __('Number') }}" value="{{ old('unit_number') }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Occupant Name')</label>

                        <div class="col-md-10">
                            <input type="text"  name="occupant_name" class="form-control" placeholder="{{ __('Occupant Name') }}" value="{{ old('occupant_name') }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Occupant Contact')</label>

                        <div class="col-md-10">
                            <input type="text"  name="occupant_contact" class="form-control" placeholder="{{ __('Occupant Contact') }}" value="{{ old('occupant_contact') }}" maxlength="8" />
                        </div>
                    </div><!--form-group-->
                    
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Unit')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
