<h1 class="text-center">Best scores</h1>
{% for game, scores in bests %}
<div class="bests">
    <h2>{{ game | capitalize }}</h2>
    <ul class="list-unstyled">
        {% for score in scores %}
            <li class="score"><span class="detail">{{ score.getAccount().login }}</span> - <span class="detail text-right"></span>{{ score.score }}</li>
        {% endfor %}
    </ul>
    {% endfor %}
</div>