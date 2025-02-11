<div class="newsletter-form">
    {!!
        \Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
            ->remove('wrapper_before')
            ->modify('email', 'email', [
                'attr' => ['placeholder' => __('Enter Your Email')],
            ])
            ->modify('submit', 'submit', [
                'attr' => [
                    'class' => Arr::get($attributes ?? [], 'class', 'btn btn-dark btn-radius'),
                ],
            ])
            ->add('after_newsletter_form_fields', 'html', ['html' => null])
            ->setFormEndKey('after_newsletter_form_fields')
            ->renderForm()
    !!}
</div>
