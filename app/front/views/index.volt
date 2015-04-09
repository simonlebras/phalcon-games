<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HTML5 Games</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {% if component is defined %}
        {{ javascript_include("bower_components/webcomponentsjs/webcomponents.min.js") }}
        <link rel="import" href="/polymer_elements/{{ component }}-canvas.html">
    {% endif %}
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>
    {{ stylesheet_link("bower_components/bootstrap/dist/css/bootstrap.min.css") }}
    {{ stylesheet_link("css/style.css") }}
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">HTML5 Games</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Games
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            {% for game in games %}
                                <li>{{ link_to("game/" ~ game.name, game.name | capitalize) }}</a></li>
                            {% endfor %}
                        </ul>
                    </li>
                    <li>{{ link_to("game/bests", "Best scores") }}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>{{ link_to("account/signup", "Sign up") }}</li>
                    <li>{{ link_to("account/signin", "Sign in") }}</li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container-fluid">
    <section>
        {{ content() }}
    </section>
    <footer class="text-right">
        It's all yours under {{ link_to("http://creativecommons.org/licenses/by/4.0/", "Licence Creative Commons Attribution 4.0 International") }}.
    </footer>
</div>


{{ javascript_include("bower_components/jquery/dist/jquery.min.js") }}
{{ javascript_include("bower_components/bootstrap/dist/js/bootstrap.min.js") }}
</body>
</html>