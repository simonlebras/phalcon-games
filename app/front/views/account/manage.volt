<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <h1 class="text-center">Manage account</h1>
        {{ form('account/manage', 'method' : 'post', 'enctype' : 'multipart/form-data', 'autocomplete' : 'off', 'novalidate' : 'true') }}
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
        <div class="form-group">
            {{ form.label('email') }}
            {{ form.render('email') }}
        </div>
        {{ form.messages('email') }}
        <div class="form-group">
            <label for="file">Avatar</label>
            <input type="file" id="file" name="file" required="true">

            <p class="help-block">Choose your avatar</p>
        </div>
        {{ form.render('Submit') }}
        {{ end_form() }}
    </div>
</div>