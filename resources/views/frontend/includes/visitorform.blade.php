
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Visitor Entry')
                    </x-slot>

                    <x-slot name="body">
                        @include('includes.partials.messages')
                      
                        <x-forms.post :action="route('frontend.checkin')">
                          <div class="form-group row">
                              <label for="pass_id" class="col-md-4 col-form-label">@lang('Pass ID (optional)')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="pass_id" class="form-control" placeholder="{{ __('Pass ID') }}" value="{{ old('pass_id') }}" maxlength="8" />
                              </div>
                          </div><!--form-group-->

                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label">@lang('Visitor\'s Name')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="name" class="form-control" placeholder="{{ __('Visitor\'s Name') }}" value="{{ old('name') }}" maxlength="100" />
                              </div>
                          </div><!--form-group-->
                          
                          <div class="form-group row">
                              <label for="nric" class="col-md-4 col-form-label">@lang('Visitor\'s NRIC (last 3 characters)')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="nric" class="form-control" placeholder="{{ __('Visitor\'s NRIC (last 3 characters)') }}" value="{{ old('nric') }}" maxlength="3" />
                              </div>
                          </div><!--form-group-->
                          
                          <div class="form-group row">
                              <label for="contact" class="col-md-4 col-form-label">@lang('Visitor\'s Contact')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="contact" class="form-control" placeholder="{{ __('Visitor\'s Contact') }}" value="{{ old('contact') }}" maxlength="8" />
                              </div>
                          </div><!--form-group-->
                        
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label">@lang('Unit Block')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="unit_block" class="form-control" placeholder="{{ __('Unit Block') }}" value="{{ old('unit_block') }}" maxlength="100" required />
                              </div>
                          </div><!--form-group-->
                          
                          <div class="form-group row">
                              <label for="unit_number" class="col-md-4 col-form-label">@lang('Unit Number')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="unit_number" class="form-control" placeholder="{{ __('Unit Number') }}" value="{{ old('unit_number') }}" maxlength="100" required />
                              </div>
                          </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-block" type="submit">@lang('Check In')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->