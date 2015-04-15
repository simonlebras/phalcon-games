<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HTML5 Games</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
                {{ link_to('admin', 'Admin', 'class' : 'navbar-brand' ) }}
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>{{ link_to("admin/manage", "Manage") }}</li>
                    <li>{{ link_to("admin/guestbook", "Guestbook") }}</li>
                    <li>{{ link_to("admin/map", "Map") }}</li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    {%- if not(logged_in is empty) %}
                        <li>{{ link_to("admin/logout", "Logout") }}</li>
                    {% else %}
                        <li>{{ link_to("admin/signin", "Sign in") }}</li>
                    {% endif %}
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
        It's all yours
        under {{ link_to("http://creativecommons.org/licenses/by/4.0/", "Licence Creative Commons Attribution 4.0 International") }}
        .
    </footer>
</div>


{{ javascript_include("bower_components/jquery/dist/jquery.min.js") }}
{{ javascript_include("bower_components/bootstrap/dist/js/bootstrap.min.js") }}
{{ javascript_include("js/admin.js") }}
{% if map == true %}
    {{ javascript_include("https://maps.googleapis.com/maps/api/js?v=3.exp") }}
    {{ javascript_include("js/map.js") }}
{% endif %}
</body>
</html>