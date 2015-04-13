<div class="row">
    <div class="col-xs-8 col-xs-offset-2">
        <div class="row">
        {% for post in posts %}
            <div class="col-xs-12 comment">
                <p><b>{{ post.getAccount().login }}</b> on {{ date('d/m/Y', strtotime(post.date_comment)) }}:</p>
                <p>{{ post.comment |  striptags}}</p>
            </div>
        {% endfor %}
        </div>
    </div>
    <div class="col-xs-8 col-xs-offset-2">
        <h1 class="text-center">Post a comment</h1>
        {{ form('guestbook/post', 'method' : 'post', 'autocomplete' : 'off', 'novalidate' : 'true') }}
        <div class="form-group">
            {{ form.label('comment') }}
            {{ form.render('comment') }}
        </div>
        {{ form.messages('comment') }}
        {{ content() }}
        {{ form.render('Submit') }}
        {{ end_form() }}
    </div>
</div>