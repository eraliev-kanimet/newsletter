{{ __('common.hello') }}!
<br/><br/>
{{ __('pages.register.6', ['site' => config('app.name')]) }} <a href="{{ $link }}" target="_blank">{{ __('common.click_here') }}</a>
<br/><br/>
{{ __('validation.expired', ['minutes' => 30]) }}
