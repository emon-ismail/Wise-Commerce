<div class="section pb_0">
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="contact_wrap contact_style3">
                <div class="contact_icon">
                    <i class="linearicons-map2"></i>
                </div>
                <div class="contact_text">
                    <span>{{ __('Address') }}</span>
                    <p>{{ theme_option('address') }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="contact_wrap contact_style3">
                <div class="contact_icon">
                    <i class="linearicons-envelope-open"></i>
                </div>
                <div class="contact_text">
                    <span>{{ __('Email Address') }}</span>
                    <a href="mailto:{{ theme_option('email') }}">{{ theme_option('email') }}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="contact_wrap contact_style3">
                <div class="contact_icon">
                    <i class="linearicons-tablet2"></i>
                </div>
                <div class="contact_text">
                    <span>{{ __('Phone') }}</span>
                    <p>{{ theme_option('hotline') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section pt-0">
    <div class="row">
        <div class="col-12">
            <div class="heading_s1">
                <h2>{{ __('Get In touch') }}</h2>
            </div>
            <div class="field_form">
                {!!
                    $form
                        ->setFormOption('class', 'form--contact contact-form')
                        ->setFormInputClass('form-control')
                        ->add('helper_text', 'html', ['html' => '<p>' . BaseHelper::clean(__('The field with (<span style="color:#FF0000;">*</span>) is required.')) . '</p>'])
                        ->modify(
                                'submit',
                                'submit',
                                Botble\Base\Forms\FieldOptions\ButtonFieldOption::make()
                                    ->cssClass('btn btn-fill-out')
                                    ->label(__('Send Message'))
                                    ->wrapperAttributes(['class' => 'mb-3'])
                                    ->toArray(),
                                true
                            )
                        ->renderForm()
                !!}
            </div>
        </div>
    </div>
</div>
