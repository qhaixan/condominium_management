@extends('backend.layouts.app')

@section('title', __('Update Visitor Log'))

@section('content')
    <x-forms.patch :action="route('admin.visitor.update', $visitor)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Visitor Log')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.visitor.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="">

                    <div class="form-group row">
                        <label for="pass_id" class="col-md-2 col-form-label">@lang('Pass ID (optional)')</label>

                        <div class="col-md-10">
                            <input type="text"  name="pass_id" class="form-control" placeholder="{{ __('Pass ID') }}" value="{{ old('pass_id') ?? $visitor->pass_id }}" maxlength="8" />
                        </div>
                    </div><!--form-group-->
                  
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Visitor\'s Name')</label>

                        <div class="col-md-10">
                            <input type="text"  name="name" class="form-control" placeholder="{{ __('Visitor\'s Name') }}" value="{{ old('name') ?? $visitor->name }}" maxlength="100" />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="nric" class="col-md-2 col-form-label">@lang('Visitor\'s NRIC (last 3 characters)')</label>

                        <div class="col-md-10">
                            <input type="text"  name="nric" class="form-control" placeholder="{{ __('Visitor\'s NRIC (last 3 characters)') }}" value="{{ old('nric') ?? $visitor->nric }}" maxlength="3" />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="contact" class="col-md-2 col-form-label">@lang('Visitor\'s Contact')</label>

                        <div class="col-md-10">
                            <input type="text"  name="contact" class="form-control" placeholder="{{ __('Visitor\'s Contact') }}" value="{{ old('contact') ?? $visitor->contact }}" maxlength="8" />
                        </div>
                    </div><!--form-group-->
                  
                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Unit Block')</label>

                        <div class="col-md-10">
                            <input type="text"  name="unit_block" class="form-control" placeholder="{{ __('Unit Block') }}" value="{{ old('unit_block') ?? $visitor->unit_block }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="unit_number" class="col-md-2 col-form-label">@lang('Unit Number')</label>

                        <div class="col-md-10">
                            <input type="text"  name="unit_number" class="form-control" placeholder="{{ __('Unit Number') }}" value="{{ old('unit_number') ?? $visitor->unit_number }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="time_in" class="col-md-2 col-form-label">
                          @lang('Time IN')
                          &nbsp;[<a href="javascript:;" onclick="document.getElementById('time_in').value = timestamp();">@lang('Now')</a>]
                        </label>

                        <div class="col-md-10">
                            <input type="text" id="time_in" name="time_in" class="form-control" placeholder="{{ __('Time IN') }}" value="{{ old('time_in') ?? $visitor->time_in }}" maxlength="19" required />
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                        <label for="time_out" class="col-md-2 col-form-label">
                          @lang('Time OUT')
                          &nbsp;[<a href="javascript:;" onclick="document.getElementById('time_out').value = timestamp();">@lang('Now')</a>]
                        </label>

                        <div class="col-md-10">
                            <input type="text" id="time_out" name="time_out" class="form-control" placeholder="{{ __('Time OUT') }}" value="{{ old('time_out') ?? $visitor->time_out }}" maxlength="19" />
                        </div>
                    </div><!--form-group-->
                    @include('backend.visitor.includes.timestampjs')

                    @if($visitcount)
                    <div class="form-group row">
                        <div class="col-md-12">
                            <x-utils.link :href="route('admin.visitor.index', ['samevisitor' => $visitor->id])" :text="__('Check '.$visitcount.' other visit(s) from this person')" />
                        </div>
                    </div>
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Log')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
