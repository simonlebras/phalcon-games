<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h1 class="text-center">Sign in</h1>
        {{ form('admin/signin', 'method' : 'post', 'autocomplete' : 'off', 'novalidate' : 'true') }}
        <div class="form-group">
            {{ form.label('login') }}
            {{ form.render('login') }}
        </div>
        {{ form.messages('login') }}
        <div class="form-group">
            {{ form.label('password') }}
            {{ form.render('password') }}
        </div>
        {{ form.messages('password') }}
        {{ content() }}
        {{ form.render('Submit') }}
        {{ end_form() }}
    </div>
</div>