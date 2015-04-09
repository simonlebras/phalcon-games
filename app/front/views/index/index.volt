<div class="jumbotron">
    <h1>HTML5 Games</h1>
    <p>Play fun games built with HTML5 and JavaScript</p>
    <ul class="list-unstyled">
        {% for game in games %}
            <li>{{ link_to("game/" ~ game.name, game.name | capitalize) }}</li>
        {% endfor %}
    </ul>
</div>