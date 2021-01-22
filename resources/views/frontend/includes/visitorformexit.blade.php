
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        <x-utils.link :href="route('frontend.index')" :text="__('Visitor Entry')" />&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        @lang('Visitor Exit')
                    </x-slot>

                    <x-slot name="body">
                        @include('includes.partials.messages')
                        <h3>Visitor Exit</h3>
                        <x-forms.patch :action="route('frontend.checkout')">
                          <div class="form-group row">
                              <label for="pass_id" class="col-md-4 col-form-label">@lang('Pass ID (optional)')</label>

                              <div class="col-md-8">
                                  <input type="text"  name="pass_id" class="form-control" placeholder="{{ __('Pass ID') }}" value="{{ old('pass_id') }}" maxlength="8" />
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

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-block" type="submit">@lang('Check Out')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->